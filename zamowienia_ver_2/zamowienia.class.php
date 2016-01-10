<?php





	/*******************************************************************
	 * Klasa ktora jest odpowiedzialna za zamowienia przesyla i
	 * pobiera pakiety
	 *
	 * METODY:
	 * wyslij                  -  przesyla dane do bazy zamowienia
	 * pakiety                 -  pobiera pakiety fotografa
	 *******************************************************************/




	 /**************************************
	  * Problem z komentarzem i tytulem
		* po przejsciu przez funkcje zabezpieczenie_sql
		* nie zwraca napisu tylko NULL wymaga poprawy
		* aktualnie bez zabezpieczenia
		**************************************/






class zamowienia extends main {




	/*******************************************************************
	 * Metoda ktora umieszcza zamowienia w bazie danych
	 * Tworzy zamowienie
	 * pobiera id zamowienia
	 * oraz wstawia do bazy wybrane pakiety wraz z ID zamowienia
	 *******************************************************************/



	public function wyslij($fotograf_id, $klient_id, $tytul, $komentarz, $wyb_pakiety){

		$tytul = $this->zabezpieczenie_sql($tytul); // aktualnie nie jest zapisywany w bazie
		//$komentarz = $this->zabezpieczenie_sql($komentarz); // chwilowo problem ze zwracaniem przez funkcje



		$this->connect_sql();

		$sql = "INSERT INTO `zamowienie`  VALUES(NULL, '".$komentarz."', CURRENT_TIMESTAMP, '".$fotograf_id."', '".$klient_id."','1');";
		mysql_query($sql);

		$sql = 'SELECT ID FROM `zamowienie` WHERE fotograf_id="'.$fotograf_id.'" AND klient_id="'.$klient_id.'" ORDER BY data DESC';
		$zamowienie_id = mysql_query($sql);
		$zamowienie_id = mysql_fetch_array($zamowienie_id, MYSQL_ASSOC);

		$sql = "INSERT INTO `skladowe_zamowien`  VALUES";

		for($i=0; $i < count($wyb_pakiety); $i++){
			$sql .= '("'.$zamowienie_id['ID'].'","'.$wyb_pakiety[$i].'")';
			if($i != count($wyb_pakiety) - 1) $sql .= ',';
		}

		$sql .= ';';

		mysql_query($sql);

		mysql_close();

	}





	/*******************************************************************
	 * Metoda ktora pobiera pakiety wybranego fotografa oraz
	 * zwraca je w postaci tablicy
	 *******************************************************************/


	public function pakiety($ID){
		$this->connect_sql();
		$sql = 'SELECT * FROM pakiet WHERE fotograf_ID="'.$ID.'"';
		$zapytanie = mysql_query($sql);
		$i=0;

		$pakiety=NULL;
		while($wiersz = mysql_fetch_array($zapytanie, MYSQL_ASSOC)){
			$pakiety[$i]= array($wiersz['ID'] , $wiersz['nazwa'], $wiersz['opis'], $wiersz['cena']);
			$i++;

		}
		mysql_close();

		return $pakiety;
	}
}



?>
