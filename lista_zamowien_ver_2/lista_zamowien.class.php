<?php





   /***********************************************************
	* Klasa wyswietla liste fotografów
	* wyswietla  podstawowe informacje :imie nazwisko Id - fotografow
	* stronicowanie listy fotografow (aktualnie ustawione na 8)
	* usuwanie wybranych zamowien z bazy danych tylko ze strony fotografa
	* zmien_status
	***********************************************************/





	/**********************************************************
	 * METODY:
	 * lista_zamowien   - wyswietla liste zamowien danego id
	 * wyswietl_historie_zamowien
	 * wyswietl_status -
	 * usun_zamowienie  - usuwa wybrane zamowienie
	 **********************************************************/








class lista_zamowien extends main {






	/************************************************* LISTA FOTOGRAFOW ***********************************************/






  /*****************************
   * Lista zamowien aktywnych
   *****************************/


	public function wyswietl_liste(){

	$this->connect_sql();

	if($_SESSION['poziom_uprawnien'] == "fotograf") {
		$sql_zamowienia = 'SELECT * FROM zamowienie WHERE fotograf_id='.$_SESSION['ID'].' AND status=1 OR status=2';
		$sql_pakiety = 'SELECT * FROM pakiet WHERE fotograf_id='.$_SESSION['ID'];


		$zapytanie_zamowienia = mysql_query($sql_zamowienia);     // ZAMOWIENIE
		$zapytanie_pakiety = mysql_query($sql_pakiety);           // PAKIETY
		$tablica_pakietow;

  echo "<br><br><center><b>Zamowienia aktywne</b></center><br><br>";

		while($wiersz_pakiety = mysql_fetch_array($zapytanie_pakiety, MYSQL_ASSOC) ) {
			$tablica_pakietow[$wiersz_pakiety['ID']] = array($wiersz_pakiety['nazwa'],$wiersz_pakiety['opis'],$wiersz_pakiety['cena']);
		}


		while($wiersz = mysql_fetch_array($zapytanie_zamowienia, MYSQL_ASSOC)){


			/* Dane zamowienia */
      $id_zamowienia = $wiersz['ID'];
      $id_fotografa = $wiersz['fotograf_id'];
      $status = $wiersz['status'];
      $data = $wiersz['data'];

			echo '<br><b>ID zamowienia: '.$id_zamowienia.'</b><br> Status zamowienia: '.$this->wyswietl_status($status).'<br>Data:'.$data.'<br>';



		if($status == '1')
      // Formularz akceptacji zamowienie
			echo '
			<form action="index.php?subpage=zamowienie_zmien_status" method="post">
			<input type="hidden" name="id_zamowienia" value="'.$id_zamowienia.'">
			<input type="hidden" name="id_fotografa" value="'.$id_fotografa.'">
      <input type="hidden" name="status_zamowienia" value="2">
			<input type="submit" value="zaakceptuj zamowienie (zamien na w toku)">
			</form>';
			else if($status == '2')
        // Formularz zaznacz jako zreaizowany zamowienie
        echo '
        <form action="index.php?subpage=zamowienie_zmien_status" method="post">
        <input type="hidden" name="id_zamowienia" value="'.$id_zamowienia.'">
        <input type="hidden" name="id_fotografa" value="'.$id_fotografa.'">
        <input type="hidden" name="status_zamowienia" value="3">
        <input type="submit" value="Zmien status na zrealizowany">
        </form>';


      // Formularz anuluj zamowienie
      echo '
      <form action="index.php?subpage=zamowienie_zmien_status" method="post">
      <input type="hidden" name="id_zamowienia" value="'.$id_zamowienia.'">
      <input type="hidden" name="id_fotografa" value="'.$id_fotografa.'">
      <input type="hidden" name="status_zamowienia" value="4">
      <input type="submit" value="Anuluj">
      </form>';

			echo 'Komentarz: <br>'.$wiersz['komentarz'].'<br>';
			echo '<b>Wybrane pakiety:</b><br>';

			$sql_skladowe = 'SELECT * from skladowe_zamowien WHERE zamowienie_ID='.$wiersz['ID'];
			$zapytanie_skladowe = mysql_query($sql_skladowe);

			while($wiersz_skladowy = mysql_fetch_array($zapytanie_skladowe, MYSQL_ASSOC)){


			/*********************************************  PAKIETY ***************************************/
			/* Szczegoly zamowienia pakietow */


					if(isset($tablica_pakietow[$wiersz_skladowy['pakiet_ID']][0])) {

						echo 'NAZWA:'.$tablica_pakietow[$wiersz_skladowy['pakiet_ID']][0];
						echo '<br>OPIS: '.$tablica_pakietow[$wiersz_skladowy['pakiet_ID']][1].'<br>';
						echo 'CENA: '.$tablica_pakietow[$wiersz_skladowy['pakiet_ID']][2].'<br>';

					}
					else echo 'Error 3: Blad skladni lista zamowien!';

					echo '<br>';
			}
		}

	}


	/***************************************************  KLIENT - LISTA ZAMOWIEN **************************************************/


	else if($_SESSION['poziom_uprawnien'] == "klient") {


		$sql_zamowienia = 'SELECT * FROM zamowienie WHERE klient_id='.$_SESSION['ID'].' AND status=1 OR status=2';
		$zapytanie_zamowienia = mysql_query($sql_zamowienia);     // ZAMOWIENIE (wyswietl)


		while($wiersz = mysql_fetch_array($zapytanie_zamowienia, MYSQL_ASSOC)){


			/* Podstawowe dane zamowienia */

			echo '<br><b>Numer zamowienia: '.$wiersz['ID'].'</b><br>data-zamowienia:'.$wiersz['data'].'<br>';
			echo 'Komentarz: '.$wiersz['komentarz'].'<br>';
			echo 'Stan zamowienia: '.$this->wyswietl_status($wiersz['status']).'<br>';

		}

	}

	/* Na wypadek bledy w typie konta  */

	else
		echo 'Error 4: Blad konta';
    mysql_close();




		/**************************************
		 *  Historia zamowien
		 **************************************/

    $this->wyswietl_historie_zamowien();


	}














/**********************************************************
 * METODA: wyswietla anulowane oraz wykonane zamowienia
 **********************************************************/

public function wyswietl_historie_zamowien(){

  $this->connect_sql();

  $sql_zamowienia = 'SELECT * FROM zamowienie WHERE fotograf_id='.$_SESSION['ID'].' AND status=3 OR status=4';
  $sql_pakiety = 'SELECT * FROM pakiet WHERE fotograf_id='.$_SESSION['ID'];


  $zapytanie_zamowienia = mysql_query($sql_zamowienia);     // ZAMOWIENIE
  $zapytanie_pakiety = mysql_query($sql_pakiety);           // PAKIETY
  $tablica_pakietow;

  echo "<br><br><center><b>Historia zamowien</b></center><br><br>";


  while($wiersz_pakiety = mysql_fetch_array($zapytanie_pakiety, MYSQL_ASSOC) ) {
    $tablica_pakietow[$wiersz_pakiety['ID']] = array($wiersz_pakiety['nazwa'],$wiersz_pakiety['opis'],$wiersz_pakiety['cena']);
  }


  while($wiersz = mysql_fetch_array($zapytanie_zamowienia, MYSQL_ASSOC)){


    /* Podstawowe dane zamowienia --historia */

    $id_zamowienia = $wiersz['ID'];
    $id_fotografa = $wiersz['fotograf_id'];
		$status = $wiersz['status'];
    $data = $wiersz['data'];

    echo '<br><b>Numer zamowienia: '.$id_zamowienia.'</b> Status zamowienia: '.$this->wyswietl_status($status).'<br>Data:'.$data.'<br>';
    echo 'Komentarz: <br>'.$wiersz['komentarz'].'<br>';
    echo '<b>Wybrane pakiety:</b><br>';

    $sql_skladowe = 'SELECT * from skladowe_zamowien WHERE zamowienie_ID='.$wiersz['ID'];
    $zapytanie_skladowe = mysql_query($sql_skladowe);

    while($wiersz_skladowy = mysql_fetch_array($zapytanie_skladowe, MYSQL_ASSOC)){


		/************************************************ PAKIETY - historia ****************************************/
    /* Szczegoly zamowienia pakietow --- historia*/


        if(isset($tablica_pakietow[$wiersz_skladowy['pakiet_ID']][0])) {

          echo 'NAZWA:'.$tablica_pakietow[$wiersz_skladowy['pakiet_ID']][0];
          echo '<br>OPIS: '.$tablica_pakietow[$wiersz_skladowy['pakiet_ID']][1].'<br>';
					echo 'Cena: '.$tablica_pakietow[$wiersz_skladowy['pakiet_ID']][2].'<br>';

        }
        else echo 'Error 3.2: Blad skladni lista zamowien!';

				echo '<br>';
    }

}

mysql_close();
}












/*************************************************************
 * Metoda zwraca napis po podaniu do funkcji liczby 1,2,3,4
 * 1. oczekuje 2. w toku 3.wykonane 4. anulowane
 *************************************************************/

