# Panel logowania ver.1


Panel posiada klase która tworzy sesje jeżeli nie znajdzie zadnej, jest link wyloguj usuniecie zawartości zmiennych sesji.

## Użycie

Wytarczy wstawić jak w przykładzie index.php 2 elementy :

* Nagłówej, wszystkie requesty oraz sesja.

```js
 session_start();  
 ini_set('session.save_path', 'panel_logowania/sesja');
 require('main.class.php');   
 require('config.php');                              
 require('panel_logowania/logowanie.class.php');     
 require('panel_logowania/panel_konta.php');          
```

* Cialo panelu logowania ktory tworzy obiekt i umieszcza w sesji zmienne z bazy danych
```js
 $log = new logowanie();
 $msg_return = $log->sprawdz_dane_log();  

 if($msg_return == "panel_konta")
 	 panel_konta();                      
 else
 	 panel_konta_logowania($msg_return);
```

* Dane serwera można zmienić w pliku config.php
