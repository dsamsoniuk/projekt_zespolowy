# Panel logowania ver.1


Panel posiada klase która tworzy sesje jeżeli nie znajdzie zadnej, jest link wyloguj usuniecie zawartości zmiennych sesji.

## Użycie

Wytarczy wstawić jak w przykładzie index.php 2 elementy :

* Nagłówej, wszystkie request, sesja.


> session_start();  
> ini_set('session.save_path', 'panel_logowania/sesja');     // Nowa sciezka dla sesji
> require('config.php');                               // Panel konfiguracyjna
> require('panel_logowania/logowanie.class.php');      // Sprawdza czy istnieje sesja i tworzy nowa jezeli nie istnieje
> require('panel_logowania/panel_konta.php');          // Wyglad i uklad panelu konta

* Cialo panelu logowania ktory tworzy obiekt i umieszcza w sesji zmienne z bazy danych

> $log = new logowanie();
> $log->dane_serwera($server_name, $user_name, $password, $server_db);
> $msg_return = $log->sprawdz_dane_log();  // Zwraca informacje o logowaniu

> if($msg_return == "panel_konta")
> 	 panel_konta();                      // zmiany wygladu panelu w pliku panel_logowania/panel_kont.php
> else
> 	 panel_konta_logowania($msg_return); // zmiany wygladu panelu w pliku panel_logowania/panel_kont.php


* Dane serwera można zmienić w pliku config.php
