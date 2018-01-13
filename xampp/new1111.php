<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
 <html>
 <head>
 <title>Serwis ABC</title>
 <meta http-equiv=content-type content="text/html; charset=iso-8859-2">
 <meta http-equiv="Content-Language" content="pl">
 </head>

 <body>
 <?php

 ////////////////////////////////////////////////////////////
 //Przyk�ad kodu wprowadzaj�cego dane do bazy mysql
 //Sposob dzialania kodu:
 //Kod obrazuje zapisywanie sie na listy dystrybucyjna newslettera
 //Po otwarciu strony uzytkownik widzi formularz gdzie musi podac:
 //   * imie
 //   * nazwisko
 //   * adres mail
 //Po kliknieciu przycisku "Zaloguj" kod prawdza czy podane sa wszystkie
 //pola (imie, nazwisko, mail) oraz usuwa biale znaki z poczaku i konca
 //kazdego pola
 //   Jesli podane sa wszystkie pola to sa one wprowadzane do bazy mysql
 //   Jesli nie sa podane wszystkie pola to wyswietlana jest informacja
 //       o bledzie i wyswietlany jest ponownie formularz zapisu na
 //       newsletter
 //Ograniczenia programu
 //  1. Program nie sprawdza czy uzytkownik juz istnieje w bazie
 //  2. Program nie sprawdza czy adres mail ma poprawna skladnie
 //Wymagania
 //  1. Zalozona baza mysql na serwerze
 //  2. Tabela newsletter w bazie mysql z polami imie, nazwisko, mail
 ////////////////////////////////////////////////////////////

 ////////////////////////////////////////////////////////////
 //Definicje zmiennych

 //adres ip serwera mysql kt�ry zawiera baz� danych i tabele z osobami
 //zapisanymi na list� dystrybucyjna newslettera
 $adres_ip_serwera_mysql_z_baza_danych = '127.0.0.1';

 //nazwa bazy danych z tabel� newsletter zawieraj�c� osoby zapisane na
 //list� dystrybucyjna newslettera
 $nazwa_bazy_danych = 'moja_baza';

 //nazwa uzytkownika bazy danych $nazwa_bazy_danych
 $login_bazy_danych = 'user_test';

 //haslo uzytkownika bazy danych $nazwa_bazy_danych
 $haslo_bazy_danych = 'haslo_test';

 //Formularz umozliwiajacy dopisanie si� do bazy danych czyli zapisanie
 //si� na liste dystrybucyjna newslettera
 //Formularz bedzie pokazywany gdy strona wyswietlana pierwszy raz
 //lub gdy u�ytkownik poda bledne lub niepelne dane
 $formularz_dodaj_uzytkownika = '
 <FORM method="POST" action="">
 Ime: <INPUT type="text" name="imie">
 <br />Nazwisko: <INPUT type="text" name="nazwisko">
 <br />Mail: <INPUT type="text" name="mail">
 <br /><INPUT type="submit" value="Zapisz si�!">
 </FORM>
 ';

 ////////////////////////////////////////////////////////////
 //Kod programu

 //Ustanawiamy po��czenie z serwerem mysql
 if ( !mysql_connect($adres_ip_serwera_mysql_z_baza_danych,

     $login_bazy_danych, $haslo_bazy_danych) ) {
    echo 'Nie moge polaczyc sie z baza danych';
 	 exit (0);
 }
 //Wybieramy baze danych na serwerze mysql ktora zawiera tabele
 //newsletter gdzie sa dane osob z listy dystrybucyjnej
 if ( !mysql_select_db($nazwa_bazy_danych) ) {
    echo 'Blad otwarcia bazy danych';
 	 exit (0);
 }

 //Sprawdzamy czy formularz zosta� zaakceptowany - czyli czy zmienna
 //$_POST["mail"] jest zdefiniowana
 //Jesli zmienna $_POST["mail"] nie jest zdefiniowana to strona jest
 //wyswietlana po raz pierwszy i wyswietlimy formularz dodania do
 //newslettera
 //Jesli zmienna $_POST["mail"] jest zdefiniowana to strona byla
 //wczesniej wyswietlana i formularz dodania do newslettera zostal
 //zaakceptowany. Musimy sprawdzic poprawnosc danych (poprawne to
 //dodajemy nowa osobe na liste dystrybucujna, niepoprawne to wyswietlamy
 //komunikat bledu i ponownie wysiwetlamy formularz)
 if ( isset($_POST["mail"]) ){
 //Jesli zmienna $_POST["mail"] jest zdefiniowana to znaczy, ze nasza
 //strona jest wyswietlana po raz kolejny. Wczesniej ktos wypelnil
 //formularz i wcisnal przycisk "Zapisz si�!"

 //Porzadkujemy dane wprowadzone przez uzytkownika
    SkorygujZmienneZFormularza($imie,$nazwisko,$mail);
 //Sprawdzamy czy uzytkownik podal poprawne dane
    $czy_poprawne_dane = SprawdzPoprawnoscDanych ($imie, $nazwisko,

                       $mail);
    if ($czy_poprawne_dane == "dane_ok") {
 //Jesli podane przez uzytkownika dane sa ok to wprowadzamy je do tabeli

 //Definiujemy zapytanie do tabeli newsletter wpisujace dane nowego
 //subskrybenta
       $zapytanie = "INSERT INTO `newsletter` (`UID`, `Imie`, `Nazwisko`,

         			`Mail`) ";
       $zapytanie .= "VALUES ('', '$imie', '$nazwisko', '$mail')";
 //Wykonujemy zapytanie na bazie mysql
       $wynik_zapytania = mysql_query($zapytanie);
 //Sprawdzamy cz baza danych zwrocila blad
       if (!$wynik_zapytania) {
 //Jesli baza danych zwrocila blad to wyswietlamy komunikat o problemie
 //z baza danych
          echo("<br />Nie moge doda� rekordu do bazy!<br /><br />");
       } else {
 //Jesli dodanie subskrybenta sie udalo to wyswietlamy gratulacje oraz
          echo "Gratulacje!!!";
          echo "<br />W�a�nie zosta�e� zapisany na list� dystrybucyjn�

      naszego wspania�ego newslettera!!!!";
       }
    } else {
 //Jesli podane przez uzytkownika dane sa niepoprawne to informujemy
 //o bledzie i ponownie wysiwetlamy komunkat
       echo "Wprowadziles niepoprawne dane do formularza.
                  By� mo�e nie wszystkie pola sa wypelnione";
       echo "<br />Spr�buj ponownie:";
       echo $formularz_dodaj_uzytkownika;
    }
 } else {
 //Jesli nasza strona jest wyswietlana po raz pierwszy (zmienna
 //$_POST["mail"] niejest zdefiniowana) to
 //   * zachecamy do zapisania sia na liste newslettera
 //   * wyswietlamy formularz pozwalajacy pdoac nowego subskrybenta
    echo "Zapisz si� <strong>TERAZ</strong> na list� dystrybucyjn�
 	       naszego wspania�ego newslettera.";
    echo $formularz_dodaj_uzytkownika;
 }

 //Zamykamy po��czenie z baz� danych
 if ( !mysql_close() ) {
    echo 'Nie moge zakonczyc polaczenia z baza danych';
    exit (0);
 }

 ////////////////////////////////////////////////////////////
 //Dodatkowe funkcje

 ////////////////////////////////////////////////////////////
 //// Funkcja SkorygujZmienneZFormularza(&$imie,&$nazwisko,&$mail) ////
 //Funkcja porz�dkuje dane wprosprawdzone do formularza:
 //Jesli pole nie zostalo wproawadzone to zmienna ma pusta wartosc ("")
 //Jesli pole zostalo wproawadzone to ma obcinane puste spacje z obu
 //stron
 //////////////////////////////////////////////////////////////////////
 function SkorygujZmienneZFormularza(&$imie,&$nazwisko,&$mail) {
 if ( isset($_POST["imie"]) )
    $imie = trim($_POST["imie"]);
 else
    $imie = "";
 if ( isset($_POST["nazwisko"]) )
    $nazwisko = trim($_POST["nazwisko"]);
 else
    $nazwisko = "";
 if ( isset($_POST["mail"]) )
    $mail = trim($_POST["mail"]);
 else
    $mail = "";
 }

 ////////////////////////////////////////////////////////////
 //// Funkcja SprawdzPoprawnoscDanych ($imie, $nazwisko, $mail) ////
 //Funkcja sprawdza czy podane przez uzytkownika dane sa poprawne czyli
 //czy nie sa puste
 //Jesli ktorekolwiek pole $imie lub $nazwisko lub $mail jest puste to
 //zwracany jest komunikat o niepoprawnych danych (zle_dane)
 //Jesli wszystkie pola $imie lub $nazwisko lub $mail s� wype�nione to
 //zwracany jest komunikat o poprawnych danych (dane_ok)
 ////////////////////////////////////////////////////////////////////////
 function SprawdzPoprawnoscDanych ($imie, $nazwisko, $mail) {
  if ( ($imie=="") || ($nazwisko=="") || ($mail=="") )
     return "zle_dane";
  return "dane_ok";
 }

 ?>
 </body>
 </html>
