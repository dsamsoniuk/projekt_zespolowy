<?php




/********************************************************************************
 * Funkcja panel_rejestracyjna w niej sa sprawdzane dane 
 * czy istnieja i czy nie sa puste.
 * Jezeli warunek jest spelniony przesyla dane do klasy (rejestracja.class.php)
 * tam dalej sa modyfikowane dane.
 *******************************************************************************/

 



 function panel_rejestracyjna() {
	 

	/**********************************************************
	 * Petla sprawdza czy POSTY istnieja i czy sa wypelnione
	 **********************************************************/
	 
	$rejestruj_dane = new rejestracja;
	
	$formularz = array('login','haslo','imie','nazwisko','adres','telefon','kod_pocztowy','e_mail','opis','poziom_uprawnien');
	$formularz_pelny = false;
	for($i=0;$i<count($formularz);$i++){
		if(isset($_POST[$formularz[$i]]) && !empty($_POST[$formularz[$i]]))$formularz_pelny = true; 
		else {
			$formularz_pelny = false;  
			break; }
	}
	
	
	/********************************************************
	 * Wprowadza dane do klasy rejestracja i tam 
	 * juz zajmuje sie reszta (insert, sprawdzanie pisowni ...)
	 *********************************************************/
	 
	if($formularz_pelny){
		
		$poprawnosc_pol = $rejestruj_dane->dane_rejestracyjne($_POST['login'], $_POST['haslo'], $_POST['imie'], $_POST['nazwisko'],
		$_POST['adres'], $_POST['telefon'], $_POST['kod_pocztowy'], $_POST['e_mail'], $_POST['opis'], $_POST['poziom_uprawnien']);
		
		if($poprawnosc_pol){
			
			$utworzono_konto = $rejestruj_dane->sprawdz_zapisz_w_bazie();
			
			if($utworzono_konto == 2) echo 'Nie poprawny login, juz istnieje.';
			else if($utworzono_konto == 3) echo 'Nie poprawny email, juz istnieje.';
			else echo '<br>Zostałeś zarejestrowany!';
			
		}
		else echo '<br>Sprawdz czy poprawnie wypełniłes wszystkie pola.<br>';
	}	
	else echo '<br>Sprawdz czy wypełniłeś wszystkie pola';
	

}




?>