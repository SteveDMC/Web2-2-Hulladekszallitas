-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Nov 04. 16:18
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `hulladekszallitas`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` int(10) UNSIGNED NOT NULL,
  `csaladi_nev` varchar(45) NOT NULL DEFAULT '',
  `utonev` varchar(45) NOT NULL DEFAULT '',
  `bejelentkezes` varchar(12) NOT NULL DEFAULT '',
  `jelszo` varchar(40) NOT NULL DEFAULT '',
  `jogosultsag` varchar(3) NOT NULL DEFAULT '_1_'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `csaladi_nev`, `utonev`, `bejelentkezes`, `jelszo`, `jogosultsag`) VALUES
(1, 'Rendszer', 'Admin', 'Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '__1'),
(2, 'Családi_2', 'Utónév_2', 'Login2', '6cf8efacae19431476020c1e2ebd2d8acca8f5c0', '_1_'),
(3, 'Családi_3', 'Utónév_3', 'Login3', 'df4d8ad070f0d1585e172a2150038df5cc6c891a', '_1_'),
(4, 'Családi_4', 'Utónév_4', 'Login4', 'b020c308c155d6bbd7eb7d27bd30c0573acbba5b', '_1_'),
(5, 'Családi_5', 'Utónév_5', 'Login5', '9ab1a4743b30b5e9c037e6a645f0cfee80fb41d4', '_1_'),
(6, 'Családi_6', 'Utónév_6', 'Login6', '7ca01f28594b1a06239b1d96fc716477d198470b', '_1_'),
(7, 'Családi_7', 'Utónév_7', 'Login7', '41ad7e5406d8f1af2deef2ade4753009976328f8', '_1_'),
(8, 'Családi_8', 'Utónév_8', 'Login8', '3a340fe3599746234ef89591e372d4dd8b590053', '_1_'),
(9, 'Családi_9', 'Utónév_9', 'Login9', 'c0298f7d314ecbc5651da5679a0a240833a88238', '_1_'),
(10, 'Családi_10', 'Utónév_10', 'Login10', 'a477427c183664b57f977661ac3167b64823f366', '_1_');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `lakig`
--

CREATE TABLE `lakig` (
  `azon` int(11) NOT NULL,
  `igeny` date NOT NULL,
  `szolgid` int(11) NOT NULL,
  `mennyiseg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- A tábla adatainak kiíratása `lakig`
--

