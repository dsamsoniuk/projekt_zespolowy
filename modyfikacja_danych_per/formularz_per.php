<?php



function dane_personalne(){

  echo '
  <br><center><h2>Dane personalne</h2></center><br><br>


<div class="col-lg-6 col-md-4 col-xs-6 thumb" >

  <form class="form" role="form" method="post" action="index.php?subpage=aktualizuj_dane_per" accept-charset="UTF-8" id="rejestracja">

  <div class="form-group">

  <h5>Typ konta: '.$_SESSION['poziom_uprawnien'].'
    </h5>
  </div>


  <div class="form-group">
      Login: '.$_SESSION['imie'].'
  </div>
haslo
  <div class="form-group">
      <input type="password" name="haslo" class="form-control" placeholder="Hasło" value="'.$_SESSION['haslo'].'" required>
  </div>
imie
  <div class="form-group">
      <input type="text" name="imie" class="form-control" placeholder="Imię" value="'.$_SESSION['imie'].'" required>
  </div>
nazwisko
  <div class="form-group">
      <input type="text" name="nazwisko" class="form-control" placeholder="nazwisko" value="'.$_SESSION['nazwisko'].'" required>
  </div>
telefon
  <div class="form-group">
      <input type="text" name="telefon" class="form-control" placeholder="telefon" value="'.$_SESSION['telefon'].'" required>
  </div>
miasto
  <div class="form-group">
      <input type="text" name="miasto" class="form-control" placeholder="miasto" value="'.$_SESSION['miasto'].'" required>
  </div>
ulica
  <div class="form-group">
      <input type="text" name="ulica" class="form-control" placeholder="ulica" value="'.$_SESSION['ulica'].'" required>
  </div>
kod_pocztowy
  <div class="form-group">
      <input type="text" name="kod_pocztowy" class="form-control" placeholder="kod_pocztowy" value="'.$_SESSION['kod_pocztowy'].'" required>
  </div>

e_mail
  <div class="form-group">
      <input type="text" name="e_mail" class="form-control" placeholder="e_mail" value="'.$_SESSION['email'].'" required>
  </div>
opis
  <div class="form-group">
   <textarea rows="10" cols="50" name="opis"  class="form-control" value="robot" placeholder="" required>
   '.$_SESSION['opis'].'
  </textarea>

  </div>

  <div class="form-group">
      <button type="submit"  name="submit_register" class="btn btn-success btn-block">Zmien dane personalne</button>
  </div>



  </form>

</div>
  ';



}








?>
