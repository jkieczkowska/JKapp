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
    <title>Justyna Kięczkowska - DIY</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style3.css">
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
							 $connect = mysqli_connect("localhost", "root", "", "jkapp");
							 $connect->set_charset("utf8");
							 
							 if( isset($_GET['kategoria'])){
								$kategoria =( $_GET['kategoria']);
							 } else $kategoria = 1;
							 ?>
							<!DOCTYPE html>
							<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl">
							<head>
								<title>Galeria</title>
								<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
								<script type="text/javascript" src="javascript/highslide-with-gallery.js"></script>
								<link rel="stylesheet" href="css2/style.css" type="text/css" media="screen" />
							<script type="text/javascript">
								hs.graphicsDir = 'javascript/images/';
								hs.align = 'center';
								hs.transitions = ['expand', 'crossfade'];
								hs.outlineType = 'rounded-white';
								hs.fadeInOut = true;
								//hs.dimmingOpacity = 0.75;

								// Add the controlbar
								if (hs.addSlideshow) hs.addSlideshow({
									//slideshowGroup: 'group1',
									interval: 5000,
									repeat: false,
									useControls: true,
									fixedControls: 'fit',
									overlayOptions: {
										opacity: .75,
										position: 'bottom center',
										hideOnMouseOut: true
									}
								});
							</script>
							</head>
							<body>

							<form action="galeria3.php" method="get" id="nameform">
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
								echo '<option value="'.$tabela['id'].'"';
								if($tabela['id'] == $kategoria) echo ' selected="selected" ';
								echo '>'.$tabela['nazwa'].'</option>'; 
								
							}
							?>
							</select>
							</form>

								<button type="submit" form="nameform" value="Submit">Submit</button>
								
							<div id="galeria">
							<ul>
							<?php
							$sql = "SELECT id FROM zdjecia where id_kategorii = $kategoria;";
							$result = mysqli_query($connect, $sql);
							//wyświetla wynik

							$ilosc = mysqli_num_rows( $result);

							//katalog z dużymi obrazkami
							$katalog = "img";

							$i = 0;
							while( $tabelax = mysqli_fetch_array($result) ){ 
								//echo '<tr>';
								//echo '<td>'.$tabela['id'].'</td><td>'.$tabela['nazwa'].'</td>'; 
								//echo '<td><a href="usunkategorie.php?id='.$tabela['id'].'" type="button" class="btn btn-xs btn-danger">Usuń kategorię</a></td>';
								//echo '</tr>';
								//echo "nazwa ->".$tabelax['id'];
								
								$tab[$i] = $katalog.'/'.$tabelax['id'].'.jpg';
								$i++;
							}

							//katalog z miniaturkami
							$katalogMiniaturki = "img";

							//ilość zdjęć na stronie
							$naStronie = 12;

							//czy ma być opis zdjęcia - jego numer - true to tak, false to nie
							$opisZdjecia = true;

							//ilość stron
							if($ilosc > 0)
							$iloscStron = ceil($ilosc/$naStronie);
							else $iloscStron = 0;

							//sortowanie tablicy
							if($ilosc > 0)
							sort($tab);

							for($i = 0; $i < $ilosc; $i++)
							{
							if($opisZdjecia) $opisZdjecia = '<span>Obrazek nr '.$i.'</span>';
							  $tablica[$i] = '<li><a href="'.$tab[$i].'" class="highslide" onclick="return hs.expand(this)" title="Obrazek nr '.$i.'"><img width="200" height="133" src="'.str_replace($katalog, $katalogMiniaturki, $tab[$i]).'" alt="Obrazek nr '.$i.'" />'.$opisZdjecia.'</a></li>';
							}

							if($ilosc <= 0)
								echo "Brak obrazów dla tej kategorii";


							//sprawdza aktualny numer strony
							if(isset($_GET['strona']) && $_GET['strona'] > 0 && $_GET['strona'] <= $iloscStron) 
								$strona = $_GET['strona'] - 1;
							else $strona = 0;

							$poczatek = $strona * $naStronie;
							if($poczatek >= $ilosc) $poczatek = 0;

							$koniec = $poczatek + $naStronie;
							if($koniec >= $ilosc) $koniec = $ilosc;

							//generowanie wykazu
							for($i = $poczatek; $i < $koniec; ++$i){
							  echo $tablica[$i]."\n";
							}
							?>
							</ul>
							<ul id="nawigacja">
							<?php
							echo "<br>";
							//link do poprzedniej strony
							if($strona > 0) echo '<li><a href="galeria3.php?strona='.($strona).'" >[<]</a></li>';

							for($i = 1; $i <= $iloscStron; ++$i){
							//linki do poszczególnych stron
							  echo '<li><a href="galeria3.php?strona='.$i.'" >['.$i.']</a></li>';
							}
							//echo $linki;

							//link do następnej strony
							if($strona < ($iloscStron - 1)) echo '<li><a href="galeria3.php?strona='.($strona+2).'" >[>]</a></li>';
							?>
							</ul>
							</div>
							</body>
							</html>
                                         
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
