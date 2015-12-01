<?php





	/*******************************************************************
	 * Funkcja ktora wyswietla formularz zamowienia oraz
	 * pakiety dla wybranego fotografa
	 *******************************************************************/







	function formularz_zamowienia($fotograf_ID, $pakiety){

	/***************************************
	 * PAKIET - ID , Nazwa, Opis, Cena
	****************************************/

	echo '
	<form action="index.php?subpage=wyslij_zamowienie&fotograf_ID='.$fotograf_ID.'"  method="post">
	Tytul zamowienia<br><input type="text" name="tytul"><br>
	Tresc<br>
	<textarea rows="4" cols="50" name="komentarz"></textarea><br>
	<h2>Dostepne pakiety</h2>';

	if($pakiety != NULL){
		for($i=0;$i < count($pakiety); $i++){
			echo '<h3><input type="checkbox" name="pakiet_id_'.$i.'" value="'.$pakiety[$i][0].'" />Nazwa pakietu:</h3>'.$pakiety[$i][1].', cena:'.$pakiety[$i][3].'<h3>Opis: </h3>'.$pakiety[$i][2];
	}

	echo '<br>
	<input type="hidden" name="ilosc_pakietow" value="'.$i.'">';
	}
	else
		echo 'Brak pakietow!<br>';

	echo '
	<input type="submit" name="submit" value="Wyslij zamowienie">
	</form>';

}



?>
