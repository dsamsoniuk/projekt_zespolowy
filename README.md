# Projekt_zespolowy

* Dokumentacja (ProjektZespoowy.odt)

## Dostepne moduly :

* Moduł logowania - panel w którym wpisuje sie login oraz haslo, haslo jest szyfrowane za pomoca algorytmu md5 nastepnie porownywane z haslem pobranym z bazy danych. Po zalogowaniu tworzona jest sesja a w niej wszystkie dane wybranego uzytkownika i jest przekierowywany na strone glowna.

* Modul rejestracji - panel formularzu posiada wszystkie dane np.login,haslo, miasto, ulice ... .Po wybraniu typu konta sa sprawdzane dane w bazie czy już nie istnieja (dotyczy loginu, emaila) a nastepnie tworzony insert uzytkownika  a dodatkowo dla typu konta fotograf sa tworzone foldery na serwerze.

* Modul wyswietlanej listy fotografow - wyswietlana jest lista wszystkich fotografow wraz ze stronicowaniem dodatkowo jezeli zostanie podane slowo-klucz z wyszukiwarki nazwisk zostanie wyswietlona tylko czesc fotografow z slowem-kluczowym w nazwisku. Dodatkowo jest wyszukiwarka ktora wyszukuje fotografow po nazwisku lub miescie.

* Modul lista zamowien oraz usuwanie wybraych zamowien (usuwanie tylko dla fotografow) - lista zamowien wyswietlana dla obydwu typow kont z ta roznica, ze klient moze tylko wyswietlić informacje o zamowieniach pakietów ktore wyslal do fotografa natomiast nie moze ich usuwać ta mozliwosc ma tylko fotograf ktory dostal zamowienie. Zostala rozszerzona o dodatkowe opcje takie jak zmiana statusu, usuwanie, suma cen pakietow i odnosnik email oraz wyswietlana historia zamowien.

* Modul zamowienia - jest to formularz wyswietlany tylko w profilu fotografa dodatkowo pobiera do niego pakiety tylko wybranego fotografa i moga byc wybierane dowoli wszystkie lub zaden. Dane z formularza sa przesylane na serwer (do tabeli: skladowe_zamowien, zamowienia).

* Modul profil - pobiera dane z serwera i wyswietla opis, imie, nazwisko oraz pierwsze zdjecie z katalogu portfolio.  

* Modul zmiana danych personalnych - Formularz wraz z aktualizacja wybranych przez uzytkownika danych.
