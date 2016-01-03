<?php





class profil extends main {
	
	
	public function dane($fotograf_id){
		
		$this->connect_sql();
		$fotograf_id = $this->zabezpieczenie_sql($fotograf_id);
		
		$sql_dane_fotografa = "SELECT * from uzytkownik WHERE ID='".$fotograf_id."';";
		$zapytanie = mysql_query($sql_dane_fotografa);
		
		
		
		$dane = mysql_fetch_array($zapytanie, MYSQL_ASSOC);

		
		return $dane;
	}
	
	
	
	
	
}


?>