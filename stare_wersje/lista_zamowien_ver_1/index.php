<?php
/**************************************************************************************************************************/
session_start();
ini_set('session.save_path', 'panel_logowania/sesja');     // Nowa sciezka dla sesji
require('config.php');
require('main.class.php');

/* Panel logowania */
require('panel_logowania/logowanie.class.php');      // Sprawdza czy istnieje sesja i tworzy nowa jezeli nie istnieje
require('panel_logowania/panel_konta.php');          // Wyglad i uklad panelu konta
/**************************************************************************************************************************/

/* Lista fotografow */
require('lista_fotografow/wys_liste_fotografow.php');
require('lista_fotografow/lista_fotografow.class.php');

/* Lista zamowien */
require('lista_zamowien/wys_liste_zamowien.php');
require('lista_zamowien/lista_zamowien.class.php');

/* Zamowienie */
require('zamowienia/spr_zamowienia.php');
require('zamowienia/zamowienia.class.php');
require('zamowienia/formularz_zamowienia.php');
require('zamowienia/zloz_zamowienie.php');
/**************************************************************************************************************************/







/*****************************
 * Panel LOGOWANIA
 *****************************/
$log = new logowanie();
$msg_return = $log->sprawdz_dane_log();  // Zwraca informacje o logowaniu
if($msg_return == "panel_konta")
	 panel_konta();                      // zmiany wygladu panelu w pliku panel_logowania/panel_kont.php
else
	 panel_konta_logowania($msg_return); // zmiany wygladu panelu w pliku panel_logowania/panel_kont.php









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

	if($podstrona == "zloz_zamowienie")  spr_zamowienia($fotograf_ID, $pakiety);
	if($podstrona == "wyslij_zamowienie") zloz_zamowienie($fotograf_ID);
	}

	/************************************
	 * Lista zamowien
	 ************************************/

	else if($podstrona == 'lista_zamowien')
		wys_liste_zamowien();
	/************************************
	 * Lista fotografow
	 ************************************/
	else if($podstrona == 'lista_fotografow')
		wys_liste_fotografow();



	/*******************************
	* Usuwanie zamowienia
	*******************************/

	else if($podstrona == 'usun_zamowienie'){

		if(isset($_POST['id_zamowienia']) && isset($_POST['id_fotografa']) && $_POST['id_fotografa'] == $_SESSION['ID']){

			$zamowienia = new lista_zamowien();
			$zamowienia->usun_zamowienie($_POST['id_zamowienia']);
		}
		else
			echo 'Error 6: Blad zamowienia, usuwanie';
	}

	/***********************************
	 * DOMYSLNA PODSTRONA
	 ***********************************/

	else {



	}


}
else echo ''; //echo 'Brak wybranej podstrony';












?>
