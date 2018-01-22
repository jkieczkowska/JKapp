<?php
include "config.php";
//sprawdzenie, czy jest wysłany formularz
if( $_POST )
{
	//deklarowanie zmiennych
	$kategoria = $_POST['kategoria'];

	//DODANIE PLIKU DO BAZY DANYCH
	//pobieranie danych do połączenia
	$connect = mysqli_connect("localhost", "root", "", "jkapp");
	$connect->set_charset("utf8");
 	
	//definiuje zapytanie - pobiera ostatni ID z tabeli zdjęcia
	$sql = "SELECT MAX(id) FROM zdjecia;";
	
	$result = mysqli_query($connect, $sql);
	while( $row = mysqli_fetch_array($result) )
	{
		//przypisuje ostatni ID zmiennej $najwiekszeID i powiększa o 1
		$najwiekszeID = $row[0]+1;
	}
	
	//echo "nid = ".$najwiekszeID."  <br> ";
	
	//echo "ilosc = ".count($_FILES['plik']['size']);
	
	
	//WYSYŁANIE PLIKU NA SERWER
	for( $i=0; $i<count($_FILES['plik']['size']); $i++ )
	{ 
		//echo "do dodania". $_FILES['plik']['type'][$i];

		if( strstr($_FILES['plik']['type'][$i], 'image')!==false )
		{ 
			//zmienia nazwę pliku, by zgadzały się z ID w bazie danych
			$file = 'img/'.$najwiekszeID.'.jpg'; 
			//wysyła plik na serwer
			move_uploaded_file($_FILES['plik']['tmp_name'][$i], $file); 

			//dodaje wpis do bazy danych
			$sql = "INSERT INTO zdjecia SET id_kategorii = '$kategoria';";
			//wyświetlenie komunikatu o powodzeniu, lub niepowodzeniu
			if( $connect->query($sql)== TRUE )
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
			echo '<div class="alert alert-success" role="alert">Zdjęcia zostały zapisane na serwerze.</div>';
			//zwiększa ID dla kolejnych zdjęć w pętli
			$najwiekszeID++;
		} 
	}
} else
	//echo "Brak kategorii";
?>

<div class="row">
	<div class="col-md-5">
		<form action="dodajzdjecia.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="kategoria">Wybierz kategorię</label>
				<select id="kategoria" name="kategoria" class="form-control">

				<?php
					//pobieranie danych do połączenia
					$connect = mysqli_connect("localhost", "root", "", "jkapp");
					 $connect->set_charset("utf8");
					//definiuje zapytanie
					$sql = "SELECT id, nazwa FROM kategoria;";
					$result = mysqli_query($connect, $sql);
					//wyświetla wynik
					while( $tabela = mysqli_fetch_array($result) ){ 
						echo '<option value="'.$tabela['id'].'">'.$tabela['nazwa'].'</option>'; 
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