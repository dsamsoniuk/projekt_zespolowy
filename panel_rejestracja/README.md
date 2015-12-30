# Rejestracja ver.1


Formularz rejestracyjny, wprowadzenie danych do formularza powoduje sprawdzenie danych
pod katem slownictwa oraz czy istnieja w bazie danych.


## Użycie

Wytarczy wstawić jak w przykładzie index.php 2 elementy :

* Nagłówej:

```js
 require('config.php');
 require('main.class.php');

 require('rejestracja/formularz_rejestracyjny.php');  // Wyglad formularza rejestracyjnego
 require('rejestracja/rejestracja_danych.php');       // Ogolny zarys warunkow odwolujacych sie do lasy rejestracja.class.php
 require('rejestracja/rejestracja.class.php');        // Klasa w ktorej dochodzi do sprawdzenia danych i zapisania w bazie        
```

* Formularz w wyznaczonym miejscu:
```js
 if(isset($\_POST['submit_register']))panel_rejestracyjna();
 else echo '';
 formularz_rejestracyjny();
```

* Tablice zakazanych slow mozna zmieniac w config.php
