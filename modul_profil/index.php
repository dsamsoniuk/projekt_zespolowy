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

/* Panel rejestracyjna */
require('rejestracja/formularz_rejestracyjny.php');  // Wyglad formularza rejestracyjnego
require('rejestracja/rejestracja_danych.php');       // Ogolny zarys warunkow odwolujacych sie do lasy rejestracja.class.php
require('rejestracja/rejestracja.class.php');        // Klasa w ktorej dochodzi do sprawdzenia danych i zapisania w bazie

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

/* Profil fotografa */
require('profil/wyswietl_profil.php');
require('profil/profil.class.php');
/**************************************************************************************************************************/

?>

<!DOCTYPE html>
<html lang="pl">

    <head>
        <title>Projekt zespołowy UG</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
            <!-- Bootstrap -->
            <link href="css/bootstrap.min.css" rel="stylesheet">
            <!-- Custom CSS -->
            <link href="css/main.css" rel="stylesheet">

            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
              <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
            <![endif]-->
    </head>

    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand active" href="index.php">Strona Główna</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="about.html">O nas</a>
                    </li>
                    <li>
                        <a href="kontakt.html">Kontakt</a>
                    </li>
                    <li>
                        <a href="index.php?subpage=lista_fotografow">Fotografowie</a>
                    </li>





                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown">
                          Twoje konto
                          <b class="caret"></b></a>
                        <ul class="dropdown-menu" style="padding: 15px;min-width: 250px;">



											<?php
                      if(isset($_POST['submit_register']))panel_rejestracyjna();
											/*****************************
											 * Panel LOGOWANIA
											 *****************************/

											$log = new logowanie();
											$msg_return = $log->sprawdz_dane_log();  // Zwraca informacje o logowaniu

											if($msg_return == "panel_konta")
												 panel_konta();                      // zmiany wygladu panelu w pliku panel_logowania/panel_kont.php
											else
												 panel_konta_logowania($msg_return); // zmiany wygladu panelu w pliku panel_logowania/panel_kont.php

											?>

										</ul>





                  </li>
                  <li>
                      <form class="navbar-form navbar-left" action="index.php?subpage=lista_fotografow" method="post" role="search">
                          <div class="form-group">
                              <input type="text" name="slowo_kluczowe" class="form-control" placeholder="Wyszukaj po nazwisku">
                          </div>
                          <button type="submit" class="btn btn-default">Szukaj</button>
                      </form>
                  </li>
              </ul>
          </div>
          <!-- /.navbar-collapse -->
      </div>
      <!-- /.container -->
  </nav>
  <!-- Navbar koniec -->




<?php




/*********************************************************************************************************
 *                              Glowny warunek dla zawartosci strony
 *********************************************************************************************************/





/***********************************************************
 * Zamowienie
 ***********************************************************/
if(isset($_GET['subpage'])){

	$podstrona = $_GET['subpage'];

  /************************************
	 * Wyswietl profil fotografa
	 ************************************/


  if(isset($_GET['fotograf_ID'])){

	   /* MIEJSCE NA MODUL Z PROFILEM FOTOGRAFA ()*/

	    //echo '<br>MIEJSCE NA Modul/Funkcje Z PROFILEM FOTOGRAFA <br><br><br>';
       wyswietl_profil();
	     $fotograf_ID = $_GET['fotograf_ID'];
	     $zamowienie = new zamowienia();
	     $pakiety = $zamowienie->pakiety($fotograf_ID);


       /************************************
       * Zloz zamowien oraz Wyswietl Profil
       ************************************/

      //if($podstrona == "zloz_zamowienie")
      if($podstrona == "profil")
         spr_zamowienia($fotograf_ID, $pakiety);

         /************************************
         * Wyslij zamowien
         ************************************/
      else if($podstrona == "wyslij_zamowienie"){
         zloz_zamowienie($fotograf_ID);
       }
  }




	/************************************
	 * Lista zamowien
	 ************************************/

	else if($podstrona == 'lista_zamowien'){
    wys_liste_zamowien();
  }


	/************************************
	 * Lista fotografow
	 ************************************/

	else if($podstrona == 'lista_fotografow'){
    //require('portfolia.php');
    echo '
    <div class="container">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">Wybierz fotografa</h1>
            </div>
    	';

      wys_liste_fotografow();

      echo '
        </div>
        <hr>
      </div>
    ';
  }


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

	else {
    require('strona_glowna.php');
      }
  }


/***********************************
 * DOMYSLNA PODSTRONA
 ***********************************/

else  require('strona_glowna.php');  //echo 'Brak wybranej podstrony';






/************************************************* KONIEC GLOWNEGO WARUNKU ****************************************/





 ?>

<!--- END CONTAINER --------------------------------------------------------------------------------------------->







  <!-- Modal rejestracja -->
  <div id="rejestracja" class="modal fade" role="dialog" tabindex="-1">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h3 class="panel-title">Zarejestruj się</h3>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <div class="col-md-8 col-md-offset-2">
                        <!--
                          <form class="form" role="form" method="post" action="zarejestruj" accept-charset="UTF-8" id="rejestracja">
                          -->

                            <?php
                            /*********************
                             * REJESTRACJA
                             *********************/

                          //  else echo '';
                            formularz_rejestracyjny();
                            ?>


                            <!--
                          </form>
                        -->
                      </div>
                  </div>
              </div>

              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
              </div>

          </div>

      </div>
  </div>
  <!-- Modal rejestracja - koniec -->




  <!-- Modal logowanie -->
  <div id="zaloguj" class="modal fade" role="dialog" tabindex="-1">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h3 class="panel-title">Zaloguj się</h3>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <div class="col-md-8 col-md-offset-2">
                          <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login">
                              <div class="form-group">
                                  <label class="sr-only">e-mail</label>
                                  <input type="email" class="form-control" id="email" placeholder="e-mail" required>
                              </div>
                              <div class="form-group">
                                  <label class="sr-only">Hasło</label>
                                  <input type="password" class="form-control" id="haslo" placeholder="Hasło" required>
                              </div>
                              <div class="form-group">
                                  <button type="submit" class="btn btn-success btn-block">Zaloguj się</button>
                              </div>
                              <div class="form-group">
                                  <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#rejestracja"  data-dismiss="modal">Zarejestruj się</button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>

              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
              </div>

          </div>

      </div>
  </div>
  <!-- Modal logowanie - koniec -->







<hr>
<div class="container">
  <!-- Footer ------------------------------------------------------------------------------------------>
      <footer>
          <div class="row">
              <div class="col-lg-12">
                  <p>Copyright &copy; 2015 Przemysław Tomasik, Damian Samsoniuk, Patryk Brzozowski, Ewa Gonera-Szwarc</p>
                  <p>Projekt Zespołowy UG</p>
              </div>
          </div>
      </footer>
</div>





      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://code.jquery.com/jquery.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="js/bootstrap.min.js"></script>
  </body>
</html>
