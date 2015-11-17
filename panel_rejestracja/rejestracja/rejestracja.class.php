<?php



 /******************************************************************************
  * METODY
  * dane_rejestracyjne       -  ustawia dane w klasie
  * sprawdz_zapisz_w_bazie   -  sprawdza czy lgin i email sa w bazie 
  * utworz_konto             -  tworzy komunikat i tworzy rekord w bazie danych
  * sprawdz_poprawnosc_pol   -  sprawdza poprawnosc slow np login, imie
  ******************************************************************************/
 
/********************************************************************************
 * Klasa w ktorej dane do rejestracji sa sprawdzae pod katem 
 * slownictwa (wulgarne slowa) 
 * Email jest sprawdzany czy ma znak @
 * Szyfrowanie hasla 
 * Tworzona jest sciezka insert i umieszczane sa dane w bazie danych
 *******************************************************************************/

 


 
 
class rejestracja extends main {

	protected $login;
	protected $haslo;
	protected $imie;
	protected $nazwisko;
	protected $adres;
	protected $telefon;
	protected $kod_pocztowy;
	protected $e_mail;
	protected $opis;
	protected $typ_konta;
	
	
	
	
	
	/*********************************************************
	 * Sa tutaj zabezpieczane dane z POST i dalej przesylane 
	 * do sprawdzenia pod katem slownictwa
	 * i zwraca true gdy wszystko jest zgodne
	 **********************************************************/
	 
	public function dane_rejestracyjne($login, $haslo, $imie, $nazwisko, $adres, $telefon, $kod_pocztowy, $e_mail, $opis, $typ_konta){
		
		$this->login = $this->zabezpieczenie_sql($login);
		$this->haslo = $this->zabezpieczenie_sql($haslo);
		$this->imie = $this->zabezpieczenie_sql($imie);
		$this->nazwisko = $this->zabezpieczenie_sql($nazwisko);
		$this->adres = $this->zabezpieczenie_sql($adres);
		$this->telefon = $this->zabezpieczenie_sql($telefon);
		$this->kod_pocztowy = $this->zabezpieczenie_sql($kod_pocztowy);
		$this->e_mail = $this->zabezpieczenie_sql($e_mail);
		$this->opis = $this->zabezpieczenie_sql($opis);
		$this->typ_konta = $this->zabezpieczenie_sql($typ_konta);

		if($this->sprawdz_poprawnosc_pol())
			return false;
		else 
			return true;

	}
	
	
	
	
	
	/*********************************************************
	 * Metoda sprawdza czy istnieja w bazie zmienne login oraz
	 * email a nastepnie inicjuje metode tworzenia konta
	 * jezeli nie znalazlo ich w bazie
	 **********************************************************/
	 
	
	public function sprawdz_zapisz_w_bazie(){
		
	$this->connect_sql();
	
	$zapytanie_login = "SELECT login FROM ".$this->typ_konta." WHERE login='".$this->login."'";
	$login_baza = mysql_query($zapytanie_login);
	$ilosc_login = mysql_num_rows($login_baza);

	$zapytanie_email = "SELECT e_mail FROM ".$this->typ_konta." WHERE e_mail='".$this->e_mail."'";
	$email_baza = mysql_query($zapytanie_email);
	$ilosc_email = mysql_num_rows($email_baza);
	
	mysql_close();
	
	if($ilosc_login > 0)return 2;
	else {
		if($ilosc_email > 0)return 3;
		else {
		$this->utworz_konto();
		return 1;
		}	
	}
	
	
	}
	
	
	
	
	/***************************************************************************
	 * Tworzona jest tutaj komunikat do bazy danych aby utworzyl nowy rekord 
	 * z danych z POST
	****************************************************************************/
	
	private function utworz_konto(){
	$this->connect_sql();
	
	$sql = "INSERT INTO ".$this->typ_konta." VALUES(NULL,'".$this->login."','".$this->szyfruj($this->haslo)."','".$this->imie."','".$this->nazwisko."','".$this->telefon."','".$this->adres."','".$this->kod_pocztowy."','".$this->e_mail."','".$this->opis."')";

	$zapytanie = mysql_query($sql);// OR die("<a href=\"index.php\">wróć na Strone Główną</a><br>Zapis do bazy nie powodl sie!<br>" . mysql_error());
	mysql_close();
	
	return true;
	
	}

	
	
	/******************************************************************************
	 * Sprawdzane jest tutaj slownictwo czy nie ma wulgaryzmow w
	 * slowach takich jak login, imie, nazwisko, adres
	 ******************************************************************************/
	
	private function sprawdz_poprawnosc_pol(){

		if( $this->spr_wulgarne_slowa($this->login) ||
			$this->spr_wulgarne_slowa($this->imie)  ||
			$this->spr_wulgarne_slowa($this->nazwisko) ||
			$this->spr_wulgarne_slowa($this->adres) ||
			$this->spr_wulgarne_slowa($this->opis)
			)return true;
		else 
			if($this->sprawdz_email($this->e_mail))
			 return false;
			else 
			 return true;
	}
	

	
}

?>