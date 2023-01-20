-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Gép: localhost
-- Létrehozás ideje: 2022. Dec 15. 08:12
-- Kiszolgáló verziója: 10.3.32-MariaDB
-- PHP verzió: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `houseofswords`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `barrackstats`
--

CREATE TABLE `barrackstats` (
  `Lvl` int(11) NOT NULL,
  `MaxUnitCount` int(11) NOT NULL COMMENT 'maximum mennyi egységet képezhet a user',
  `MaxTrainingAmount` int(11) NOT NULL COMMENT 'egyszerre hány egységet képezhet',
  `MaxAttackRange` int(11) NOT NULL COMMENT 'a térképen milyen messze lévő városokra tud támadni'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `buildings`
--

CREATE TABLE `buildings` (
  `BuildingID` int(11) NOT NULL COMMENT 'épület azonosító',
  `Towns_TownID` int(11) NOT NULL COMMENT 'a város azonosítója',
  `BuildingType` varchar(20) COLLATE utf8_hungarian_ci NOT NULL COMMENT 'épület típusának megnevezése',
  `BuildingLvl` int(11) NOT NULL DEFAULT 1 COMMENT 'épület szintje',
  `Params` varchar(512) COLLATE utf8_hungarian_ci NOT NULL COMMENT 'épület által használt paraméterek, pontosvesszővel elválasztva'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `buildings`
--

INSERT INTO `buildings` (`BuildingID`, `Towns_TownID`, `BuildingType`, `BuildingLvl`, `Params`) VALUES
(1, 1, 'Barracks', 3, '10;20;30'),
(2, 1, 'Warehouse', 4, '40;20;50');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `campaign`
--

CREATE TABLE `campaign` (
  `LevelNum` int(11) NOT NULL,
  `Enemies` varchar(512) COLLATE utf8_hungarian_ci NOT NULL COMMENT 'A szinten legyőzendő ellenségek nevei felsorolva egymás után, pontosvesszővel elválasztva.',
  `EnemiesCount` varchar(512) COLLATE utf8_hungarian_ci NOT NULL COMMENT 'A felsorolt ellenségekből rendre hány darab van, pontosvesszővel elválasztva',
  `RewardString` varchar(128) COLLATE utf8_hungarian_ci NOT NULL COMMENT 'fa;kő;fém;arany'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `churchstats`
--

CREATE TABLE `churchstats` (
  `Lvl` int(11) NOT NULL,
  `MassLength` time NOT NULL COMMENT 'a mise hosszúsága',
  `HappinessBoost` int(11) NOT NULL COMMENT 'a mise által adott boldogság mennyisége',
  `ProductivityMultiplierString` varchar(128) COLLATE utf8_hungarian_ci NOT NULL COMMENT 'a boldogság hatása a termelékenységre, összetett karakterlánc: pl. 1-10-0,1;11-20-0,3...\r\naz első szám az alsó határ, a második a felső, a harmadik pedig az a szorzó, amivel a termelékenységet be kell szorozni a Warehouseban, ha a boldogságszint a két határ között van'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `diplomacystats`
--

CREATE TABLE `diplomacystats` (
  `Lvl` int(11) NOT NULL,
  `MaxAllyCount` int(11) NOT NULL COMMENT 'a maximum szövetségesek száma',
  `MaxAllyRange` int(11) NOT NULL COMMENT 'a térképen milyen messze lévő városokkal lehet szövetkezni'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `friendlist`
--

CREATE TABLE `friendlist` (
  `RelationID` int(11) NOT NULL,
  `FriendID` int(11) NOT NULL,
  `Users_UID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `friendlist`
--

INSERT INTO `friendlist` (`RelationID`, `FriendID`, `Users_UID`) VALUES
(1, 1, 2),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `hospitalstats`
--

CREATE TABLE `hospitalstats` (
  `Lvl` int(11) NOT NULL,
  `HealingTime` time NOT NULL COMMENT 'egy gyógyítási ciklus hossza',
  `MaxHealingCount` int(11) NOT NULL COMMENT 'hány elesettet tud egyszerre megpróbálni meggyógyítani',
  `Effectivity` int(11) NOT NULL COMMENT 'a gyógyítás hatékonysága (pl ha 60, akkor az elesettek 60%át sikerül meggyógyítani, a maradék 40 meghal)',
  `MaxHealedUnits` int(11) NOT NULL COMMENT 'a maximum meggyógyított katonák férőhelye a kórházban'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `maxbuildinglevels`
--

CREATE TABLE `maxbuildinglevels` (
  `MaxBarracksLvl` int(11) NOT NULL,
  `MaxDiplomacyLvl` int(11) NOT NULL,
  `MaxHospitalLvl` int(11) NOT NULL,
  `MaxWarehouseLvl` int(11) NOT NULL,
  `MaxResearchLvl` int(11) NOT NULL,
  `MaxMarketLvl` int(11) NOT NULL,
  `MaxChurchLvl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `researchstats`
--

CREATE TABLE `researchstats` (
  `Lvl` int(11) NOT NULL,
  `SciencePM` int(11) NOT NULL COMMENT 'gyűjtött tudás percenként',
  `MaxScience` int(11) NOT NULL COMMENT 'maximálisan szedhető tudás',
  `ResearchableUnits` varchar(512) COLLATE utf8_hungarian_ci NOT NULL COMMENT 'a kikutatható egységek nevei (;)',
  `ResearchCostPerunit` varchar(512) COLLATE utf8_hungarian_ci NOT NULL COMMENT 'a kikutatható egységek mennyi tudásba kerülnek (;)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `towns`
--

CREATE TABLE `towns` (
  `TownID` int(11) NOT NULL,
  `TownName` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `HappinessValue` int(11) NOT NULL DEFAULT 100,
  `Wood` int(11) NOT NULL DEFAULT 100,
  `Stone` int(11) NOT NULL DEFAULT 100,
  `Metal` int(11) NOT NULL DEFAULT 50,
  `Gold` int(11) NOT NULL DEFAULT 50,
  `CampaignLvl` int(11) NOT NULL DEFAULT 0,
  `XCords` int(11) NOT NULL COMMENT 'a város X koordinátája a világtérkép síkján',
  `YCords` int(11) NOT NULL COMMENT 'a város Y koordinátája a világtérkép síkján',
  `Users_UID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `towns`
--

INSERT INTO `towns` (`TownID`, `TownName`, `HappinessValue`, `Wood`, `Stone`, `Metal`, `Gold`, `CampaignLvl`, `XCords`, `YCords`, `Users_UID`) VALUES
(1, 'Blasiférfiakatszeret', 15, 100, 200, 300, 450, 5, 45, 14, 1),
(2, 'Wauboi1', 100, 200, 300, 150, 50, 1, 255, 255, 2),
(3, 'Wauboi2', 50, 400, 600, 300, 100, 2, 150, 134, 2),
(47, 'Wauboi3', 100, 100, 100, 50, 50, 0, -90, 4, 2),
(48, 'Sünök Büszke Városa', 100, 100, 100, 50, 50, 0, -140, -23, 3),
(49, 'Vöröspanda-negyed', 100, 100, 100, 50, 50, 0, -132, 16, 3),
(50, 'Józsi városa', 100, 100, 100, 50, 50, 0, -5, 7, 33),
(51, 'Józsi második városa', 100, 100, 100, 50, 50, 0, -20, 2, 33),
(52, 'Józsi városa #3', 100, 100, 100, 50, 50, 0, -116, 100, 33);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `unitstats`
--

CREATE TABLE `unitstats` (
  `UnitName` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `UnitSize` int(11) NOT NULL,
  `AttackValue` int(11) NOT NULL,
  `DefenseValue` int(11) NOT NULL,
  `MobilityValue` int(11) NOT NULL,
  `TrainingTime` time NOT NULL COMMENT 'A képzés ideje',
  `TrainingCostGold` int(11) NOT NULL COMMENT 'Aranyköltség a képzéshez',
  `TrainingCostFallen` int(11) NOT NULL COMMENT 'A meggyógyított katonákból mennyi kell egy ilyen egység létrehozásához.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `UID` int(11) NOT NULL,
  `Username` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `EmailAddress` varchar(256) COLLATE utf8_hungarian_ci NOT NULL,
  `PwdHash` longtext COLLATE utf8_hungarian_ci NOT NULL COMMENT 'a felhasználó által beírt jelszó sha-512-es titkosítással tárolva',
  `PwdSalt` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `LastLoginDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`UID`, `Username`, `EmailAddress`, `PwdHash`, `PwdSalt`, `LastLoginDate`) VALUES
(1, 'admin', 'blasek.balazs@gmail.com', 'f6f809cb210d98022cd466631bf95190b965b9f7885bb48bf1f716a89cba49583b0ee50e29b3d741e8797a0d1035dc0889356385de903faddd22a8fcdca50fbb', 'xbSVinazxDnPAqNco0qe', '2022-10-22 14:17:41'),
(2, 'admin2', 'venteralex1@gmail.com', 'c6d8d9bb045f9da8d3e0f73356c8e6a31990bae59022216642f4d645325c6a7ad54a90312e503ce4ec8e7b974a1f337afb9f70af0db153887f7f93acdbf0be9e', 't2V7ZtEY8hWYeDYwRiJA', '2022-10-22 14:37:03'),
(3, 'admin3', 'laura.luksa03@gmail.com', 'fc61a1a372095cadfd3ac9d96e63c07d03a6dfddf0a22040524a88d478e860f24f1927e458b736e135d94ce4982adbdce4ff94f3c327c7047697984549379244', 'eVhEHxtt6Ygi9h649z3n', '2022-10-22 14:37:54'),
(29, 'Kiskuki', 'davidkis@anyad.hu', '4168dcb1ac123485e9cd3fc1e13e93cb974617288d4ead4a18b265b566f0b8977e3f4579f47b6463cab48dae852d56baf1689d0eb9df99961e7ee0794644d067', 'evQBQhUDT5aB3v4FcJmW', '2022-11-12 20:22:58'),
(30, 'Geriszerelme', 'szeretemagerit@gmail.com', 'ba4491fa9427d794a0285afb96996ee104c02a9e704111d3ded510a7c449ddc9c4b12552c9b21f02ff643c6f74542bd5c03b5f91f2cc1ee07884e92935697e67', 'P1di4zWtXiIJxcZtkCWS', '2022-11-13 21:15:20'),
(31, 'Mikulás-a-szád-széle', 'sajtoskifli45@gmail.com', '858afc6a98c070a27c58d4149c70220854adb577bb4e02f049818ddce10d80516db503ed49cc07e21066261f9cefc000d9912e4dff30643c467d3502d0d8e5db', 'Rz3aPj42AhduHR0Re5zT', '2022-11-13 21:15:45'),
(32, 'nagykuki', 's@g.v', 'b86ad18055bd4ef323832b28995b3ab27bfbdd1d25abe256a8c2da596f98bb9db63ead5106b90dc0857f4280e34005ec104bb7b8ed710387704b86146ca5f587', 'QYeL1zzxSWrl5IukvnE7', '2022-11-13 21:18:53'),
(33, 'TesztJozsef', 'tesztjozsi@gmail.com', '693fed1f95492e00b26a61bd2d9e8c12f671de3c3077dfb04c7497160a909963a894368e3758770c17f8d6aae0ce2ba9876df16c7f282ce21cd8976a65466240', 'qbwNy3zGHP9UiWNEaSXG', '2022-11-18 11:28:49'),
(34, 'User1_', 'user@gmail.com', 'ecf318ab1c83416ebbd0a2e6508906ef28d62d363f2e504aff1b7f9ea2e3308b118d2bb04612e0a678be95702991bbafac15bd8577231017aa87f4b489f49ed4', 'inwZnzInHzvJ0sZGr4Ts', '2022-12-06 21:51:06'),
(35, 'Ádám__', 'adam@gmail.com', '2799fd02af5d9591be1ce18a5ae3d23cbb3b7aab45678f8b903a0ac8925baeac669fefd97d99b54baf22bdd7c5a21ed542545da14fd135dc5c62d22051911c43', 'OYoFRi6MdVJu2X7B4nNh', '2022-12-06 21:52:42'),
(36, 'harcosszabi', 'harcosszabi@gmail.com', 'fe29761629f5dd138febf79f77c10f1c40b919850a3fbf62968cac6e536424ec0766232c69315065a236709b4c2f93da2bb3f8d4cbe11decae3b39800ee1a7da', '5RJJyJH7Uo6Ut0Fdzidh', '2022-12-07 10:11:40');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `warehousestats`
--

CREATE TABLE `warehousestats` (
  `Lvl` int(11) NOT NULL,
  `MaxBrigadeCount` int(11) NOT NULL COMMENT 'a maximálisan felbérelhető nyersanyaggyűjtő brigádok száma',
  `TrainingCostWood` int(11) NOT NULL COMMENT 'a külön állomásokhoz mennyibe kerül egy brigádot felbérelni',
  `TrainingCostStone` int(11) NOT NULL COMMENT 'a külön állomásokhoz mennyibe kerül egy brigádot felbérelni',
  `TrainingCostMetal` int(11) NOT NULL COMMENT 'a külön állomásokhoz mennyibe kerül egy brigádot felbérelni',
  `TrainingCostGold` int(11) NOT NULL COMMENT 'a külön állomásokhoz mennyibe kerül egy brigádot felbérelni',
  `WoodCollectionPM` float NOT NULL COMMENT 'brigádok gyűjtési sebessége a nyersanyagból',
  `StoneCollectionPM` float NOT NULL COMMENT 'brigádok gyűjtési sebessége a nyersanyagból',
  `MetalCollectionPM` float NOT NULL COMMENT 'brigádok gyűjtési sebessége a nyersanyagból',
  `GoldCollectionPM` float NOT NULL COMMENT 'brigádok gyűjtési sebessége a nyersanyagból'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `barrackstats`
--
ALTER TABLE `barrackstats`
  ADD PRIMARY KEY (`Lvl`);

--
-- A tábla indexei `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`BuildingID`),
  ADD KEY `FK_buildings_Towns_TownID` (`Towns_TownID`);

--
-- A tábla indexei `friendlist`
--
ALTER TABLE `friendlist`
  ADD PRIMARY KEY (`RelationID`),
  ADD KEY `FK_friendlist_Users_UID` (`Users_UID`);

--
-- A tábla indexei `towns`
--
ALTER TABLE `towns`
  ADD PRIMARY KEY (`TownID`),
  ADD UNIQUE KEY `TownID` (`TownID`),
  ADD KEY `FK_towns_Users_UID` (`Users_UID`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `EmailAddress` (`EmailAddress`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `barrackstats`
--
ALTER TABLE `barrackstats`
  MODIFY `Lvl` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `buildings`
--
ALTER TABLE `buildings`
  MODIFY `BuildingID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'épület azonosító', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `friendlist`
--
ALTER TABLE `friendlist`
  MODIFY `RelationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `towns`
--
ALTER TABLE `towns`
  MODIFY `TownID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `buildings`
--
ALTER TABLE `buildings`
  ADD CONSTRAINT `FK_buildings_Towns_TownID` FOREIGN KEY (`Towns_TownID`) REFERENCES `towns` (`TownID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Megkötések a táblához `friendlist`
--
ALTER TABLE `friendlist`
  ADD CONSTRAINT `FK_friendlist_Users_UID` FOREIGN KEY (`Users_UID`) REFERENCES `users` (`UID`) ON DELETE NO ACTION;

--
-- Megkötések a táblához `towns`
--
ALTER TABLE `towns`
  ADD CONSTRAINT `FK_towns_Users_UID` FOREIGN KEY (`Users_UID`) REFERENCES `users` (`UID`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