INSERT INTO `lakig` (`azon`, `igeny`, `szolgid`, `mennyiseg`) VALUES
(111, '2018-01-04', 5, 1),
(112, '2018-01-11', 5, 1),
(113, '2018-01-18', 4, 2),
(114, '2018-01-18', 5, 1),
(115, '2018-01-17', 3, 1),
(116, '2018-01-24', 5, 1),
(117, '2018-01-30', 1, 3),
(118, '2018-01-31', 4, 1),
(119, '2018-02-01', 5, 1),
(120, '2018-02-08', 5, 1),
(121, '2018-02-13', 4, 1),
(122, '2018-02-15', 5, 1),
(123, '2018-02-22', 5, 1),
(124, '2018-02-27', 1, 2),
(125, '2018-03-02', 4, 1),
(126, '2018-03-01', 5, 1),
(127, '2018-03-04', 3, 2),
(128, '2018-03-08', 5, 1),
(129, '2018-03-15', 5, 1),
(130, '2018-03-21', 5, 1),
(131, '2018-03-29', 5, 1),
(132, '2018-04-03', 3, 6),
(133, '2018-04-05', 5, 1),
(134, '2018-04-11', 3, 19),
(135, '2018-04-09', 4, 1),
(136, '2018-04-10', 5, 1),
(137, '2018-04-19', 5, 1),
(138, '2018-04-26', 5, 1),
(139, '2018-04-29', 3, 5),
(140, '2018-05-03', 5, 1),
(141, '2018-05-06', 3, 4),
(142, '2018-05-10', 5, 1),
(143, '2018-05-16', 3, 3),
(144, '2018-05-17', 5, 1),
(145, '2018-05-21', 3, 3),
(146, '2018-05-22', 1, 1),
(147, '2018-05-24', 4, 1),
(148, '2018-05-24', 5, 1),
(149, '2018-05-27', 3, 3),
(150, '2018-05-31', 5, 1),
(151, '2018-06-03', 5, 1),
(152, '2018-06-04', 3, 5),
(153, '2018-06-04', 1, 3),
(154, '2018-06-06', 4, 3),
(155, '2018-06-07', 5, 1),
(156, '2018-06-10', 5, 1),
(157, '2018-06-10', 3, 2),
(158, '2018-06-14', 5, 1),
(159, '2018-06-17', 5, 1),
(160, '2018-06-20', 3, 2),
(161, '2018-06-20', 4, 1),
(162, '2018-06-21', 5, 1),
(163, '2018-06-24', 5, 1),
(164, '2018-06-25', 3, 2),
(165, '2018-06-27', 5, 1),
(166, '2018-07-01', 5, 1),
(167, '2018-07-02', 3, 1),
(168, '2018-07-02', 4, 3),
(169, '2018-07-05', 5, 1),
(170, '2018-07-08', 5, 1),
(171, '2018-07-08', 3, 3),
(172, '2018-07-12', 5, 1),
(173, '2018-07-15', 5, 1),
(174, '2018-07-16', 3, 1),
(175, '2018-07-18', 1, 1),
(176, '2018-07-19', 4, 2),
(177, '2018-07-19', 5, 1),
(178, '2018-07-22', 5, 1),
(179, '2018-07-22', 3, 1),
(180, '2018-07-26', 5, 1),
(181, '2018-07-29', 5, 1),
(182, '2018-07-31', 3, 2),
(183, '2018-08-26', 5, 1),
(184, '2018-08-29', 3, 3),
(185, '2018-08-27', 1, 1),
(186, '2018-08-29', 4, 1),
(187, '2018-08-30', 5, 1),
(188, '2018-09-01', 3, 4),
(189, '2018-09-06', 5, 1),
(190, '2018-09-09', 3, 3),
(191, '2018-09-10', 1, 3),
(192, '2018-09-13', 5, 1),
(193, '2018-09-18', 3, 2),
(194, '2018-09-20', 5, 1),
(195, '2018-09-23', 3, 1),
(196, '2018-09-24', 4, 2),
(197, '2018-09-27', 5, 1),
(198, '2018-09-29', 3, 1),
(199, '2018-10-04', 5, 1),
(200, '2018-10-10', 3, 2),
(201, '2018-10-10', 5, 1),
(202, '2018-10-15', 3, 2),
(203, '2018-10-18', 5, 1),
(204, '2018-10-22', 3, 6),
(205, '2018-10-25', 5, 1),
(206, '2018-10-31', 3, 3),
(207, '2018-11-01', 5, 1),
(208, '2018-11-04', 3, 13),
(209, '2018-11-05', 1, 2),
(210, '2018-11-07', 4, 1),
(211, '2018-11-15', 5, 1),
(212, '2018-11-17', 3, 7),
(213, '2018-11-22', 5, 1),
(214, '2018-11-26', 3, 3),
(215, '2018-11-29', 5, 1),
(216, '2018-12-06', 5, 1),
(217, '2018-12-13', 5, 1),
(218, '2018-12-19', 4, 2),
(219, '2018-12-20', 5, 1),
(220, '2018-12-26', 5, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `menu`
--

CREATE TABLE `menu` (
  `url` varchar(30) NOT NULL,
  `nev` varchar(30) NOT NULL,
  `szulo` varchar(30) NOT NULL,
  `jogosultsag` varchar(3) NOT NULL,
  `sorrend` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- A tábla adatainak kiíratása `menu`
--

INSERT INTO `menu` (`url`, `nev`, `szulo`, `jogosultsag`, `sorrend`) VALUES
('admin', 'Admin', '', '001', 80),
('alapinfok', 'Alapinfók', 'elerhetoseg', '111', 40),
('belepes', 'Belépés', '', '100', 60),
('elerhetoseg', 'Elérhetőség', '', '111', 20),
('kiegeszitesek', 'Kiegészítések', 'elerhetoseg', '011', 50),
('kilepes', 'Kilépés', '', '011', 70),
('linkek', 'Linkek', '', '100', 30),
('nyitolap', 'Nyitólap', '', '111', 10);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `naptar`
--

CREATE TABLE `naptar` (
  `azon` int(11) NOT NULL,
  `datum` date NOT NULL,
  `szolgid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- A tábla adatainak kiíratása `naptar`
--

INSERT INTO `naptar` (`azon`, `datum`, `szolgid`) VALUES
(1, '2018-01-03', 1),
(2, '2018-01-03', 4),
(3, '2018-01-04', 5),
(4, '2018-01-11', 5),
(5, '2018-01-17', 1),
(6, '2018-01-17', 4),
(7, '2018-01-18', 5),
(8, '2018-01-18', 3),
(9, '2018-01-25', 5),
(10, '2018-01-25', 3),
(11, '2018-01-31', 1),
(12, '2018-01-31', 4),
(13, '2018-02-01', 5),
(14, '2018-02-08', 5),
(15, '2018-02-14', 1),
(16, '2018-02-14', 4),
(17, '2018-02-15', 5),
(18, '2018-02-22', 5),
(19, '2018-02-28', 1),
(20, '2018-02-28', 4),
(21, '2018-03-01', 5),
(22, '2018-03-05', 3),
(23, '2018-03-08', 5),
(24, '2018-03-12', 3),
(25, '2018-03-14', 1),
(26, '2018-03-14', 4),
(27, '2018-03-15', 5),
(28, '2018-03-19', 3),
(29, '2018-03-22', 5),
(30, '2018-03-26', 3),
(31, '2018-03-28', 1),
(32, '2018-03-28', 4),
(33, '2018-03-29', 5),
(34, '2018-04-02', 3),
(35, '2018-04-05', 5),
(36, '2018-04-09', 3),
(37, '2018-04-11', 1),
(38, '2018-04-11', 4),
(39, '2018-04-12', 5),
(40, '2018-04-16', 3),
(41, '2018-04-19', 5),
(42, '2018-04-23', 3),
(43, '2018-04-25', 1),
(44, '2018-04-25', 4),
(45, '2018-04-26', 5),
(46, '2018-04-30', 3),
(47, '2018-05-03', 5),
(48, '2018-05-07', 3),
(49, '2018-05-09', 1),
(50, '2018-05-09', 4),
(51, '2018-05-10', 5),
(52, '2018-05-14', 3),
(53, '2018-05-17', 5),
(54, '2018-05-21', 3),
(55, '2018-05-23', 1),
(56, '2018-05-23', 4),
(57, '2018-05-24', 5),
(58, '2018-05-28', 3),
(59, '2018-05-31', 5),
(60, '2018-06-03', 5),
(61, '2018-06-04', 3),
(62, '2018-06-06', 1),
(63, '2018-06-06', 4),
(64, '2018-06-07', 5),
(65, '2018-06-10', 5),
(66, '2018-06-11', 3),
(67, '2018-06-14', 5),
(68, '2018-06-17', 5),
(69, '2018-06-18', 3),
(70, '2018-06-20', 1),
(71, '2018-06-20', 4),
(72, '2018-06-21', 5),
(73, '2018-06-24', 5),
(74, '2018-06-25', 3),
(75, '2018-06-28', 5),
(76, '2018-07-01', 5),
(77, '2018-07-02', 3),
(78, '2018-07-04', 1),
(79, '2018-07-04', 4),
(80, '2018-07-05', 5),
(81, '2018-07-08', 5),
(82, '2018-07-09', 3),
(83, '2018-07-12', 5),
(84, '2018-07-15', 5),
(85, '2018-07-16', 3),
(86, '2018-07-18', 1),
(87, '2018-07-18', 4),
(88, '2018-07-19', 5),
(89, '2018-07-22', 5),
(90, '2018-07-23', 3),
(91, '2018-07-26', 5),
(92, '2018-07-29', 5),
(93, '2018-07-30', 3),
(94, '2018-08-01', 1),
(95, '2018-08-01', 4),
(96, '2018-08-02', 5),
(97, '2018-08-05', 5),
(98, '2018-08-06', 3),
(99, '2018-08-09', 5),
(100, '2018-08-12', 5),
(101, '2018-08-13', 3),
(102, '2018-08-15', 1),
(103, '2018-08-15', 4),
(104, '2018-08-16', 5),
(105, '2018-08-19', 5),
(106, '2018-08-20', 3),
(107, '2018-08-23', 5),
(108, '2018-08-26', 5),
(109, '2018-08-27', 3),
(110, '2018-08-29', 1),
(111, '2018-08-29', 4),
(112, '2018-08-30', 5),
(113, '2018-09-03', 3),
(114, '2018-09-06', 5),
(115, '2018-09-10', 3),
(116, '2018-09-12', 1),
(117, '2018-09-12', 4),
(118, '2018-09-13', 5),
(119, '2018-09-17', 3),
(120, '2018-09-20', 5),
(121, '2018-09-24', 3),
(122, '2018-09-26', 1),
(123, '2018-09-26', 4),
(124, '2018-09-27', 5),
(125, '2018-10-01', 3),
(126, '2018-10-04', 5),
(127, '2018-10-08', 3),
(128, '2018-10-10', 1),
(129, '2018-10-10', 4),
(130, '2018-10-11', 5),
(131, '2018-10-15', 3),
(132, '2018-10-18', 5),
(133, '2018-10-22', 3),
(134, '2018-10-24', 1),
(135, '2018-10-24', 4),
(136, '2018-10-25', 5),
(137, '2018-10-29', 3),
(138, '2018-11-01', 5),
(139, '2018-11-05', 3),
(140, '2018-11-07', 1),
(141, '2018-11-07', 4),
(142, '2018-11-08', 5),
(143, '2018-11-12', 3),
(144, '2018-11-15', 5),
(145, '2018-11-19', 3),
(146, '2018-11-21', 1),
(147, '2018-11-21', 4),
(148, '2018-11-22', 5),
(149, '2018-11-26', 3),
(150, '2018-11-29', 5),
(151, '2018-12-05', 1),
(152, '2018-12-05', 4),
(153, '2018-12-06', 5),
(154, '2018-12-13', 5),
(155, '2018-12-19', 1),
(156, '2018-12-20', 5),
(157, '2018-12-27', 5);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szolgaltatas`
--

CREATE TABLE `szolgaltatas` (
  `id` int(11) NOT NULL,
  `tipus` varchar(50) NOT NULL,
  `jelentes` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- A tábla adatainak kiíratása `szolgaltatas`
--

INSERT INTO `szolgaltatas` (`id`, `tipus`, `jelentes`) VALUES
(1, 'mua', 'Műanyag hulladék: PET palack, kozmetikai flakonok(PP+HDPE), szatyor, zacskó.'),
(2, 'uv', 'Üveg hulladék: színes és fehér üveg.'),
(3, 'zold', 'Zöldhulladék: komposztálható, kerti hulladékok.'),
(4, 'pa', 'Papírhulladékok: újságok, könyvek, kartondobozok.'),
(5, 'kom', 'Kommunális hulladék: szilárd, a lakókörnyezetünkben található, nem lebomló, nem veszélyes hulladék.');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `lakig`
--
ALTER TABLE `lakig`
  ADD PRIMARY KEY (`azon`),
  ADD KEY `szolgid` (`szolgid`);

--
-- A tábla indexei `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`url`);

--
-- A tábla indexei `naptar`
--
ALTER TABLE `naptar`
  ADD PRIMARY KEY (`azon`),
  ADD KEY `szolgid` (`szolgid`);

--
-- A tábla indexei `szolgaltatas`
--
ALTER TABLE `szolgaltatas`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `lakig`
--
ALTER TABLE `lakig`
  MODIFY `azon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT a táblához `naptar`
--
ALTER TABLE `naptar`
  MODIFY `azon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=315;

--
-- AUTO_INCREMENT a táblához `szolgaltatas`
--
ALTER TABLE `szolgaltatas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `lakig`
--
ALTER TABLE `lakig`
  ADD CONSTRAINT `lakig_ibfk_1` FOREIGN KEY (`szolgid`) REFERENCES `szolgaltatas` (`id`);

--
-- Megkötések a táblához `naptar`
--
ALTER TABLE `naptar`
  ADD CONSTRAINT `naptar_ibfk_1` FOREIGN KEY (`szolgid`) REFERENCES `szolgaltatas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
