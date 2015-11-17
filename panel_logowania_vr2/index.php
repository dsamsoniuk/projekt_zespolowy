<?php
/**************************************************************************************************************************/
session_start();  
ini_set('session.save_path', 'panel_logowania/sesja');     // Nowa sciezka dla sesji
require('config.php');
require('main.class.php');
/**************************************************************************************************************************/

/* Panel logowania */
require('panel_logowania/logowanie.class.php');      // Sprawdza czy istnieje sesja i tworzy nowa jezeli nie istnieje 
require('panel_logowania/panel_konta.php');          // Wyglad i uklad panelu konta 

/* Panel rejestracyjna */
require('rejestracja/formularz_rejestracyjny.php');  // Wyglad formularza rejestracyjnego
require('rejestracja/rejestracja_danych.php');       // Ogolny zarys warunkow odwolujacych sie do lasy rejestracja.class.php
require('rejestracja/rejestracja.class.php');        // Klasa w ktorej dochodzi do sprawdzenia danych i zapisania w bazie
 	
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
 




/*********************
 * REJESTRACJA 
 *********************/
if(isset($_POST['submit_register']))panel_rejestracyjna();
else echo '';
formularz_rejestracyjny();










?>