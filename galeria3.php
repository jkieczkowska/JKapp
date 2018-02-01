<?php

include "config.php";

if(isset($_GET['kategoria']))
{
	$kategoria =( $_GET['kategoria']);
} else $kategoria = "all";

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

<form action="photos.php" method="get" id="nameform">
	<label for="kategoria">Wybierz kategorię</label>
    <select id="kategoria" name="kategoria" class="form-control">
<?php

//wyświetla wynik

	echo '<option value="all"';
	if($kategoria == "all") echo ' selected="selected" ';
	echo '>Wszystko</option>';

	$db = Db::getInstance();
	$results = Db::getCategoryList();
	foreach ($results as $row)
	{
		echo '<option value="'.$row['id'].'"';
		if($row['id'] == $kategoria) echo ' selected="selected" ';
		echo '>'.$row['nazwa'].'</option>'; 	
	}
?>
</select>
</form>
	<button type="submit" form="nameform" value="Submit">Submit</button>
	
<div id="galeria">
<ul>
<?php


//katalog z dużymi obrazkami
$katalog = "img";

$i = 0;

$db = Db::getInstance();
$results = Db::getPhotoList($kategoria);
foreach ($results as $tabela)
//foreach($db->query($sql) as $tabela) 
{
	$tab[$i] = $katalog.'/'.$tabela['nazwa'];
	$desc[$i] = $tabela['opis'];
	$i++;
}


$ilosc = $i;

//katalog z miniaturkami
$katalogMiniaturki = "img";

//ilość zdjęć na stronie
$naStronie = 6;

//czy ma być opis zdjęcia - jego numer - true to tak, false to nie
$opisZdjecia = true;

//ilość stron
if($ilosc > 0)
$iloscStron = ceil($ilosc/$naStronie);
else $iloscStron = 0;

//sortowanie tablicy
//if($ilosc > 0)
//sort($tab);

for($i = 0; $i < $ilosc; $i++)
{
if($opisZdjecia) $opisZdjecia = '<span>Obrazek nr '.$i.'</span>';
  $tablica[$i] = '<li><a href="'.$tab[$i].'" class="highslide" onclick="return hs.expand(this)" title="Opis: '.$desc[$i].'"><img width="200" height="133" src="'.str_replace($katalog, $katalogMiniaturki, $tab[$i]).'" alt="Obrazek nr '.$i.'" />'.$opisZdjecia.'</a></li>';
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
							if($strona > 0) echo '<li><a href="photos.php?strona='.($strona)."&kategoria=".($kategoria).'" >[<]</a></li>';

							for($i = 1; $i <= $iloscStron; ++$i){
							//linki do poszczególnych stron
							  echo '<li><a href="photos.php?strona='.$i."&kategoria=".($kategoria).'" >['.$i.']</a></li>';
							}
							//echo $linki;

							//link do następnej strony
							if($strona < ($iloscStron - 1)) echo '<li><a href="photos.php?strona='.($strona+2)."&kategoria=".($kategoria).'" >[>]</a></li>';
							?>
							</ul>
</div>
</body>
</html>