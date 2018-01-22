<?php
include "config.php";
?>

<?php
//sprawdzenie, czy jest zmienna

if( isset($_GET['id']) )
{
  $id = $_GET['id'];

 $connect = mysqli_connect("localhost", "root", "", "jkapp");
 $connect->set_charset("utf8");

//definiuje zapytanie
 $sql = "DELETE FROM kategoria WHERE id = $id;";
 $result = mysqli_query($connect, $sql);
if( $connect->query($sql)== TRUE ){
								?>
                                <script>window.location.href='removeCategory.php'</script>
                                <?php 
	echo '<div class="alert alert-success" role="alert">Kategoria "'.$id.'" została pomyślnie usunięta.</div>'; 
	
	
} else {
    echo '<div class="alert alert-danger" role="alert">Błąd przy usuwaniu kategorii o identyfikatorze "'.$id.'".</div>';
}

}
?>

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
 $connect = mysqli_connect("localhost", "root", "", "jkapp");
 $connect->set_charset("utf8");

//definiuje zapytanie
$sql = "SELECT * FROM kategoria;";
$result = mysqli_query($connect, $sql);
//wyświetla wynik
while( $tabela = mysqli_fetch_array($result) ){ 
	echo '<tr>';
	echo '<td>'.$tabela['id'].'</td><td>'.$tabela['nazwa'].'</td>'; 
	echo '<td><a href="usunkategorie.php?id='.$tabela['id'].'" type="button" class="btn btn-xs btn-danger">Usuń kategorię</a></td>';
	echo '</tr>';
}


?>
</tbody>
</table>

</div>
</div>