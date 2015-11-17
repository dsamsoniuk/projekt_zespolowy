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
	
	if(isset($_POST['login']) && isset($_POST['password']) && isset($_POST['type_acc'])) {
		$login = $_POST['login'];
		$password = $this->szyfruj($_POST['password']);
		$type_acc = $_POST['type_acc'];
	}
	else return "Nie poprawny login lub haslo!";;


	$login = $this->zabezpieczenie_sql($login);
	$password = $this->zabezpieczenie_sql($password);
	$type_acc = $this->zabezpieczenie_sql($type_acc);
	
	
	$sql = "SELECT * FROM ".$type_acc." WHERE login='".$login."' and haslo='".$password."'";
	$zapytanie = mysql_query($sql);
	$wiersz = mysql_fetch_array($zapytanie, MYSQL_ASSOC);
	$count = mysql_num_rows($zapytanie);
	
	if($count == 1){
	$_SESSION["ID"] = $wiersz["ID"];
	$_SESSION['login'] = $wiersz["login"];
	$_SESSION['imie'] = $wiersz["imie"];
	$_SESSION['nazwisko'] = $wiersz["nazwisko"];
	$_SESSION['telefon'] = $wiersz["telefon"];
	$_SESSION['adres'] = $wiersz["adres"];
	$_SESSION['kod_pocztowy'] = $wiersz["kod_pocztowy"];
	$_SESSION['e_mail'] = $wiersz["e_mail"];
	$_SESSION['opis'] = $wiersz["opis"];
	$_SESSION["type_acc"] = $type_acc;
	
	mysql_close();
	return "panel_konta";
	}
	else  return "Nie poprawny login lub haslo!";
		
	}
	
	
}

?>