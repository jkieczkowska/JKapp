<?php
include "config.php";
session_start();
if(!isset($_SESSION['username'])){
    header('location:login.php');
}
?>
<div class="page-header">
	<h1>Usuń kategorię</h1>
</div>

<?php
//sprawdzenie, czy jest zmienna

if( isset($_POST['nazwa']) ){
$nazwa = $_GET['nazwa'];
 $connect = mysqli_connect("localhost", "root", "", "jkapp");
 $connect->set_charset("utf8");

//definiuje zapytanie
$sql = "DELETE FROM kategoria WHERE id = '$nazwa';";
$result = mysqli_query($connect, $sql);
if( $connect->query($sql)== TRUE ){
	echo '<div class="alert alert-success" role="alert">Kategoria "'.$nazwa.'" została pomyślnie usunięta.</div>'; 
} else {
    echo '<div class="alert alert-danger" role="alert">Błąd przy usuwaniu kategorii o identyfikatorze "'.$nazwa.'".</div>';
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
	echo '<td><a href="usunkategorie&nazwa='.$tabela['id'].'" type="button" class="btn btn-xs btn-danger">Usuń kategorię</a></td>';
	echo '</tr>';
}


?>
</tbody>
</table>

</div>
</div>