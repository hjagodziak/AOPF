-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 24 Maj 2022, 16:08
-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `pracownicy_jagodzinski`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pracownicy`
--

CREATE TABLE `pracownicy` (
  `Numer` int(11) NOT NULL,
  `Imię` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `Nazwisko` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `Wiek` int(3) NOT NULL,
  `Staż` int(3) NOT NULL,
  `Stanowisko` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `Wydział` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `Pensja` decimal(10,2) NOT NULL,
  `Data_dodania` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `pracownicy`
--

INSERT INTO `pracownicy` (`Numer`, `Imię`, `Nazwisko`, `Wiek`, `Staż`, `Stanowisko`, `Wydział`, `Pensja`, `Data_dodania`) VALUES
(1, 'Eryk', 'Nowicki', 25, 3, 'Księgowy', 'Finanse', '4976.45', '2020-02-04'),
(2, 'Ewa', 'Jagodzińska', 35, 0, 'Informatyk', 'IT', '10587.00', '2022-04-05'),
(3, 'Stefan', 'Grzyb', 27, 12, 'Manager', 'IT', '7895.00', '2022-01-11'),
(4, 'Hubert', 'Jagodziński', 16, 0, 'Programista', 'IT', '0.00', '2021-12-07');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `pracownicy`
--
ALTER TABLE `pracownicy`
  ADD PRIMARY KEY (`Numer`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `pracownicy`
--
ALTER TABLE `pracownicy`
  MODIFY `Numer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
