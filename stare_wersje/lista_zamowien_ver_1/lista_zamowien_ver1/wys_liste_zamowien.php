<?php


	/*******************************************************************
	 * Funkcja ktora wyswietla liste zamowien
	 *******************************************************************/


	 
	 

	function wys_liste_zamowien(){
		
		$zamowienia = new lista_zamowien;
		$zamowienia->wyswietl_liste();

}


?>