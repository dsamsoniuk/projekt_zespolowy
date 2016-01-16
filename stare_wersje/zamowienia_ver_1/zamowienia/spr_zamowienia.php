<?php





/*************************************************************
 * Funkcja ktora sprawdza czy istnieje sesja oraz 
 * wyswietla formularz zamowienia
 *************************************************************/


 
 

function spr_zamowienia($fotograf_ID, $pakiety){
	
	
		if(isset($_SESSION["poziom_uprawnien"]) && $_SESSION["poziom_uprawnien"] == "klient") 
			formularz_zamowienia($fotograf_ID, $pakiety);
		else 
			echo 'Musisz byc zalogowany jako klient aby moc dokonac zamowienia';

}



?>