# Opis aplikacji
W kilku elementach wskażę elementy, które podlegały edycji w tej aplikacji, co przyda się bardzo podczas jej analizowania.
Aplikacja działa w taki sposób, że:

 - wyświetla interaktywną **stronę główną**
	 - wskazuje, które samochody są zarezerwowane, a które można zarezerwować
	 - wyświetla w tzw. "karuzeli" tylko te samochody, które są dostępne
	 - pozwala przejść do **panelu administracyjnego**
 - wyświetla **stronę pojazdu**
	 - pozwala przeliczyć stawkę w zależności od czasu wypożyczenia (dzięki bibliotece jQuery, chociaż mogłem też jeszcze łatwiej zastosować VueJS)
	 - pokazuje, gdzie dokładnie teraz znajduje się pojazd (wykorzystano Google Maps API)
	 - pozwala przejść do kolejnego etapu rezerwacji, a więc wprowadzenia imienia i adresu email w trakcie rezerwacji
	 - wysyła spersonalizowaną wiadomość email (wbudowana usługa Email we frameworku)
 - wyświetla **stroną administracyjną**, gdzie można zarządzać pojazdami
	 - pozwala edytować każdy pojazd z osobna
	 - w pełni obsługuje system logowania na podstawie predefiniowanych danych do logowania'

Właściwie cała aplikacja na tym etapie stanowi podstawę do mocnego jej rozwoju, na przykład poprzez dodanie 3 linijek kodu można zmienić system logowania na taki, który obsługuje nieograniczoną liczbę użytkowników, także z wykorzystaniem bazy danych.

## Baza danych
Oczywiście najnowsze PHP korzysta z MySQLi. Aby aplikacja działała prawidłowo w obecnym kształcie - wystarczy tylko jedna tabela, którą wskazuję poniżej. Struktura bazy danych jest obowiązkowa, zawartość jest nieograniczona i dowolna.
Nie korzystałem z `seeds` ani `migrations` - po prostu dla takiej aplikacji nie ma takiej potrzeby.
### Struktura bazy danych
![](https://rezerwacja.onrop.pl/dodatki/zrzut2.png)

    CREATE TABLE IF NOT EXISTS `samochody` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `marka` varchar(32) NOT NULL,
      `model` varchar(32) NOT NULL,
      `produkcja` int(4) NOT NULL,
      `stawka` int(5) NOT NULL DEFAULT '100',
      `status` varchar(2) NOT NULL,
      `miejsce_krotko` varchar(64) DEFAULT NULL,
      `miejsce_dokladne` varchar(256) DEFAULT NULL,
      `obrazek` varchar(512) NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

### Zawartość bazy danych
![](https://rezerwacja.onrop.pl/dodatki/zrzut1.png)
### Zrzut bazy danych 

    INSERT INTO `samochody` (`id`, `marka`, `model`, `produkcja`, `stawka`, `status`, `miejsce_krotko`, `miejsce_dokladne`, `obrazek`) VALUES
    (1, 'BMW', 'Seria 4', 2020, 120, '0', 'Warszawa', 'ul. Koszykowa 61, 00-675 Warszawa', 'https://rezerwacja.onrop.pl/obrazki/bmw-4.jpg'),
    (2, 'Mercedes', 'AMG GT 4-Door', 2020, 190, '0', NULL, NULL, 'https://rezerwacja.onrop.pl/obrazki/mercedes-gt.jpg'),
    (3, 'Opel', 'Insignia', 2020, 91, '0', 'Warszawa', 'ul. Poznańska 12, 00-680 Warszawa', 'https://rezerwacja.onrop.pl/obrazki/opel-insignia.jpg'),
    (4, 'Skoda', 'Rapid', 2020, 90, '0', 'Łódź', 'ul. Narutowicza 22, 90-001 Łódź', 'https://rezerwacja.onrop.pl/obrazki/skoda-rapid.jpg'),
    (5, 'Skoda', 'Superb', 2020, 100, '1', 'Wrocław', 'ul. Grochowa 36, 53-425 Wrocław', 'https://rezerwacja.onrop.pl/obrazki/skoda-superb.jpg'),
    (6, 'Toyota', 'Camry', 2020, 110, '0', NULL, NULL, 'https://rezerwacja.onrop.pl/obrazki/toyota-camry.jpg');
## Edytowane pliki
Do dyspozycji mamy cały framework zaprojektowany według wzorca MVC (Model-View-Controller) i ta aplikacja korzysta całkowicie z tego wzorca.
### Model
Aplikacja korzysta tylko z jednej tabeli bazy danych o nazwie *samochody*. W związku z tym model "Samochody" znajduje się w `/app/Models/SamochodyModel.php`.
O sposobie korzystania z modeli we frameworku można doczytać [w dokumentacji](https://codeigniter.com/user_guide/models/model.html).
### View
Aplikacja aktywnie korzysta z widoków, które w kontrolerach przywoływane są poprzez instrukcję `echo view();`. Wszystkie widoki użyte w aplikacji znajdują w `/app/Views/`. Celowo nie usuwałem katalogu `./errors/`. 
O sposobie korzystania z kontrolerów we frameworku można doczytać [w dokumentacji](https://codeigniter.com/user_guide/outgoing/views.html).
### Controller
Aplikacja jest prosta, więc dla wygody działa w jednym kontrolerze, który nazywa się `App` i znajduje się w `/app/Controllers/App.php` i jest rozszerzeniem kontrolera `BaseController` znajdującego się w tym samym katalogu. Oczywiście nie ma konieczności rozszerzania BaseControllera i można było całą aplikację budować tylko na `BaseController`, jednak z mojej praktyki już wynika tak, że lubię mieć osobny, wyodrębniony kontroler do definiowania globalnych ustawień.
O sposobie korzystania z kontrolerów we frameworku można doczytać [w dokumentacji](https://codeigniter.com/user_guide/incoming/controllers.html).
## Routing URI
Aby cała aplikacja działała - należało w odpowiedni sposób ustawić routing. Dzięki temu w odpowiedni sposób mogła pracować adresacja (pasek adresu) wewnątrz aplikacji. Cały routing jest zdefiniowany w pliku definicji Routera, w `/app/Config/Routes.php`.
O sposobie korzystania z routingu we frameworku można doczytać [w dokumentacji](https://codeigniter.com/user_guide/incoming/routing.html).
