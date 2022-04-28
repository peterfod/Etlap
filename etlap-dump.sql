-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Már 14. 21:13
-- Kiszolgáló verziója: 10.4.22-MariaDB
-- PHP verzió: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `etlap`
--
CREATE DATABASE IF NOT EXISTS `etlap` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `etlap`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `etelek`
--

CREATE TABLE `etelek` (
  `etelAz` int(11) NOT NULL,
  `etelNev` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `ar` int(6) NOT NULL,
  `leiras` varchar(100) COLLATE utf8mb4_hungarian_ci DEFAULT NULL,
  `katAz` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `etelek`
--

INSERT INTO `etelek` (`etelAz`, `etelNev`, `ar`, `leiras`, `katAz`) VALUES
(1, 'Húsleves', 699, 'Csigatésztával', 2),
(2, 'Gulyásleves', 700, NULL, 2),
(3, 'Gyümölcsleves', 700, 'Erdei gyümölcsökből', 2),
(4, 'Tatár beefsteak', 1200, 'Fokhagymás pirítóssal', 1),
(5, 'Sült libamáj falatkák', 1500, NULL, 1),
(6, 'Kertészsaláta', 500, 'Ecetes, bazsalikomos öntettel', 1),
(7, 'Rántott csirkemell', 1200, 'Vegyes körettel', 3),
(8, 'Mátrai borzaska', 1300, NULL, 3),
(9, 'Milánói Sertésborda', 1400, NULL, 3),
(10, 'Kovászos uborka', 400, NULL, 4),
(11, 'Céklasaláta', 400, NULL, 4),
(12, 'Káposztasaláta', 400, NULL, 4),
(13, 'Sör', 500, 'Borsodi, Dreher, Pilsner', 5),
(14, 'Bor', 1600, 'Olaszrizling, Muskotály', 5),
(15, 'Pálinka', 3000, NULL, 5),
(16, 'Ásványvíz', 200, 'Szentkirályi', 6),
(17, 'Coca Cola', 200, '330 ml', 6),
(18, 'Kávé', 200, 'Presszó', 6);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kategoriak`
--

CREATE TABLE `kategoriak` (
  `katAz` int(11) NOT NULL,
  `katNev` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `kategoriak`
--

INSERT INTO `kategoriak` (`katAz`, `katNev`) VALUES
(1, 'Előétel'),
(2, 'Leves'),
(3, 'Főétel'),
(4, 'Savanyúság'),
(5, 'Alkoholos ital'),
(6, 'Alkoholmentes ital');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `etelek`
--
ALTER TABLE `etelek`
  ADD PRIMARY KEY (`etelAz`);

--
-- A tábla indexei `kategoriak`
--
ALTER TABLE `kategoriak`
  ADD PRIMARY KEY (`katAz`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `etelek`
--
ALTER TABLE `etelek`
  MODIFY `etelAz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
