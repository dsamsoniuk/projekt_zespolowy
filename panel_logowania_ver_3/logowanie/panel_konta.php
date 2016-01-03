
<?php

/********************************************************************************
 * Plik w ktorym znajduja sie opisy paneli dla kazdego typu konta 
 * Panel Logowania, Panel Klient, Panel Fotograf
 ********************************************************************************/




/******** Panel podstawowa - Login, Haslo oraz Typ konta **********************************************************/

function panel_konta_logowania($msg_return) 
{
echo '
Panel Logowania<br>'.$msg_return.'<br>
 <form action="index.php" method="post">
  Login: <input type="text" name="login"><br>
  Hasło: <input type="password" name="password"><br>
  <input type="submit" name="submit" value="zaloguj sie">
</form> 
';
}

function panel_konta(){
	
	
/******** PANEL KLIENT  ******************************************************************************************/
	
if($_SESSION['poziom_uprawnien'] == "klient"){
echo '
Panel konta - Klient<br>
Witaj! '.$_SESSION['imie'].'<br>
<a href="">Zmien dane personalne</a><br>
<a href="index.php">lokalna poczta</a><br>
<a href="index.php?subpage=lista_zamowien">lista zamowien</a><br>
<a href="panel_logowania/wyloguj.php">wyloguj</a>
';

}

/******** PANEL FOTOGRAF_PRACOWNIK *********************************************************************************/

else if($_SESSION['poziom_uprawnien'] == "fotograf"){
echo '
Panel konta - Fotograf <br>
Witaj! '.$_SESSION['imie'].'<br>
<a href="">Zmien dane personalne</a><br>
<a href="index.php">lokalna poczta</a><br>
<a href="index.php?subpage=lista_zamowien">lista zamowien</a><br>
<a href="panel_logowania/wyloguj.php">wyloguj</a>
';
}




/******** Wiadomosc zwrotna w wypadku zlej nazwy typu konta  ***********************/

else echo 'Błąd w pliku panel. Taki typ konta nie istnieje';


}

?>