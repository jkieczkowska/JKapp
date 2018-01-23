<?php
include "config.php";
session_start();
if(!isset($_SESSION['username'])){
    header('location:login.php');
}
?>

<?php
 $connect = mysqli_connect("localhost", "root", "", "stronka");
 $connect->set_charset("utf8");
 ?>
<!DOCTYPE html>
<html lang="pl_PL">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edytuj zdjęcia</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>


    <?php
      include "navbar.php";
      ?>

        <div class="container">
            <div class="row">

                <?php
                include "menu.php";
                ?>

                <div class="col-md-9">
                    <div class="panel panel-default">
                    <div class="panel-body">
                     
                        <?php

								include "config.php";
								?>
								<?php
								//pobieranie danych do połączenia
								 $connect = mysqli_connect("localhost", "root", "", "jkapp");
								 $connect->set_charset("utf8");
								?>

								<?php
								//EDYCJA OPISU ZDJECIA
								if( isset($_GET['edytuj']) ){
									$edytuj = $_GET['edytuj'];
									$kategoria = $_GET['kategoria'];
								?>
								<div class="page-header">
									<h1>Edycja opisu zdjęcia</h1>
								</div>

								<div class="row">
								<div class="col-md-12">

								<div class="media">
									<a class="media-left" href="#"><img src="img/<?php echo $edytuj; ?>.jpg" alt="..." style="width:200px;"></a>
								  
									<div class="media-body">
									<form action="edytujzdjecia.php?kategoria=<?php echo $kategoria; ?>" method="post">
										<div class="form-group">
											<label for="nazwa">Opisz krótko to zdjęcie</label>
											<input type="text" id="nazwa" name="nazwa" class="form-control" required>
										</div>
									
										<input type="hidden" name="edytuj" value="<?php echo $edytuj; ?>">
										<button type="submit" class="btn btn-primary">Zaktualizuj</button>
									</form>
									</div>
								</div>

								<?php
								}

								//JESLI NIE WYBRANO KATEGORII, CZYLI KROK 1/2...
								if( !isset($_POST['kategoria'])){

								?><div class="page-header">
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

								//definiuje zapytanie
								$sql = "SELECT * FROM kategoria;";
								$result = mysqli_query($connect, $sql);
								//wyświetla wynik
								while( $tabela = mysqli_fetch_array($result) ){ 
									echo '<tr>';
									echo '<td>'.$tabela['id'].'</td><td>'.$tabela['nazwa'].'</td>'; 
									echo '<td><a href="edytujzdjecia.php?kategoria='.$tabela['id'].'" type="button" class="btn btn-xs btn-primary">Wybierz kategorię</a></td>';
									echo '</tr>';
								}
								?>
								</tbody>
								</table>

								<?php
								//JESLI WYBRANO KATEGORIE, CZYLI KROK 2/2...
								}else{
								?>

								<div class="page-header">
									<h1>Edycja zdjęć <span class="label label-default">Krok 2/2: wybierz zdjęcie</span></h1><a href="edytujzdjecia.php" class="btn btn-xs btn-primary">Przejdź do innej kategorii</a>
								</div>

								<div class="row">
								<div class="col-md-12">

								<?php
								//USUWANIE ZDJECIA - WPROWADZENIE DO BAZY
								//sprawdzenie, czy jest zmienna

								if( isset ($_GET['usun']) ){
								$usun = $_GET['usun'];
									//definiuje zapytanie
									$sql = "DELETE FROM zdjecia WHERE id = '$usun';";

									if( $connect->query($sql)== TRUE ){
										echo '<div class="alert alert-success" role="alert">Zdjęcie "'.$usun.'" zostało pomyślnie usunięte.</div>'; 
									} else {
									  echo '<div class="alert alert-danger" role="alert">Błąd przy usuwaniu zdjęcia o identyfikatorze "'.$usun.'".</div>';
									}
									
								}

								//ZMIANA OPISU ZDJECIA - WPROWADZENIE DO BAZY
								//sprawdzenie, czy jest zmienna

								if( isset ($_POST['edytuj']) AND isset ($_POST['nazwa'])){
								$edytuj = $_POST['edytuj'];
								$nazwa = $_POST['nazwa'];
									//definiuje zapytanie
									$sql = "UPDATE zdjecia SET nazwa = '$nazwa' WHERE id = '$edytuj';";

									if( $connect->query($sql)== TRUE ){
										echo '<div class="alert alert-success" role="alert">Opis do zdjęcia "'.$edytuj.'" został pomyślnie zmieniony.</div>'; 
									} else {
									  echo '<div class="alert alert-danger" role="alert">Błąd przy zmianie opisu do zdjęcia "'.$edytuj.'".</div>';
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
								//definiuje zapytanie
								$sql = "SELECT * FROM zdjecia WHERE id_kategorii = '$kategoria';";
								$result = mysqli_query($connect, $sql);
								//wyświetla wynik
								while( $tabela = mysqli_fetch_array($result) ){ 
									echo '<tr>';
									echo '<td><img src="img/'.$tabela['id'].'.jpg" class="img-thumbnail" style="width:30px;height:30px;"></td>';
									echo '<td>'.$tabela['id'].'</td><td>'.$tabela['nazwa'].'</td><td>'.$tabela['id_kategorii'].'</td>'; 
									echo '<td><a href="edytujzdjecia.php?kategoria='.$tabela['id_kategorii'].'&edytuj='.$tabela['id'].'" type="button" class="btn btn-xs btn-warning">Edytuj zdjęcie</a> <a href="kokpit.php?p=edytujzdjecia&kategoria='.$tabela['id_kategorii'].'&usun='.$tabela['id'].'" type="button" class="btn btn-xs btn-danger">Usuń zdjęcie</a></td>';
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
                    </div>
                </div>
                </div>
            </div>
        </div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
