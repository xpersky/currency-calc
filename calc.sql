-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 27 Maj 2019, 12:25
-- Wersja serwera: 10.1.37-MariaDB
-- Wersja PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `calc`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `capitals`
--

CREATE TABLE `capitals` (
  `id` int(11) NOT NULL,
  `capital_with_currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `capitals`
--

INSERT INTO `capitals` (`id`, `capital_with_currency`) VALUES
(46, 'Wiedeń, EUR'),
(47, 'Bruksela, EUR'),
(48, 'Praga, CZK'),
(49, 'Kopenhaga, DKK'),
(50, 'Helsinki, EUR'),
(51, 'Paryż, EUR'),
(52, 'Ateny, EUR'),
(53, 'Madryt, EUR'),
(54, 'Amsterdam, EUR'),
(55, 'Dublin, EUR'),
(56, 'Luksemburg, EUR'),
(57, 'Ryga, EUR'),
(58, 'Vallletta, EUR'),
(59, 'Monako, EUR'),
(60, 'Berlin, EUR'),
(61, 'Oslo, NOK'),
(62, 'Lizbona, EUR'),
(63, 'Moskwa, RUB'),
(64, 'San Marino, EUR'),
(65, 'Bratysława, EUR'),
(66, 'Lublana, EUR'),
(67, 'Berno, CHF'),
(68, 'Sztokholm, SEK'),
(69, 'Watykan, EUR'),
(70, 'Budapeszt, HUF'),
(71, 'Londyn, GBP'),
(72, 'Rzym, EUR'),
(73, 'Tirana, ALL'),
(74, 'Sarajewo, BAM'),
(75, 'Sofia, BGN'),
(76, 'Wilno, LTL'),
(77, 'Skopie, MKD'),
(78, 'Kijów, UAH'),
(79, 'Kiszyniów, MDL'),
(80, 'Bukareszt, RON'),
(81, 'Belgrad, RSD'),
(82, 'Kair, EGP'),
(83, 'Rejkiawik, ISK');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190521112838', '2019-05-21 11:28:53');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `capitals`
--
ALTER TABLE `capitals`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `capitals`
--
ALTER TABLE `capitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
