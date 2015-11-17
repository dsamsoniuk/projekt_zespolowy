<?php



/*************************************************************
 * FORMULRZ REJESTRACYJNY
 * Ogolny wyglad formularzu
 * znajduja sie w niech wszystkie pola wymagane do rejestracji
 *************************************************************/

 
 
 
 
 

function formularz_rejestracyjny(){
	
echo '
 <form action="index.php" method="post">
 
   Wybierz typ konta: <br>
  <select name="poziom_uprawnien">
	<option value="klient_acc" selected>klient</option>
	<option value="fotograf_pracownik">fotograf</option>
	</select>
	<br>
login<br>
<input type="text" name="login"><br>
haslo<br>
<input type="password" name="haslo" value="sd"><br>
Imie<br>
<input type="text" name="imie" value="sd"><br>
Nazwisko<br>
<input type="text" name="nazwisko" value="sd"><br>
Telefon<br>
<input type="text" name="telefon" value="sd"><br>
Adres<br>
<input type="text" name="adres" value="sd"><br>
kod_pocztowy<br>
<input type="text" name="kod_pocztowy" value="sd"><br>
email<br>
<input type="text" name="e_mail" value="sd@aasd"><br>
Opis<br>
 <textarea rows="4" cols="50" name="opis">
At w3schools.com you will learn how to make a website. We offer free tutorials in all web development technologies.
</textarea> 		

  <input type="submit" name="submit_register" value="zarejestruj sie">
</form> 
';
	
}



?>