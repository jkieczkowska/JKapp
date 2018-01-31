<?php
 include "config.php";
 //EDYCJA OPISU ZDJECIA

 //$kategoria = $_POST['kategoria'];

 if(isset($_GET['kategoria']) )
 {
  $kategoria = $_GET['kategoria'];
  
  if(isset($_GET['edytuj']) )
 {
  $edytuj = $_GET['edytuj'];
 }
 ?>
 <div class="page-header">
  <h1>Edycja opisu zdjęcia</h1>
 </div>
 <div class="row">
  <div class="col-md-12">
   <div class="media">
    <a class="media-left" href="#"><img src="img/<?php echo $edytuj; ?>" alt="..." style="width:200px;"></a>
    <div class="media-body">
     <form action="editPhoto.php?kategoria=<?php echo $kategoria; ?>" method="post">
     <div class="form-group">
      <label for="nazwa">Opisz krótko to zdjęcie</label>
      <input type="text" id="nazwa" name="nazwa" class="form-control" required value="">
     </div>	
     <input type="hidden" name="edytuj" value="<?php echo $edytuj; ?>">
     <button type="submit" class="btn btn-primary">Zaktualizuj</button>
    </form>
   </div>
  </div>
 <?php
}

//JESLI NIE WYBRANO KATEGORII, CZYLI KROK 1/2...
if(!isset($kategoria))
{
 ?>
  <div class="page-header">
   <h1>Edycja zdjęć <span class="label label-default">Krok 1/2: wybierz kategorię</span></h1>
  </div>
  <div class="row">
   <div class="col-md-12">
    <table class="table">
    <thead>
     <tr>
      <th>ID</th>
      <th>Nazwa kategorii</th>
      <th>Opcje</th>
     </tr>
    </thead>
    <tbody>
     <?php
      $db = Db::getInstance();
      $results = Db::getCategoryList();
      foreach ($results as $row)
      {
	echo '<tr>';
	echo '<td>'.$row['id'].'</td><td>'.$row['nazwa'].'</td>'; 
	echo '<td><a href="editPhoto.php?kategoria='.$row['id'].'" type="button" class="btn btn-xs btn-primary">Wybierz kategorię</a></td>';
	echo '<input class=hidden name="kategoria" value="~'.$row['id'].'">';
	echo '</tr>';
      }
     ?>
    </tbody>
   </table>
 <?php
//JESLI WYBRANO KATEGORIE, CZYLI KROK 2/2...
} else 
{
 ?>
  <div class="page-header">
   <h1>Edycja zdjęć <span class="label label-default">Krok 2/2: wybierz zdjęcie</span></h1><a href="editPhoto.php" class="btn btn-xs btn-primary">Przejdź do innej kategorii</a>
  </div>
  <div class="row">
   <div class="col-md-12">
 <?php

//USUWANIE ZDJECIA - WPROWADZENIE DO BAZY
//sprawdzenie, czy jest zmienna

  
  if(isset($_GET['usun']))
  {
   $id = $_GET['usun'];
   $db = Db::getInstance();
   if($results = Db::removePhoto($id))
   {
    echo '<div class="alert alert-success" role="alert">Zdjęcie "'.$id.'" zostało pomyślnie usunięte.</div>'; 
   } else 
   {
    echo '<div class="alert alert-danger" role="alert">Błąd przy usuwaniu zdjęcia o identyfikatorze "'.$id.'".</div>';
   }	
  }

//ZMIANA OPISU ZDJECIA - WPROWADZENIE DO BAZY
//sprawdzenie, czy jest zmienna
if(isset($_POST['edytuj']) )
 {
  $id = $_POST['edytuj'];
 }
if(isset($_POST['nazwa']) )
 {
  $nazwa = $_POST['nazwa'];
 }
 

  //$id = $_POST['edytuj'];
  //$description = $_POST['nazwa'];
  if(isset($id) AND isset($nazwa))
  {
   $db = Db::getInstance();
   
   if($results = Db::changePhotoDescription($id, $nazwa))
   {		
    echo '<div class="alert alert-success" role="alert">Opis do zdjęcia "'.$id.'" został pomyślnie zmieniony.</div>'; 
   } else 
   {
    echo '<div class="alert alert-danger" role="alert">Błąd przy zmianie opisu do zdjęcia "'.$id.'".</div>';
   }
  }
 ?>

 <table class="table">
  <thead>
   <tr>
    <th>Podgląd</th>
    <th>ID zdjęcia</th>
    <th>Nazwa zdjęcia</th>
    <th>ID kategorii</th>
    <th>Opcje</th>
   </tr>
  </thead>
 <tbody>
<?php
 $db = Db::getInstance();
 $results = Db::getPhotoList($kategoria);
 foreach ($results as $row)
 {
  echo '<tr>';
  echo '<td><img src="img/'.$row['nazwa'].'" class="img-thumbnail" style="width:30px;height:30px;"></td>';
  echo '<td>'.$row['id'].'</td><td>'.$row['nazwa'].'</td><td>'.$row['id_kategorii'].'</td>'; 
  echo '<td><a href="editPhoto.php?kategoria='.$row['id_kategorii'].'&edytuj='.$row['id'].'" type="button" class="btn btn-xs btn-warning">Edytuj zdjęcie</a> <a href="editPhoto.php?kategoria='.$row['id_kategorii'].'&usun='.$row['id'].'" type="button" class="btn btn-xs btn-danger">Usuń zdjęcie</a></td>';
  echo '</tr>';
 }
?>

</tbody>
</table>
<?php
}
?>
 </div>
</div>