-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Host: sqlrabat.dhosting.pl
-- Czas wygenerowania: 18 Lis 2020, 15:58
-- Wersja serwera: 10.0.27-MariaDB-cll-lve
-- Wersja PHP: 5.3.29-dh127

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `pheo9p_rezerwacja`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `samochody`
--

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

--
-- Zrzut danych tabeli `samochody`
--

INSERT INTO `samochody` (`id`, `marka`, `model`, `produkcja`, `stawka`, `status`, `miejsce_krotko`, `miejsce_dokladne`, `obrazek`) VALUES
(1, 'BMW', 'Seria 4', 2020, 120, '0', 'Warszawa', 'ul. Koszykowa 61, 00-675 Warszawa', 'https://rezerwacja.onrop.pl/obrazki/bmw-4.jpg'),
(2, 'Mercedes', 'AMG GT 4-Door', 2020, 190, '0', NULL, NULL, 'https://rezerwacja.onrop.pl/obrazki/mercedes-gt.jpg'),
(3, 'Opel', 'Insignia', 2020, 91, '0', 'Warszawa', 'ul. Poznańska 12, 00-680 Warszawa', 'https://rezerwacja.onrop.pl/obrazki/opel-insignia.jpg'),
(4, 'Skoda', 'Rapid', 2020, 90, '0', 'Łódź', 'ul. Narutowicza 22, 90-001 Łódź', 'https://rezerwacja.onrop.pl/obrazki/skoda-rapid.jpg'),
(5, 'Skoda', 'Superb', 2020, 100, '1', 'Wrocław', 'ul. Grochowa 36, 53-425 Wrocław', 'https://rezerwacja.onrop.pl/obrazki/skoda-superb.jpg'),
(6, 'Toyota', 'Camry', 2020, 110, '0', NULL, NULL, 'https://rezerwacja.onrop.pl/obrazki/toyota-camry.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