	public function wyswietl_status($status){


		if($status == '1') return "Zamowienie oczekuje na potwierdzenie";
		else if($status == '2') return "Zamowienie w toku";
		else if($status == '3') return "Zamowienie wykonane";
		else if($status == '4') return "Zamowienie anulowane";
		else return "Error 9, status";
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











    /*********************************************
     * METODA : Aktualizacja statusu zamowienia
     *********************************************/

  public function zmien_status($zamowienie_id, $status){

    $this->connect_sql();

    $sql ="UPDATE zamowienie SET status='".$status."' WHERE ID='".$zamowienie_id."'; ";

		echo '<div class="container">';

    if(mysql_query($sql)){

        echo '<br>Zmieniono status zamowienia<br>';
        echo '<a href="index.php?subpage=lista_zamowien">Wróć do zamówień</a>';
				echo '<br><br>
				<b>Za 5 sek zostaniesz przeniesiony do listy zamowien</b>
				<script type="text/javascript">
					setTimeout(function(){
						window.location.href = "index.php?subpage=lista_zamowien";
					},5000);
					</script>';
      }
    else {
				echo 'Zmiana statusu nie powiodla sie';
				echo '<a href="index.php?subpage=lista_zamowien">Wróć do zamówień</a>';}

		echo '</div>';

  }


}

?>
