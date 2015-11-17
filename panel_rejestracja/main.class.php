<?php



/*******************************************************************************
 * METODY :
 * zabezpieczenie_sql    -     zabezpieczenie przez sql injection
 * spr_wulgarne_slowa    -     sprawdza czy lowo jest wulgarne
 * szyfruj               -     szyfruje dane metoda md5
 * sprawdz_email         -     sprawdza czy email ma znak @
 * connect_sql           -     tworzy polaczenie z sql
 *******************************************************************************/


/*******************************************************************************
 * Klasa main
 * sa tutaj przechowywane metody wykorzystywane czesciej
 *******************************************************************************/





class main {

	public  $server_name;
	protected $user_name;
	protected $password;
	protected $server_db;
	protected $test = "czesc";



	/************************************************
	 * Dane dla serwera
	 ************************************************/

	function __construct(){
		require('config.php');
		$this->server_name = $server_name;
		$this->user_name = $user_name;
		$this->password = $password;
		$this->server_db = $server_db;
	}




	/**********************************************************
   * Zabezpieczenie przed sql injection 
	 * usuwa znaki niebezpieczne
	 **********************************************************/

	protected function zabezpieczenie_sql($slowo){
	$slowo = stripslashes($slowo);
	$slowo = mysql_real_escape_string($slowo);
	return $slowo;
	}




	/***********************************************************
	 * Sprawdza wulgarne slownictwo
	 ***********************************************************/

		public function spr_wulgarne_slowa($slowo){
		require('config.php');

		for($i=0;$i<count($wulgarne_slowa);$i++)
			if(strpos($slowo, $wulgarne_slowa[$i]) || $slowo == $wulgarne_slowa[$i]) return true;

		return false;
	}




	/***********************************************************
	 * Szyfrowanie metoda md5
	 ***********************************************************/

		protected function szyfruj($slowo){
		return md5($slowo);
	}



	/************************************************************
	 * Sprawdza poprawnosc emaila
	 ************************************************************/

		protected function sprawdz_email($email){ // zwraca true jezeli jest poprawny
		if(strpos($email, "@"))return true;
			else return false;

	}



	/*************************************************************
	 * Polaczenie SQL
	 *************************************************************/

	protected function connect_sql(){
	mysql_connect($this->server_name, $this->user_name, $this->password) or die("Łącznosc z serwerem nie powiadla sie!<br>" . mysql_error());
	mysql_select_db($this->server_db) or die("Łacznosc z baza nie powiodla sie! <br>". mysql_error());
	}

}



?>
