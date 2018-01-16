<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Justyna Kięczkowska - DIY</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
</head>
<body>

<div class="container">
<!-- Static navbar -->

<nav class="navbar navbar-default" role="navigation">
<div class="container-fluid">

<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	<span class="sr-only">Toggle navigation</span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
</button>

<a class="navbar-brand" >Justyna Kięczkowska - DIY</a>
</div>

<?php
//jeśli nie wybrano kategorii, czyli krok 1/2 to...

if( !isset($_GET['kategoria']) ){
	$zmienna = 'zmienna';
	//$kategoria = ($_GET['kategoria']);
?>

<div class="page-header">
	<h1>Kategorie zdjęć</h1>
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
 $connect = mysqli_connect("localhost", "root", "", "jkapp");
 $connect->set_charset("utf8");
include "config.php";
//definiuje zapytanie
$sql = "SELECT * FROM kategoria;";
$result = mysqli_query($connect, $sql);
//wyświetla wynik
while( $tabela = mysqli_fetch_array($result) ){ 

	echo '<tr>';
	echo '<td>'.$tabela['id'].'</td><td>'.$tabela['nazwa'].'</td>'; 
	echo '<td><a href="galeria.php?kategoria='.$tabela['id'].'" type="button" class="btn btn-xs btn-primary">Przejdź do kategorii</a></td>';
	echo '</tr>';
}

?>
</tbody>
</table>

</div>
</div>

<?php
//jeśli wybrano kategorię, czyli krok 2/2 to...
}else{

//pobieranie danych do połączenia
 $connect = mysqli_connect("localhost", "root", "", "jkapp");
 $connect->set_charset("utf8");


//definiuje zapytanie
$kategoria = ($_GET['kategoria']);
$sql = "SELECT nazwa FROM kategoria WHERE id = '$kategoria';";
$result = mysqli_query($connect, $sql);
//wyświetla wynik
while( $tabela = mysqli_fetch_array($result) ){ 
	echo '<div class="page-header"><h1>Zdjęcia w kategorii: "'.$tabela['nazwa'].'" </h1><a href="galeria.php" class="btn btn-xs btn-primary">Przejdź do innej kategorii</a></div><div class="row"><div class="col-md-12">';
}

//definiuje zapytanie
$kategoria = ($_GET['kategoria']);
$sql = "SELECT * FROM zdjecia WHERE id_kategorii = '$kategoria';";
$result = mysqli_query($connect, $sql);
//wyświetla wynik
while( $tabela = mysqli_fetch_array($result) ){ 
	echo '<div class="col-xs-6 col-md-3"><a href="img/'.$tabela['id'].'.jpg" class="thumbnail"><img src="img/'.$tabela['id'].'.jpg" alt="">&nbsp;'.$tabela['nazwa'].'</a></div>';
}


?>
</tbody>
</table>

</div>
</div>

<?php } ?>

</div> <!-- /container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>