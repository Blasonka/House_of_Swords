-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Gép: localhost
-- Létrehozás ideje: 2022. Nov 10. 08:53
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
  `TownID` int(11) NOT NULL COMMENT 'a város azonosítója',
  `HappinessValue` int(11) NOT NULL,
  `Wood` int(11) NOT NULL,
  `Stone` int(11) NOT NULL,
  `Metal` int(11) NOT NULL,
  `Gold` int(11) NOT NULL,
  `CampaignLvl` int(11) NOT NULL,
  `Coordinates` varchar(20) COLLATE utf8_hungarian_ci NOT NULL COMMENT 'a város koordinátája a világtérkép síkján',
  `Users_UID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `towns`
--

INSERT INTO `towns` (`TownID`, `HappinessValue`, `Wood`, `Stone`, `Metal`, `Gold`, `CampaignLvl`, `Coordinates`, `Users_UID`) VALUES
(1, 15, 100, 200, 300, 450, 5, '45;83', 1),
(2, 100, 200, 300, 150, 50, 1, '255;255', 2),
(3, 50, 400, 600, 300, 100, 2, '150;47', 2);

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
  `LastLoginDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`UID`, `Username`, `EmailAddress`, `PwdHash`, `PwdSalt`, `LastLoginDate`) VALUES
(1, 'admin', 'blasek.balazs@gmail.com', 'f6f809cb210d98022cd466631bf95190b965b9f7885bb48bf1f716a89cba49583b0ee50e29b3d741e8797a0d1035dc0889356385de903faddd22a8fcdca50fbb', 'xbSVinazxDnPAqNco0qe', '2022-10-22 14:17:41'),
(2, 'admin2', 'venteralex1@gmail.com', 'c6d8d9bb045f9da8d3e0f73356c8e6a31990bae59022216642f4d645325c6a7ad54a90312e503ce4ec8e7b974a1f337afb9f70af0db153887f7f93acdbf0be9e', 't2V7ZtEY8hWYeDYwRiJA', '2022-10-22 14:37:03'),
(3, 'admin3', 'laura.luksa03@gmail.com', 'fc61a1a372095cadfd3ac9d96e63c07d03a6dfddf0a22040524a88d478e860f24f1927e458b736e135d94ce4982adbdce4ff94f3c327c7047697984549379244', 'eVhEHxtt6Ygi9h649z3n', '2022-10-22 14:37:54');

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
  ADD PRIMARY KEY (`UID`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

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
  MODIFY `TownID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'a város azonosítója', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
