<?php
/**************************************************************************************************************************/
require('config.php');
require('main.class.php');

/* Panel rejestracyjna */
require('rejestracja/formularz_rejestracyjny.php');  // Wyglad formularza rejestracyjnego
require('rejestracja/rejestracja_danych.php');       // Ogolny zarys warunkow odwolujacych sie do lasy rejestracja.class.php
require('rejestracja/rejestracja.class.php');        // Klasa w ktorej dochodzi do sprawdzenia danych i zapisania w bazie

/**************************************************************************************************************************/





/*********************
 * REJESTRACJA
 *********************/
if(isset($_POST['submit_register']))panel_rejestracyjna();
else echo '';
formularz_rejestracyjny();










?>
