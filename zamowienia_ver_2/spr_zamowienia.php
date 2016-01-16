<?php





/*************************************************************
 * Funkcja ktora sprawdza czy istnieje sesja oraz
 * wyswietla formularz zamowienia
 *************************************************************/





function spr_zamowienia($fotograf_ID, $pakiety){


		if(isset($_SESSION["poziom_uprawnien"]) && $_SESSION["poziom_uprawnien"] == "klient")
			formularz_zamowienia($fotograf_ID, $pakiety);
		else
			echo '
			<div class="container">
			<center>
				<p><h5><u>Musisz byc zalogowany jako <b>klient</b> aby moc dokonac zamowienia</u></h5></p>
			</center>
			</div>
			';

}



?>
