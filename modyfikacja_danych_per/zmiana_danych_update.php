<?php


/************************************************
 * Funkcja ktora tworzy obiekt i aktualizuje dane
 * personalne.
 ************************************************/





function zmiana_danych(){

//echo 'Zmiana danych 1.0<br>';


//echo 'test:'.$_POST['imie'];

$zmiana_danych_per = new modyfikacja_danych();

$aktualizacja = $zmiana_danych_per->aktualizuj_dane(
$_POST['haslo'],$_POST['imie'],$_POST['nazwisko'],$_POST['telefon'],$_POST['miasto'],
$_POST['ulica'],$_POST['kod_pocztowy'],$_POST['e_mail'],$_POST['opis']);


echo '<div class="container">';

if($aktualizacja){
  echo '<br><b>Aktualizacja danych powiodła się</b>';

  echo
  '<br><br><br>
  <b>Za chwile zostaniesz wylogowany</b>
  	<script type="text/javascript">
  				setTimeout(function(){
  					window.location.href = "panel_logowania/wyloguj.php";
  				},2000);
  				</script>';

  echo '</div>';
}
else{ echo '<p><h4>Problem z aktualizacja sprawdz czy poprawnie wstawiłeś dane.</h4><br></p>';

  echo
  '<br><br><br>
  <b>Za chwile wrócisz na stronę dane personalne</b>
  	<script type="text/javascript">
  				setTimeout(function(){
  					window.location.href = "index.php?subpage=dane_personalne";
  				},5000);
  				</script>';
}



}



?>
