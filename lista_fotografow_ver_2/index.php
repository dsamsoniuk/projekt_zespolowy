<?php
/**************************************************************************************************************************/
session_start();
ini_set('session.save_path', 'panel_logowania/sesja');     // Nowa sciezka dla sesji
require('config.php');
require('main.class.php');
/***************************************************************************************/

/* Lista fotografow */
require('lista_fotografow/wys_liste_fotografow.php');
require('lista_fotografow/lista_fotografow.class.php');






/*** Lista fotografow lub lista zamowien ***/


if(isset($_GET['lista_zamowien']))
	echo '<br><br><a href="index.php?subpage=lista_zamowien">lista zamowien</a><br>';
else
	echo '<br><br><a href="index.php?subpage=lista_fotografow">lista fotografow</a><br>';











/***********************************************************
 * Zamowienie
 ***********************************************************/

if(isset($_GET['subpage'])){

	$podstrona = $_GET['subpage'];

	if(isset($_GET['fotograf_ID'])){

	/* MIEJSCE NA FUNKCJE Z PROFILEM FOTOGRAFA */
	echo '<br>MIEJSCE NA FUNKCJE Z PROFILEM FOTOGRAFA <br><br><br>';

	$fotograf_ID = $_GET['fotograf_ID'];

	$zamowienie = new zamowienia();
	$pakiety = $zamowienie->pakiety($fotograf_ID);

}

	/************************************
	 * Lista fotografow
	 ************************************/
	if($podstrona == 'lista_fotografow')
		wys_liste_fotografow();


	/***********************************
	 * DOMYSLNA PODSTRONA
	 ***********************************/

	else {



	}


}
else echo ''; //echo 'Brak wybranej podstrony';












?>
