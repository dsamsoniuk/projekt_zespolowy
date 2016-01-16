<?php







	/*******************************************************************
	 * Funkcja ktora sprawdza ilosc wybranych pakietow i umieszcza je
	 * w tablicy.
	 * Przesyla dalej dane zamowien do klasy zamiwienia.class.php
	 *******************************************************************/







function zloz_zamowienie($fotograf_ID){


		if(isset($_POST['ilosc_pakietow'])){

			for($i=0; $i < $_POST['ilosc_pakietow']; $i++){
				$nazwa_pakietu = 'pakiet_id_'.$i;

				if(isset($_POST[$nazwa_pakietu]))
					$wyb_pakiety[$i] = $_POST[$nazwa_pakietu];
			}

			if(isset($_POST['komentarz']))$komentarz = $_POST['komentarz'];
			else $komentarz = "Brak opisu";

			if(isset($_POST['tytul'])) $tytul = $_POST['tytul'];
			else $tytul = "Brak tytulu";


			$zamowienie = new zamowienia();
			$zamowienie->wyslij($fotograf_ID, $_SESSION['ID'], $tytul, $komentarz, $wyb_pakiety);



			/*****************************************************
			 * Przekierowanie na index po dokonaniu zamowienia
			 *****************************************************/


			echo '

			<div class="container">
				<center>
					<p style="color:green">Zamowienie zostało złożone!</p>
				</center>
			</div>
			';

			echo '
			<script type="text/javascript">
				setTimeout(function(){
					window.location.href = "index.php?subpage=profil&fotograf_ID='.$fotograf_ID.'";
				},1000);
				</script>';
			//echo '<br><a href="index.php?subpage=lista_fotografow">Wroc do strony glownej</a>';
		}
		else
			echo 'Blad, nie ma pakietow!';



}
?>
