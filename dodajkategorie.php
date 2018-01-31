<?php
include "config.php";

//sprawdzenie, czy jest wysłany formularz
if(isset($_POST['nazwa']))
{
	$nazwa =($_POST['nazwa']);
	
	//$db = Db::getInstance();
	//echo "sdfasd";	
        //$sth = $db->prepare("INSERT INTO kategoria (nazwa) values ('$nazwa');");
	//if ($sth->execute())
	$db = Db::getInstance();
        if($results = Db::addCategory($nazwa))
        {
	    ?>
              <script>window.location.href='data.php'</script>
            <?php 
	}
        else 
        {
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
<form action="dodajkategorie.php" method="post">
<div class="form-group">
	<label for="nazwa">Podaj nazwę nowej kategorii</label>
    <input type="text" id="nazwa" name="nazwa" class="form-control" required>
</div>
  <button type="submit" class="btn btn-primary">Dodaj kategorię</button>
</form>
</div>
</div>