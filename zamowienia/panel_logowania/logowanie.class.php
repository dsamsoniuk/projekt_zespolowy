<?php


/***************************************************************************
 * METODY :
 * sprawdz_dane_log        -   sprawdza czy istnieje sesja  
 * stworz_sesje            -   tworzy nowa sesje
 ***************************************************************************/


/***************************************************************************
 * Klasa (logowanie) której zadaniem jest sprawdzenie czy istnieje sesja
 * Tworzy nowa jezeli nie znajdzie aktualnej
 * Zabezpieczenie SQL injection
 * Mozna ustawic dane logowania na serwer w pliku config.php
 ***************************************************************************/
 

 
 
 
class logowanie extends main {
	

	

/****************************************************************
 * Sprawdza czy istnieje sesja ID jezeli tak zwraca true i
 * wyswietla dane w zaleznosci od rodzaju konta
 * Jezeli nie ma sesji tworzy nowa i rowniez zwraca true
 ****************************************************************/

	public function sprawdz_dane_log(){
	
	$this->connect_sql();
	if(isset($_SESSION['ID']))return "panel_konta";
	else if(isset($_POST['submit']))return $this->stworz_sesje(); 
	else return "";
	
	}
	
	
	
/******************************************************************
 * Tworzenie nowa sesje i zwraca true
 ******************************************************************/	
	
	
	private function stworz_sesje(){
	
	if(isset($_POST['login']) && isset($_POST['password'])) {
		$login = $_POST['login'];
		$password = $this->szyfruj($_POST['password']);
		
	}
	else return "Nie poprawny login lub haslo!. err0";;


	$login = $this->zabezpieczenie_sql($login);
	$password = $this->zabezpieczenie_sql($password);
	
	
	
	$sql = "SELECT * FROM uzytkownik WHERE login='".$login."' and haslo='".$password."'";
	$zapytanie = mysql_query($sql);
	$wiersz = mysql_fetch_array($zapytanie, MYSQL_ASSOC);
	$count = mysql_num_rows($zapytanie);

	if($count == 1){
	$_SESSION["ID"] = $wiersz["ID"];
	$_SESSION['login'] = $wiersz["login"];
	$_SESSION['imie'] = $wiersz["imie"];
	$_SESSION['nazwisko'] = $wiersz["nazwisko"];
	$_SESSION['telefon'] = $wiersz["telefon"];
	$_SESSION['miasto'] = $wiersz["miasto"];
	$_SESSION['ulica'] = $wiersz["ulica"];
	$_SESSION['kod_pocztowy'] = $wiersz["kod_pocztowy"];
	$_SESSION['email'] = $wiersz["email"];
	$_SESSION['opis'] = $wiersz["opis"];
	$_SESSION["poziom_uprawnien"] = $wiersz["poziom_uprawnien"];
	
	mysql_close();
	return "panel_konta";
	}
	else  return "Nie poprawny login lub haslo! err1";
		
	}
	
	
}

?>