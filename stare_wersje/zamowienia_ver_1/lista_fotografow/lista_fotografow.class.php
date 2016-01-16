<?php







   /***********************************************************
	* Wersja wyswietlania listy fotografów okrojona
	* wyswietla tylko podstawowe informacje :imie nazwisko Id
	***********************************************************/
 
 
 
 
 
 

class lista_fotografow extends main {
	
	public function wyswietl_liste(){
		
		$this->connect_sql();
		
		$sql = 'SELECT * FROM uzytkownik WHERE poziom_uprawnien="fotograf"';
		$zapytanie = mysql_query($sql);
		while($wiersz = mysql_fetch_array($zapytanie, MYSQL_ASSOC)){
			echo '<br><a href="index.php?fotograf_ID='.$wiersz['ID'].'&subpage=zloz_zamowienie">';
			echo $wiersz['imie'].' ';
			echo $wiersz['nazwisko'];
			echo '</a>';
		}
		mysql_close();
	}
	
	
	
	
}


?>