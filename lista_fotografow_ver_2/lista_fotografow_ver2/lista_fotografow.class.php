<?php







   /***********************************************************
	* Wersja wyswietlania listy fotografów okrojona
	* wyswietla  podstawowe informacje :imie nazwisko Id
	* stronicowanie fotografow (obecnie ustawione na 7)
	***********************************************************/
 
 
 
 
 
 

class lista_fotografow extends main {
	
	
	public function wyswietl_liste(){
		
		$this->connect_sql();
		$limit_wyswietlen = 7;
		
		
		if(isset($_GET['page_nr']))$numer_strony = $_GET['page_nr'];
		else $numer_strony = 0;
		
		$sql = 'SELECT * FROM uzytkownik WHERE poziom_uprawnien="fotograf" limit '.$limit_wyswietlen.' offset '.$numer_strony;
		
		$zapytanie = mysql_query($sql);
		
		while($wiersz = mysql_fetch_array($zapytanie, MYSQL_ASSOC)){
			echo '<br><a href="index.php?fotograf_ID='.$wiersz['ID'].'&subpage=zloz_zamowienie">';
			echo $wiersz['imie'].' ';
			echo $wiersz['nazwisko'];
			echo '</a>';
		}
		
		
		$wyznacz_ilosc_dostepnych_wierszy = 'SELECT count(*) FROM uzytkownik WHERE poziom_uprawnien="fotograf"';
		$ilosc_dostepnych_wierszy = mysql_query($wyznacz_ilosc_dostepnych_wierszy);
		$ilosc_wierszy = mysql_fetch_array($ilosc_dostepnych_wierszy);
		$liczba_wierszy = $ilosc_wierszy['count(*)'] / $limit_wyswietlen;
		
		echo '<br>';
		if($liczba_wierszy > 1)
			for($i=0; $i < $liczba_wierszy; $i++){
			echo '<a href="index.php?subpage=lista_fotografow&page_nr='.$i*$limit_wyswietlen.'">'.$i.'</a> ';
			}

		
		
		mysql_close();
		
		
		
		
	}
	
	
	
	
}


?>