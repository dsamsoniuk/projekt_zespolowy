<?php




function wyswietl_profil(){


	$brak_zdjecia = 'image/brak_obrazka.jpg';

	if(isset($_GET['fotograf_ID'])){


	/* Wczytaj dane profilu fotografa do tablicy dane */

	$profil = new profil();
	$dane_profilu = $profil->dane($_GET['fotograf_ID']);



	/* Wczyta zdjecia fotografa do tablicy 'zdjecia ' */

	$katalog_portfolio    = 'konta_uzytkownikow/'.$dane_profilu['login'].'/portfolio';
	if(is_dir($katalog_portfolio)){

	$zdjecia = scandir($katalog_portfolio);
	//print_r($zdjecia);

	echo '
	    <!-- Opis fotografa -->
        <div class="container">
            <div class="row">


                <h2 id="fotograf">'.$dane_profilu['imie'].' '.$dane_profilu['nazwisko'].'</h2>

								<div class="row-fluid">

                    <div class="col-lg-2 col-md-2 col-sm-2 column2 fotograf-bg">


                        <!--Sidebar content-->
                        <div class="wrapper-circle size" align="center">';

												/* Zdjecie profilowe glowne */

							if(count($zdjecia) > 2)
								echo '<img src="'.$katalog_portfolio.'/'.$zdjecia[2].'" class="img-circle size" alt=""/>';
							else
								echo '<img src="'.$brak_zdjecia.'" class="img-circle size" alt=""/>';


						echo '
                        </div>


                        <h4 class="nazwa-fotograf">'.$dane_profilu['imie'].' '.$dane_profilu['nazwisko'].'</h4>
												<p>'.$dane_profilu['miasto'].'</p>
                    </div>

                    <div class="col-lg-10 col-md-8 col-sm-8 paragraph column2">
                    	<!--Body content-->	'.$dane_profilu['opis'].'
										</div>

                </div>


            </div>
        </div>
        <hr>
        <!-- /Opis Fotografa --!>
	';






/***********************************************************
 *    Galeria
 ***********************************************************/




 echo '
 <!-- Galeria -->
 <div class="container">

     <div class="row">



         <div class="col-lg-12">
             <h1 class="page-header">Galeria</h1>
         </div>
 ';

         //------------------------------------- petla od 0 do 11 oraz link zdjecia ------------------------------


         /* Wyswietl zdjecia */

         if(count($zdjecia) > 2) {
         for($i=2; $i < count($zdjecia); $i++){
				 $j = $i - 2;
         echo '

         <div class="col-lg-3 col-md-4 col-xs-6 thumb">
             <a href="#galeria" class="thumbnail" data-toggle="modal" data-slide-to="'.$j.'">
                 <img class="img-responsive" src="'.$katalog_portfolio.'/'.$zdjecia[$i].'" alt="image">
             </a>
         </div>
         ';
			 }

         } // koniec galerii jezeli sa jakies zdjecia
         else echo 'brak zdjec';


 echo '
     </div> <!-- end - row ->

     <hr>
 ';

     if(count($zdjecia) > 2) {
 echo '
     <!-- Modal Galerii -->
     <div class="modal carousel" id="galeria" tabindex="-1">
         <div class="modal-dialog modal-lg">
             <div class="modal-content">
                 <div class="modal-body">

                     <ol class="carousel-indicators">
 ';
                       //--------------------------- petla od 0 do 11 ----------------------------
                       for($i=0; $i < count($zdjecia)-2; $i++)
                         if($i == 0)
                           echo '
                           <li data-target="#galeria" data-slide-to="0" class="active"></li>
                           ';
                         else
                           echo '
                           <li data-target="#galeria" data-slide-to="'.$i.'"></li>
                           ';
 echo '
                     </ol>



                     <div class="carousel-inner">
 ';

                     //---------------------------------------   petla od 1 do 12  -------------------------------
                     for($i=2; $i < count($zdjecia); $i++)
                       if($i == 2) // Pierwszy bedzie z opcja 'class item active'
                         echo '
                         <div class="item active">
                             <img src="'.$katalog_portfolio.'/'.$zdjecia[$i].'">
                         </div>
                         ';
                       else
                         echo '
                         <div class="item">
                             <img src="'.$katalog_portfolio.'/'.$zdjecia[$i].'">
                         </div>
                         ';


 echo '
                     </div><!-- /.carousel-inner -->

                     <a class="left carousel-control" href="#galeria" role="button" data-slide="prev">
                         <span class="glyphicon glyphicon-chevron-left"></span>
                     </a>
                     <a class="right carousel-control" href="#galeria" role="button" data-slide="next">
                         <span class="glyphicon glyphicon-chevron-right"></span>
                     </a>

                 </div><!-- /.modal-body -->
             </div><!-- /.modal-content -->
         </div><!-- /.modal-dialog -->
     </div><!-- /.modal -->
     ';
   }
   else echo 'brak zjdec (drugi warunek)';
   echo '
 </div>
  <!-- /Galeria -->
 ';




	}
	else
		echo '
		<div class="container"><hr>
			<p><b>Brak katalogu uzytkowniak!</b></p>
		</div>
		';







		echo '
        <!-- Formularz kontaktowy i kalendarz -->
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="well well-sm">
                        <form class="form-horizontal" method="post" data-toggle="validator">
                            <fieldset>
                                <legend class="text-left header">Napisz do mnie</legend>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input id="fname" name="name" type="text" placeholder="Imię" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input id="email" name="email" type="email" placeholder="Email" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <textarea class="form-control" id="message" name="message" placeholder="Wiadomość..." rows="7" required></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn btn-primary btn-lg">Wyślij</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <!-- formularz kontaktowy -->
                <div class="col=md-4 calendar">
                    <iframe src="https://calendar.google.com/calendar/embed?title=Sprawd%C5%BA%20wolne%20terminy&amp;showPrint=0&amp;showCalendars=0&amp;showTz=0&amp;height=250&amp;wkst=2&amp;hl=pl&amp;bgcolor=%23FFFFFF&amp;src=pjnaliqptrj8hfebt4cqagjkeg%40group.calendar.google.com&amp;color=%232952A3&amp;ctz=Europe%2FWarsaw" style="border-width:0" width="350" height="250" frameborder="0" scrolling="no"></iframe>
                </div>
            </div>
        </div>
        <hr>
        <!-- /Formularz kontaktowy -->
	';

}




	else {
		echo 'Brak fotograf_id';
	}


}
?>
