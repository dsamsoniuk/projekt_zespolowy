<?php



/***************************************************************************
 * Klasa (logowanie) której zadaniem jest sprawdzenie czy istnieje sesja
 * Tworzy nowa jezeli nie znajdzie aktualnej
 * Zabezpieczenie SQL injection
 * Mozna ustawic dane logowania na serwer w pliku config.php
 * 
 ***************************************************************************/
 
 
 
 
class logowanie {
	
	protected $server_name;
	protected $user_name;
	protected $password;
	protected $server_db;

	

/***********************   Sprawdz wprowadzone dane (logowanie)  **************************************************/

	public function sprawdz_dane_log(){
		
	$this->connect_sql();
	if(isset($_SESSION['ID']))return "panel_konta";
	else if(isset($_POST['submit']))return $this->stworz_sesje(); 
	else return "";
	
	}
	
	
/*********************   Dane dla Serwera   ***********************************************************************/

	public function dane_serwera($server_name, $user_name, $password, $server_db){
		$this->server_name = $server_name;
		$this->user_name = $user_name;
		$this->password = $password;
		$this->server_db = $server_db;
	}
	
	
/*********************   Tworzenie sesji   ***********************************************************************/	
	
	private function stworz_sesje(){
	$msg_return = "Nie poprawny login lub haslo!";
	if(isset($_POST['login']))   $login = $_POST['login']; else return $msg_return;
	if(isset($_POST['password']))$password = $_POST['password']; else return $msg_return;
	if(isset($_POST['type_acc']))$type_acc = $_POST['type_acc']; else return $msg_return;
	
	/* Zabezpieczenie SQL */
	$login = $this->zabezpieczenie_sql($login);
	$password = $this->zabezpieczenie_sql($password);
	$type_acc = $this->zabezpieczenie_sql($type_acc);
	
	/* Zapytanie SQL */
	$sql = "SELECT * FROM ".$type_acc." WHERE nazwa_wyswietlana='".$login."' and haslo='".$password."'";
	$zapytanie = mysql_query($sql);
	$wiersz = mysql_fetch_array($zapytanie, MYSQL_ASSOC);
	$count = mysql_num_rows($zapytanie);
	
	if($count == 1){
	$_SESSION["ID"] = $wiersz["ID"];
	$_SESSION['imie'] = $wiersz["imie"];
	$_SESSION['nazwisko'] = $wiersz["nazwisko"];
	$_SESSION['telefon'] = $wiersz["telefon"];
	$_SESSION['adres'] = $wiersz["adres"];
	$_SESSION['kod_pocztowy'] = $wiersz["kod_pocztowy"];
	$_SESSION['e_mail'] = $wiersz["e_mail"];
	$_SESSION['nazwa_wyswietlana'] = $wiersz["nazwa_wyswietlana"];
	$_SESSION['opis'] = $wiersz["opis"];
	$_SESSION["type_acc"] = $type_acc;
	
	mysql_close();
	return "panel_konta";
	}
	else  return "Nie poprawny login lub haslo!";
		
	}
	
	
/*********************   Zabezpieczenie przed sql injection  ***********************************************************************/	

	private function zabezpieczenie_sql($slowo){
	$slowo = stripslashes($slowo);
	$slowo = mysql_real_escape_string($slowo);
	return $slowo;
	}
	
/*********************   Polaczenie SQL  ******************************************************************************************/

	private function connect_sql(){
	mysql_connect($this->server_name, $this->user_name, $this->password) or die("Łącznosc z serwerem nie powiadla sie!<br>" . mysql_error());
	mysql_select_db($this->server_db) or die("Łacznosc z baza nie powiodla sie! <br>". mysql_error());
		
	}
}

?>