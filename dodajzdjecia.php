<?php
include "config.php";

//sprawdzenie, czy jest wysłany formularz


if(isset($_POST['kategoria']))
{
	$kategoria = $_POST['kategoria'];
	//deklarowanie zmiennych
	// https://stackoverflow.com/questions/3532776/replace-null-with-0-in-mysql
	//$stmt = $db->prepare("SELECT IFNULL(max(id), -1) FROM zdjecia;"); 
	//$stmt->execute(); 
	//$row = $stmt->fetch();
	//$najwiekszeID = $row['0'] + 1;
	//echo "nid = ".$najwiekszeID."  <br> ";
	//echo "ilosc = ".count($_FILES['plik']['size']);

	for( $i=0; $i<count($_FILES['plik']['size']); $i++ )
	{ 
		//echo "do dodania = ". $_FILES['plik']['name'][$i]."<br>";
		if(strstr($_FILES['plik']['type'][$i], 'image') !== false )
		{ 
			$nazwa = $_FILES['plik']['name'][$i];
			//zmienia nazwę pliku, by zgadzały się z ID w bazie danych
			$file = 'img/'.$nazwa; 
			//wysyła plik na serwer
			move_uploaded_file($_FILES['plik']['tmp_name'][$i], $file); 

			//dodaje wpis do bazy danych
			//$sql = "INSERT INTO zdjecia values (id_kategorii, nazwa) values (?,?);";
			//wyświetlenie komunikatu o powodzeniu, lub niepowodzeniu
			echo "blabla $nazwa $kategoria";
			$db = Db::getInstance();
			if($results = Db::addPhotoToCategory($nazwa, $kategoria))
			{
				?>
					<script>window.location.href='addPhoto.php'</script>
				<?php 
				echo '<div class="alert alert-success" role="alert">Zdjęcia zostały zapisane w bazie danych.</div>'; 
			} else {
				?>
					<script>window.location.href='addPhoto.php'</script>
				<?php 
				echo '<div class="alert alert-danger" role="alert">Błąd przy zapisie zdjęć do bazy danych.</div>';
			}
			
			//wyświetla komunikat o powodzeniu
			//echo '<div class="alert alert-success" role="alert">Zdjęcia zostały zapisane na serwerze.</div>';
			//zwiększa ID dla kolejnych zdjęć w pętli
			//$najwiekszeID++;
		} 
	}
}
 //else
	//echo "Brak kategorii";
?>

<div class="row">
	<div class="col-md-5">
		<form action="addPhoto.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="MAX_FILE_SIZE" value="6000000" />
			<div class="form-group">
				<label for="kategoria">Wybierz kategorię</label>
				<select id="kategoria" name="kategoria" class="form-control" value="1">

				<?php
					//pobieranie danych do połączenia
					//foreach($db->query('SELECT id, nazwa FROM kategoria;') as $tabela) 
					$db = Db::getInstance();
					$results = Db::getCategoryList();
					foreach ($results as $row)
					{
						echo '<option value="'.$row['id'].'">'.$row['nazwa'].'</option>'; 
					}
				?>
				
				</select>
			</div>
			<div class="form-group">
				<label for="pliki">Wybierz zdjęcia</label>
				<input type="file" id="pliki" multiple="multiple" name="plik[]">
			</div>
			<button type="submit" name="wyslij" class="btn btn-primary">Dodaj zdjęcia</button>
		</form>
	</div>
</div>