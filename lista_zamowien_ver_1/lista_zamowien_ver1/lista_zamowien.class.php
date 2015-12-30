<?php





   /***********************************************************
	* Klasa wyswietla liste fotografów
	* wyswietla  podstawowe informacje :imie nazwisko Id - fotografow
	* stronicowanie listy fotografow (aktualnie ustawione na 7)
	* usuwanie wybranych zamowien z bazy danych tylko ze strony fotografa
	***********************************************************/
 
 
 
 
 
	/**********************************************************
	 * METODY:
	 * lista_zamowien   - wyswietla liste zamowien danego id
	 * usun_zamowienie  - usuwa wybrane zamowienie
	 **********************************************************/
 
 
 
 
 
 
 

class lista_zamowien extends main {
	
	
	
	
	/************************************************* LISTA FOTOGRAFOW ***********************************************/
	
	
	
	public function wyswietl_liste(){
		
	$this->connect_sql();
	
	if($_SESSION['poziom_uprawnien'] == "fotograf") {
		$sql_zamowienia = 'SELECT * FROM zamowienie WHERE fotograf_id='.$_SESSION['ID'];
		$sql_pakiety = 'SELECT * FROM pakiet WHERE fotograf_id='.$_SESSION['ID'];


		$zapytanie_zamowienia = mysql_query($sql_zamowienia);     // ZAMOWIENIE
		$zapytanie_pakiety = mysql_query($sql_pakiety);           // PAKIETY
		$tablica_pakietow;
		
		while($wiersz_pakiety = mysql_fetch_array($zapytanie_pakiety, MYSQL_ASSOC) ) { 
			$tablica_pakietow[$wiersz_pakiety['ID']] = array($wiersz_pakiety['nazwa'],$wiersz_pakiety['opis'],$wiersz_pakiety['cena']);
		}
		
		
		while($wiersz = mysql_fetch_array($zapytanie_zamowienia, MYSQL_ASSOC)){
			
			
			/* Podstawowe dane zamowienia */
			
			echo '<br><b>Numer zamowienia: '.$wiersz['ID'].'</b><br>';
			echo '
			<form action="index.php?subpage=usun_zamowienie" method="post">
			<input type="hidden" name="id_zamowienia" value="'.$wiersz['ID'].'">
			<input type="hidden" name="id_fotografa" value="'.$wiersz['fotograf_id'].'">
			<input type="submit" value="Usun zamowienie">
			</form>';
			echo 'Komentarz: <br>'.$wiersz['komentarz'].'<br>';
			echo 'Wybrane pakiety:<br>';
			
			$sql_skladowe = 'SELECT * from skladowe_zamowien WHERE zamowienie_ID='.$wiersz['ID'];
			$zapytanie_skladowe = mysql_query($sql_skladowe);
			
			while($wiersz_skladowy = mysql_fetch_array($zapytanie_skladowe, MYSQL_ASSOC)){
			
				
				
			/* Szczegoly zamowienia */
				
				
					if(isset($tablica_pakietow[$wiersz_skladowy['pakiet_ID']][0])) {
						
						echo 'NAZWA:'.$tablica_pakietow[$wiersz_skladowy['pakiet_ID']][0];
						echo ' OPIS: '.$tablica_pakietow[$wiersz_skladowy['pakiet_ID']][0].'<br>';
						
					}
					else echo 'Error 3: Blad skladni lista zamowien!';
				
			}
		}
		
	}
	
	
	/***************************************************  KLIENT - LISTA ZAMOWIEN **************************************************/
	
	
	else if($_SESSION['poziom_uprawnien'] == "klient") {
		
		
		$sql_zamowienia = 'SELECT * FROM zamowienie WHERE klient_id='.$_SESSION['ID'];
		$zapytanie_zamowienia = mysql_query($sql_zamowienia);     // ZAMOWIENIE (wyswietl)
		
		
		while($wiersz = mysql_fetch_array($zapytanie_zamowienia, MYSQL_ASSOC)){
			
			
			/* Podstawowe dane zamowienia */
			
			echo '<br><b>Numer zamowienia: '.$wiersz['ID'].'</b><br>data-zamowienia:'.$wiersz['data'].'<br>';
			echo 'Komentarz: <br>'.$wiersz['komentarz'].'<br>';

		}
		
	}
	
	/* Na wypadek bledy w typie konta  */
	
	else 
		echo 'Error 4: Blad konta';
		
		
		mysql_close();

		
	}
	
	
	
	
	
	/************************************************************
	 * METODA:   Usuwanie zamowien 
	 ************************************************************/
		
		
		
	public function usun_zamowienie($id_zamowienia){
		
		$this->connect_sql();
		
		$usun_zamowienie = 'DELETE FROM zamowienie WHERE ID='.$id_zamowienia.';';
		$usun_zamowienie_skladowe = ' DELETE FROM skladowe_zamowien WHERE zamowienie_ID='.$id_zamowienia.';';
		
		if(mysql_query($usun_zamowienie) && mysql_query($usun_zamowienie_skladowe)){ echo '<br>Zamowienie zostało pomyślnie usunięte.';}
		else echo '<br>Nie udało sie usunąć zamówienia.';
		
		
		mysql_close();
	}
	
	
	
	
}

?>