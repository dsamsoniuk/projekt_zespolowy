<?php





	/*******************************************************************
	 * Funkcja ktora wyswietla formularz zamowienia oraz
	 * pakiety dla wybranego fotografa
	 *******************************************************************/







	function formularz_zamowienia($fotograf_ID, $pakiety){

	/***************************************
	 * PAKIET - ID , Nazwa, Opis, Cena
	****************************************/


/////////////////////////////////////////////////////
	echo '


	<div class="container">


	<div class="col-lg-12">
			<h1 class="page-header">Zamówienie</h1>
	</div>

	<form action="index.php?subpage=wyslij_zamowienie&fotograf_ID='.$fotograf_ID.'"  method="post">

	<table class = "table">
	<tr>
		<td>Tytul zamowienia
		<td><input type="text" name="tytul" style="width:500px;">
	<tr>
		<td>Tresc
		<td><textarea style="width:500px; height:150px;" name="komentarz"></textarea><br>
	</table>
	';
echo '
      <!-- Oferta -->

            <table class = "table">
                <caption>Oferta</caption>

                <thead>
                    <tr>
                        <th>Nazwa</th>
						<th>Wybierz pakiet</th>
                        <th>Opis</th>
                        <th>Cena</th>
                    </tr>
                </thead>

                <tbody>';


				$i = 0;
				if($pakiety != NULL){
				for($i; $i < count($pakiety); $i++){
                    echo '
					<tr>
                        <td id="nazwa">'.$pakiety[$i][1].'</td>
						<td><input type="checkbox" name="pakiet_id_'.$i.'" value="'.$pakiety[$i][0].'" />
                        <td id="opis">'.$pakiety[$i][2].'</td>
                        <td id="cena">'.$pakiety[$i][3].'</td>
                    </tr>';
				}


				}
				else
					echo '
					<tr><td colspan="4">Fotograf nie posiada rzadnych pakietów.
					';


					echo '
					<tr>
						<td colspan="4">
							<input type="hidden" name="ilosc_pakietow" value="'.$i.'">
							<input type="submit" name="submit" value="Złóż zamowienie">';

                echo '</tbody>



            </table>

        <!-- /Oferta -->
				';

				echo '

				</form>
				</div>


				';


	}




?>
