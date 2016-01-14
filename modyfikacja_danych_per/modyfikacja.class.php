<?php







/****************************************************
 * Klasa w ktorej sa modyfikowane dane personalne
 ****************************************************/



class modyfikacja_danych extends main {



public function aktualizuj_dane($haslo,$imie,$nazwisko,$telefon,$miasto,$ulica,$kod_pocztowy,$e_mail,$opis){


  $this->connect_sql();


  $sql_dane_per = "UPDATE uzytkownik
    SET haslo='".$this->szyfruj($haslo)."', imie='".$imie."', nazwisko='".$nazwisko."', telefon='".$telefon."', miasto='".$miasto."', ulica='".$ulica."',
     kod_pocztowy='".$kod_pocztowy."', email='".$e_mail."', opis='".$opis."'
    WHERE ID='".$_SESSION['ID']."';";

  if(mysql_query($sql_dane_per))return 1;
  else return 0;




}



}

?>
