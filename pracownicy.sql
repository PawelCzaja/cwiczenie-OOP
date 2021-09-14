-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 14 Wrz 2021, 11:31
-- Wersja serwera: 10.4.20-MariaDB
-- Wersja PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `pracownicy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dane_pracownikow`
--

CREATE TABLE `dane_pracownikow` (
  `imie` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL,
  `nazwisko` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `data_dolaczenia` date NOT NULL,
  `id` int(11) UNSIGNED NOT NULL,
  `placa_netto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `dane_pracownikow`
--

INSERT INTO `dane_pracownikow` (`imie`, `nazwisko`, `email`, `data_dolaczenia`, `id`, `placa_netto`) VALUES
('Adam', 'Solak', 'AdamSolak@poczta.pl', '2021-04-12', 5, 2200),
('Amelia', 'Sobol', 'Amelka@poczta.pl', '2021-09-11', 6, 3000),
('Tomasz', 'Borek', 'TomBor@gmail.com', '2021-09-12', 69, 2000);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `dane_pracownikow`
--
ALTER TABLE `dane_pracownikow`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `dane_pracownikow`
--
ALTER TABLE `dane_pracownikow`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
