<?php
include "config.php";

?><div class="page-header">
	<h1>Dodaj kategorię</h1>
</div>
<?php
 $connect = mysqli_connect("localhost", "root", "", "jkapp");
 $connect->set_charset("utf8");
 ?>
<?php
//sprawdzenie, czy jest wysłany formularz
include "config.php";
if( isset($_POST['nazwa'])){
$nazwa =( $_POST['nazwa']);
//definiuje zapytanie
$sql = "INSERT INTO kategoria (nazwa) values ('$nazwa');";

//wyświetlenie komunikatu o powodzeniu, lub niepowodzeniu
							if($connect->query($sql)== TRUE){
                                ?>
                                <script>window.location.href='data.php'</script>
                                <?php }

                            else{
                                ?>
                                  <div class="alert alert-danger alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <strong>Upss!</strong>Coś poszło nie tak.
</div>
                                <?php
	}



}
?>

<div class="row">
<div class="col-md-5">

<form action="dodajkategorie" method="post">
<div class="form-group">
	<label for="nazwa">Podaj nazwę nowej kategorii</label>
    <input type="text" id="nazwa" name="nazwa" class="form-control" required>
</div>

  <button type="submit" class="btn btn-primary">Dodaj kategorię</button>
</form>

</div>
</div>