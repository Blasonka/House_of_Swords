-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 28, 2023 at 11:50 AM
-- Server version: 10.3.32-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `houseofswords`
--

-- --------------------------------------------------------

--
-- Table structure for table `bugreports`
--

CREATE TABLE `bugreports` (
  `Id` bigint(20) UNSIGNED NOT NULL,
  `Text` longtext NOT NULL,
  `EmailAddress` varchar(100) DEFAULT NULL,
  `IsSolved` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `Date` date NOT NULL DEFAULT '2023-03-03'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bugreports`
--

INSERT INTO `bugreports` (`Id`, `Text`, `EmailAddress`, `IsSolved`, `Date`) VALUES
(6, 'Adminisztrátori oldalon a folyamatban státusz telefonon kilóg', 'laura.luksa03@gmail.com', 2, '2023-03-03'),
(7, 'Weboldalas bejelentkezés után a kilépésnél gombnak animáció kell', 'blasek.balazs@gmail.com', 2, '2023-03-03'),
(8, 'Profilkép frissítésnél cache törlése', 'anonymus', 2, '2023-03-03'),
(9, 'A főoldalon lévő 3 kártya elkészítése', 'venteralex1@gmail.com', 1, '2023-03-03'),
(10, '\"A játékról\" oldal elkészítése', 'venteralex1@gmail.com', 2, '2023-03-03'),
(11, 'Főoldal kártya formázás: btn-secondary, bg-dark, text-light', 'venteralex1@gmail.com', 2, '2023-03-03'),
(12, 'Unity-s töltőképernyő fix', 'venteralex1@gmail.com', 2, '2023-03-03'),
(13, 'Hetente törölni azokat a felhasználókat, akik nem erősítették meg az email-címüket', 'venteralex1@gmail.com', 0, '2023-03-03'),
(14, 'Adminisztrátori oldalon a hibákat szűrni sorrendben: először a folyamatban lévők, utána a megoldatlanok, utána a megoldottak', 'venteralex1@gmail.com', 2, '2023-03-03'),
(15, 'A bugreportra kell egy timeout, hogy ne lehessen spamelni', 'venteralex1@gmail.com', 1, '2023-03-03'),
(16, 'Az email verification-re kell egy timeout, hogy ne lehessen spamelni', 'venteralex1@gmail.com', 1, '2023-03-03'),
(17, 'Admin oldalon a bugreportolásnál ne ugorjon a tetejére az oldal egy hiba státuszváltásakor', 'venteralex1@gmail.com', 2, '2023-03-03'),
(18, 'Jelszó változtatásnál kéne email', 'venteralex1@gmail.com', 2, '2023-03-03'),
(19, 'Levelező rendszer SPF fix', 'venteralex1@gmail.com', 2, '2023-03-03'),
(20, 'Jelszó validálás hibás: 8 karakter, min. 1 szám és speciális karakter', 'venteralex1@gmail.com', 1, '2023-03-03'),
(21, 'Warehouse kártyák javítása', 'venteralex1@gmail.com', 1, '2023-03-03'),
(22, 'In-game zene hangerő állító csúszka hiányzik', 'venteralex1@gmail.com', 2, '2023-03-03'),
(23, 'Beállítások menüben kamera-érzékenység állító csúszka kell', 'venteralex1@gmail.com', 1, '2023-03-03'),
(24, 'Menü panel feletti csík eltűntetése', 'venteralex1@gmail.com', 2, '2023-03-03'),
(25, 'Happiness ikont kéne szerezni', 'venteralex1@gmail.com', 2, '2023-03-03'),
(26, 'Telós nézet megoperálása', 'venteralex1@gmail.com', 1, '2023-03-03'),
(27, 'Templom, piac, kutatóintézetben leírás kitöltése', 'venteralex1@gmail.com', 1, '2023-03-03'),
(28, 'Ne lehessen negatív db katonát toborozni', 'venteralex1@gmail.com', 2, '2023-03-03'),
(29, 'Test inputok kikapcsolása', 'venteralex1@gmail.com', 1, '2023-03-03'),
(30, 'Térkép megoldása', 'venteralex1@gmail.com', 2, '2023-03-03'),
(31, 'Böngészős keresésnél az oldal képe ne a számítógép legyen', 'venteralex1@gmail.com', 1, '2023-03-03'),
(32, 'Fejlesztőcsapat oldal kétséges reszponzivitásának megoldása', 'venteralex1@gmail.com', 1, '2023-03-03'),
(33, 'Szerver által küldött email-ek megformázása', 'anonymus', 1, '2023-03-03'),
(34, 'Research épületben a \'max\' szó kiírása, ha tele a tudás (jelenleg 0:0-t ír ki)', 'venteralex1@gmail.com', 2, '2023-03-03'),
(35, 'Researchben megtermelt tudás kiírása', 'venteralex1@gmail.com', 2, '2023-03-03'),
(36, 'Research épületben fejleszthető unitok (?)', 'venteralex1@gmail.com', 0, '2023-03-03'),
(37, 'Resarchben a begyűjtés gomb kikapcsolása, ha még 1-nél kevesebb tudás termelődött', 'venteralex1@gmail.com', 2, '2023-03-03'),
(38, 'Bug report oldalon feltűntetni, hogy ha be van jelentkezve a user, akkor el lesz mentve az email címe (és lehet kapni fog emailt a bug státuszának változáskor)', 'venteralex1@gmail.com', 2, '2023-03-03'),
(39, 'Logó berakása a játékba bejelentkezéskor', 'venteralex1@gmail.com', 2, '2023-03-03'),
(40, 'Adatbázisban a unit neveket magyarosítani kell', 'laura.luksa03@gmail.com', 2, '2023-03-03'),
(42, 'regisztrációnál és bejelentkezésnél autofocust rakni a legelső mezőre', 'venteralex1@gmail.com', 1, '2023-03-03'),
(51, 'Asztali alkalmazásból csak alt+f4el lehet kilépni', 'mikemarcell9@gmail.com', 1, '2023-03-18');

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE `buildings` (
  `BuildingID` bigint(20) UNSIGNED NOT NULL,
  `Towns_TownID` bigint(20) UNSIGNED NOT NULL,
  `BuildingType` varchar(20) NOT NULL,
  `BuildingLvl` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `LastTrainingDate` datetime DEFAULT NULL,
  `TrainedUnitID` int(11) DEFAULT NULL,
  `TrainedAmount` int(11) DEFAULT NULL,
  `currentScience` int(10) UNSIGNED DEFAULT NULL,
  `storedScience` int(10) UNSIGNED DEFAULT NULL,
  `lastMassDate` datetime DEFAULT NULL,
  `BrigadeInWood` int(10) UNSIGNED DEFAULT NULL,
  `BrigadeInStone` int(10) UNSIGNED DEFAULT NULL,
  `BrigadeInMetal` int(10) UNSIGNED DEFAULT NULL,
  `BrigadeInGold` int(10) UNSIGNED DEFAULT NULL,
  `BrigadeInWarehouse` int(10) UNSIGNED DEFAULT NULL,
  `lastCureDate` datetime DEFAULT NULL,
  `currentCure` int(10) UNSIGNED DEFAULT NULL,
  `injuredUnits` int(10) UNSIGNED DEFAULT NULL,
  `healedUnits` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`BuildingID`, `Towns_TownID`, `BuildingType`, `BuildingLvl`, `LastTrainingDate`, `TrainedUnitID`, `TrainedAmount`, `currentScience`, `storedScience`, `lastMassDate`, `BrigadeInWood`, `BrigadeInStone`, `BrigadeInMetal`, `BrigadeInGold`, `BrigadeInWarehouse`, `lastCureDate`, `currentCure`, `injuredUnits`, `healedUnits`) VALUES
(1, 1, 'Barrack', 1, '2023-04-26 10:07:35', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(2, 1, 'Church', 1, NULL, NULL, NULL, NULL, NULL, '2023-03-20 08:24:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, 'Diplomacy', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, 'Infirmary', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-16 21:11:48', 0, 7, 3),
(5, 1, 'Market', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, 'Research', 1, NULL, NULL, NULL, 30, 404, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 1, 'Warehouse', 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL),
(8, 2, 'Barrack', 1, '2023-03-08 12:11:06', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 2, 'Church', 1, NULL, NULL, NULL, NULL, NULL, '2023-03-09 11:55:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 2, 'Diplomacy', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 2, 'Infirmary', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-09 11:45:43', 8, 0, 4),
(12, 2, 'Market', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 2, 'Research', 1, NULL, NULL, NULL, 30, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 2, 'Warehouse', 1, NULL, NULL, NULL, NULL, NULL, NULL, 2, 2, 0, 0, 0, NULL, NULL, NULL, NULL),
(15, 5, 'Barrack', 1, '2023-03-09 09:30:58', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 5, 'Church', 1, NULL, NULL, NULL, NULL, NULL, '2023-03-20 08:23:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 5, 'Research', 1, NULL, NULL, NULL, 30, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 5, 'Warehouse', 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL),
(19, 5, 'Infirmary', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-09 15:16:36', 0, 0, 2),
(20, 5, 'Diplomacy', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 5, 'Market', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 6, 'Barrack', 1, '2023-03-09 21:32:19', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 6, 'Church', 1, NULL, NULL, NULL, NULL, NULL, '2023-03-11 21:48:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 6, 'Research', 1, NULL, NULL, NULL, 30, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 6, 'Warehouse', 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 4, NULL, NULL, NULL, NULL),
(26, 6, 'Infirmary', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2000-01-01 00:00:00', 0, 0, 0),
(27, 6, 'Diplomacy', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 6, 'Market', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 11, 'Barrack', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 11, 'Church', 1, NULL, NULL, NULL, NULL, NULL, '2000-01-01 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 11, 'Research', 1, NULL, NULL, NULL, 30, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 11, 'Warehouse', 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, 2, NULL, NULL, NULL, NULL),
(33, 11, 'Infirmary', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2000-01-01 00:00:00', 0, 0, 0),
(34, 11, 'Diplomacy', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 11, 'Market', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 12, 'Barrack', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 12, 'Church', 1, NULL, NULL, NULL, NULL, NULL, '2023-03-23 21:38:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 12, 'Research', 1, NULL, NULL, NULL, 30, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 12, 'Warehouse', 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 4, NULL, NULL, NULL, NULL),
(40, 12, 'Infirmary', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2000-01-01 00:00:00', 0, 0, 0),
(41, 12, 'Diplomacy', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 12, 'Market', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 13, 'Barrack', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 13, 'Church', 1, NULL, NULL, NULL, NULL, NULL, '2023-03-27 01:12:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 13, 'Research', 1, NULL, NULL, NULL, 30, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 13, 'Warehouse', 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 4, NULL, NULL, NULL, NULL),
(47, 13, 'Infirmary', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2000-01-01 00:00:00', 0, 0, 0),
(48, 13, 'Diplomacy', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 13, 'Market', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 14, 'Barrack', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 14, 'Church', 1, NULL, NULL, NULL, NULL, NULL, '2000-01-01 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 14, 'Research', 1, NULL, NULL, NULL, 30, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 14, 'Warehouse', 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 4, NULL, NULL, NULL, NULL),
(54, 14, 'Infirmary', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2000-01-01 00:00:00', 0, 0, 0),
(55, 14, 'Diplomacy', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 14, 'Market', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `friendlist`
--

CREATE TABLE `friendlist` (
  `RelationID` bigint(20) UNSIGNED NOT NULL,
  `Users_UID` bigint(20) UNSIGNED NOT NULL,
  `FriendID` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friendlist`
--

INSERT INTO `friendlist` (`RelationID`, `Users_UID`, `FriendID`) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `levelstats_barrack`
--

CREATE TABLE `levelstats_barrack` (
  `Lvl` bigint(20) UNSIGNED NOT NULL,
  `MaxUnitCount` int(10) UNSIGNED NOT NULL,
  `MaxTrainingAmount` int(10) UNSIGNED NOT NULL,
  `MaxAttackRange` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `levelstats_barrack`
--

INSERT INTO `levelstats_barrack` (`Lvl`, `MaxUnitCount`, `MaxTrainingAmount`, `MaxAttackRange`) VALUES
(1, 10, 5, 50),
(2, 20, 8, 100),
(3, 40, 10, 150);

-- --------------------------------------------------------

--
-- Table structure for table `levelstats_church`
--

CREATE TABLE `levelstats_church` (
  `Lvl` bigint(20) UNSIGNED NOT NULL,
  `MassLength` time NOT NULL,
  `HappinessBoost` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `levelstats_church`
--

INSERT INTO `levelstats_church` (`Lvl`, `MassLength`, `HappinessBoost`) VALUES
(1, '00:10:00', 2),
(2, '00:20:00', 5),
(3, '00:30:00', 10);

-- --------------------------------------------------------

--
-- Table structure for table `levelstats_diplomacy`
--

CREATE TABLE `levelstats_diplomacy` (
  `Lvl` bigint(20) UNSIGNED NOT NULL,
  `MaxAllyCount` int(10) UNSIGNED NOT NULL,
  `MaxAllyRange` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `levelstats_diplomacy`
--

INSERT INTO `levelstats_diplomacy` (`Lvl`, `MaxAllyCount`, `MaxAllyRange`) VALUES
(1, 0, 0),
(2, 1, 50),
(3, 2, 100);

-- --------------------------------------------------------

--
-- Table structure for table `levelstats_infirmary`
--

CREATE TABLE `levelstats_infirmary` (
  `Lvl` bigint(20) UNSIGNED NOT NULL,
  `HealingTime` time NOT NULL,
  `Effectivity` int(10) UNSIGNED NOT NULL,
  `MaxInjuredUnits` int(10) UNSIGNED NOT NULL,
  `MaxHealedUnits` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `levelstats_infirmary`
--

INSERT INTO `levelstats_infirmary` (`Lvl`, `HealingTime`, `Effectivity`, `MaxInjuredUnits`, `MaxHealedUnits`) VALUES
(1, '06:00:00', 25, 10, 10),
(2, '05:30:00', 25, 15, 25),
(3, '05:00:00', 33, 15, 25);

-- --------------------------------------------------------

--
-- Table structure for table `levelstats_market`
--

CREATE TABLE `levelstats_market` (
  `Lvl` bigint(20) UNSIGNED NOT NULL,
  `MaxTaxPercentage` int(11) NOT NULL,
  `HappinessModifierPerPercent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `levelstats_market`
--

INSERT INTO `levelstats_market` (`Lvl`, `MaxTaxPercentage`, `HappinessModifierPerPercent`) VALUES
(1, 10, 100),
(2, 15, 90),
(3, 20, 85);

-- --------------------------------------------------------

--
-- Table structure for table `levelstats_research`
--

CREATE TABLE `levelstats_research` (
  `Lvl` bigint(20) UNSIGNED NOT NULL,
  `SciencePM` int(10) UNSIGNED NOT NULL,
  `MaxScience` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `levelstats_research`
--

INSERT INTO `levelstats_research` (`Lvl`, `SciencePM`, `MaxScience`) VALUES
(1, 2, 30),
(2, 3, 45),
(3, 10, 150);

-- --------------------------------------------------------

--
-- Table structure for table `levelstats_warehouse`
--

CREATE TABLE `levelstats_warehouse` (
  `Lvl` bigint(20) UNSIGNED NOT NULL,
  `MaxBrigadeCount` int(10) UNSIGNED NOT NULL,
  `MaxCollectedWood` int(10) UNSIGNED NOT NULL,
  `MaxCollectedStone` int(10) UNSIGNED NOT NULL,
  `MaxCollectedMetal` int(10) UNSIGNED NOT NULL,
  `MaxCollectedGold` int(10) UNSIGNED NOT NULL,
  `TrainingCostWood` int(10) UNSIGNED NOT NULL,
  `TrainingCostStone` int(10) UNSIGNED NOT NULL,
  `TrainingCostMetal` int(10) UNSIGNED NOT NULL,
  `TrainingCostGold` int(10) UNSIGNED NOT NULL,
  `WoodCollectionPM` double(8,2) UNSIGNED NOT NULL,
  `StoneCollectionPM` double(8,2) UNSIGNED NOT NULL,
  `MetalCollectionPM` double(8,2) UNSIGNED NOT NULL,
  `GoldCollectionPM` double(8,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `levelstats_warehouse`
--

INSERT INTO `levelstats_warehouse` (`Lvl`, `MaxBrigadeCount`, `MaxCollectedWood`, `MaxCollectedStone`, `MaxCollectedMetal`, `MaxCollectedGold`, `TrainingCostWood`, `TrainingCostStone`, `TrainingCostMetal`, `TrainingCostGold`, `WoodCollectionPM`, `StoneCollectionPM`, `MetalCollectionPM`, `GoldCollectionPM`) VALUES
(1, 4, 1000, 1000, 400, 100, 10, 10, 3, 1, 3.00, 3.00, 1.00, 0.25),
(2, 6, 1200, 1200, 500, 150, 10, 10, 3, 1, 10.00, 10.00, 3.00, 0.50),
(3, 8, 1500, 1500, 600, 225, 10, 10, 3, 1, 20.00, 15.00, 5.00, 1.00);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(65, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(66, '2022_11_05_113125_create_users_table', 1),
(67, '2023_02_22_225317_create_towns_table', 1),
(68, '2023_02_22_234101_create_buildings_table', 1),
(69, '2023_02_23_002303_create_friendlist_table', 1),
(70, '2023_02_23_073111_create_levelstats_church_table', 1),
(71, '2023_02_23_093951_create_bugreports_table', 1),
(72, '2023_02_24_111048_create_levelstats_infirmary_table', 1),
(73, '2023_02_24_122628_create_levelstats_market_table', 1),
(74, '2023_02_25_025551_create_levelstats_research_table', 1),
(75, '2023_02_25_034720_create_levelstats_diplomacy_table', 1),
(76, '2023_02_25_035552_create_levelstats_warehouse_table', 1),
(77, '2023_02_25_051253_create_sieges_table', 1),
(78, '2023_02_25_053227_create_units_table', 1),
(79, '2023_02_25_055420_create_sieging_units_table', 1),
(80, '2023_02_25_160655_create_levelstats_barrack_table', 1),
(81, '2023_03_02_205846_create_trained_units_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sieges`
--

CREATE TABLE `sieges` (
  `SiegeID` bigint(20) UNSIGNED NOT NULL,
  `AttackerTownID` bigint(20) UNSIGNED NOT NULL,
  `DefenderTownID` bigint(20) UNSIGNED NOT NULL,
  `SiegeTime` datetime NOT NULL,
  `LootPercentage` int(10) UNSIGNED NOT NULL,
  `AttackerWon` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sieges`
--

INSERT INTO `sieges` (`SiegeID`, `AttackerTownID`, `DefenderTownID`, `SiegeTime`, `LootPercentage`, `AttackerWon`) VALUES
(1, 1, 2, '2023-12-31 23:59:59', 30, NULL),
(2, 1, 2, '2023-03-17 21:35:18', 30, 1),
(3, 1, 2, '2023-03-17 21:44:45', 30, 1),
(4, 1, 2, '2023-03-17 21:53:34', 30, 1),
(5, 1, 5, '2023-03-26 17:39:50', 30, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sieging_units`
--

CREATE TABLE `sieging_units` (
  `SiegingUnitID` bigint(20) UNSIGNED NOT NULL,
  `SiegeID` bigint(20) UNSIGNED NOT NULL,
  `UnitID` bigint(20) UNSIGNED NOT NULL,
  `UnitAmount` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sieging_units`
--

INSERT INTO `sieging_units` (`SiegingUnitID`, `SiegeID`, `UnitID`, `UnitAmount`) VALUES
(1, 1, 1, 10),
(2, 1, 3, 3),
(3, 2, 1, 5),
(4, 2, 2, 2),
(5, 2, 3, 1),
(6, 3, 1, 5),
(7, 3, 2, 3),
(8, 3, 3, 1),
(9, 4, 1, 1),
(10, 4, 2, 1),
(11, 4, 3, 0),
(12, 5, 1, 2),
(13, 5, 2, 0),
(14, 5, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `towns`
--

CREATE TABLE `towns` (
  `TownID` bigint(20) UNSIGNED NOT NULL,
  `Users_UID` bigint(20) UNSIGNED NOT NULL,
  `TownName` varchar(20) NOT NULL,
  `HappinessValue` int(10) UNSIGNED NOT NULL DEFAULT 100,
  `Wood` double UNSIGNED NOT NULL DEFAULT 100,
  `Stone` double UNSIGNED NOT NULL DEFAULT 100,
  `Metal` double UNSIGNED NOT NULL DEFAULT 50,
  `Gold` double UNSIGNED NOT NULL DEFAULT 25,
  `CampaignLvl` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `XCords` int(11) NOT NULL,
  `YCords` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `towns`
--

INSERT INTO `towns` (`TownID`, `Users_UID`, `TownName`, `HappinessValue`, `Wood`, `Stone`, `Metal`, `Gold`, `CampaignLvl`, `XCords`, `YCords`) VALUES
(1, 1, 'Blasi városa', 120, 1000, 1000, 400, 100, 0, -945, -94),
(2, 2, 'Alex városa', 100, 1000, 1000, 16, 70, 0, -713, -923),
(3, 6, 'Tesztelo123varos', 100, 100, 100, 50, 25, 0, -154, 163),
(4, 6, 'asdfjoj', 100, 100, 100, 50, 25, 0, 167, 147),
(5, 3, 'Sünök büszke városa', 106, 100, 100, 50, 25, 0, 353, -711),
(6, 55, 'faszland', 102, 100, 100, 50, 25, 0, 882, 195),
(9, 5, 'TopLeftTown', 100, 100, 100, 50, 25, 0, -1000, 1000),
(10, 5, 'BottomRightTown', 100, 100, 100, 50, 25, 0, 1000, -1000),
(11, 56, 'Ádosz városa', 100, 100, 100, 50, 25, 0, -908, 363),
(12, 58, 'Demencia', 102, 100, 100, 50, 25, 0, -669, 127),
(13, 59, 'Mordor', 102, 100, 100, 50, 25, 0, 865, -284),
(14, 60, '13141414', 100, 100, 100, 50, 25, 0, 76, 333);

-- --------------------------------------------------------

--
-- Table structure for table `trained_units`
--

CREATE TABLE `trained_units` (
  `TrainingID` bigint(20) UNSIGNED NOT NULL,
  `TownID` bigint(20) UNSIGNED NOT NULL,
  `UnitID` bigint(20) UNSIGNED NOT NULL,
  `UnitAmount` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trained_units`
--

INSERT INTO `trained_units` (`TrainingID`, `TownID`, `UnitID`, `UnitAmount`) VALUES
(1, 1, 1, 2),
(2, 1, 2, 16),
(3, 1, 3, 7),
(4, 2, 1, 0),
(5, 2, 2, 0),
(6, 2, 3, 0),
(7, 5, 1, 0),
(8, 6, 1, 0),
(9, 11, 1, 0),
(10, 12, 1, 0),
(11, 13, 1, 0),
(12, 14, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `UnitID` bigint(20) UNSIGNED NOT NULL,
  `UnitName` varchar(30) NOT NULL,
  `UnitSize` int(10) UNSIGNED NOT NULL,
  `AttackValue` int(10) UNSIGNED NOT NULL,
  `DefenseValue` int(10) UNSIGNED NOT NULL,
  `MobilityValue` int(10) UNSIGNED NOT NULL,
  `TrainingTime` time NOT NULL,
  `TrainingCostGold` int(10) UNSIGNED NOT NULL,
  `TrainingCostFallen` int(10) UNSIGNED NOT NULL,
  `ResearchCost` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`UnitID`, `UnitName`, `UnitSize`, `AttackValue`, `DefenseValue`, `MobilityValue`, `TrainingTime`, `TrainingCostGold`, `TrainingCostFallen`, `ResearchCost`) VALUES
(1, 'Kardforgató', 1, 5, 5, 5, '00:03:00', 1, 1, 0),
(2, 'Íjász', 1, 7, 2, 7, '00:05:00', 3, 2, 30),
(3, 'Lovag', 3, 10, 4, 15, '00:15:00', 6, 5, 100);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UID` bigint(20) UNSIGNED NOT NULL,
  `Username` varchar(30) NOT NULL,
  `EmailAddress` varchar(100) NOT NULL,
  `PwdHash` varchar(128) NOT NULL,
  `PwdSalt` varchar(20) NOT NULL,
  `Role` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `IsEmailVerified` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `EmailVerificationToken` varchar(32) DEFAULT NULL,
  `GameSessionToken` varchar(32) DEFAULT NULL,
  `LastOnline` datetime DEFAULT NULL,
  `ProfileImageUrl` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UID`, `Username`, `EmailAddress`, `PwdHash`, `PwdSalt`, `Role`, `IsEmailVerified`, `EmailVerificationToken`, `GameSessionToken`, `LastOnline`, `ProfileImageUrl`) VALUES
(1, 'admin', 'blasek.balazs@gmail.com', 'f6f809cb210d98022cd466631bf95190b965b9f7885bb48bf1f716a89cba49583b0ee50e29b3d741e8797a0d1035dc0889356385de903faddd22a8fcdca50fbb', 'xbSVinazxDnPAqNco0qe', 2, 1, 'Hz7bNB2rjVbIdQZ1b33OhHbIBQcKlFDW', NULL, '2023-04-26 10:08:38', 'admin_profilePicture.gif'),
(2, 'admin2', 'venteralex1@gmail.com', 'dd18d1f18b214791585d057ddefee9a4cb1501a7b4d4e1696572f29844a4d5960e913bb0bf76616765aa28802e2202d5c7d4ed9996470add5b264113158e5642', 'PYyKcBn38tBxQ2G9VI54', 2, 1, NULL, NULL, '2023-03-27 01:17:37', 'admin2_profilePicture.JPG'),
(3, 'admin3', 'laura.luksa03@gmail.com', 'f777b34a7e3c0483b8885d2a95245f633dc2939d642d9af917b0475e9177cd6a1699103b15ab3345ae4b3e328460de710967e7cdc28f17c8752323ecdeb1c8bb', 'QfaKAZmo8HmxyGlE2DZL', 2, 1, NULL, NULL, '2023-03-20 08:26:42', 'admin3_profilePicture.gif'),
(4, 'TesztAdmin', 'tesztadmin@gmail.com', '693fed1f95492e00b26a61bd2d9e8c12f671de3c3077dfb04c7497160a909963a894368e3758770c17f8d6aae0ce2ba9876df16c7f282ce21cd8976a65466240', 'qbwNy3zGHP9UiWNEaSXG', 1, 1, NULL, NULL, NULL, NULL),
(5, 'TesztJozsef', 'tesztjozsi@gmail.com', '693fed1f95492e00b26a61bd2d9e8c12f671de3c3077dfb04c7497160a909963a894368e3758770c17f8d6aae0ce2ba9876df16c7f282ce21cd8976a65466240', 'qbwNy3zGHP9UiWNEaSXG', 0, 1, NULL, NULL, NULL, 'TesztJozsef_profilePicture.png'),
(6, 'Tesztelo123', 'tesztelo123@gmail.com', 'f1c6a575ca4680348878196b65173e9f7d4bb6f535532cc5dd99116d7358cc0900b07fbb9a96a2e921afdbf9a50b1bb0b4f8b59c3dacb08ee468c902ae76c194', 'XmnryVSMhOYO8gJm9lRb', 0, 0, 'kv1yNf7i9z43OykGWths9JxwX4t9kl7s', NULL, NULL, NULL),
(7, 'Kiskuki', 'davidkis@anyad.hu', '4168dcb1ac123485e9cd3fc1e13e93cb974617288d4ead4a18b265b566f0b8977e3f4579f47b6463cab48dae852d56baf1689d0eb9df99961e7ee0794644d067', 'evQBQhUDT5aB3v4FcJmW', 0, 0, NULL, NULL, NULL, NULL),
(8, 'Geriszerelme', 'szeretemagerit@gmail.com', 'ba4491fa9427d794a0285afb96996ee104c02a9e704111d3ded510a7c449ddc9c4b12552c9b21f02ff643c6f74542bd5c03b5f91f2cc1ee07884e92935697e67', 'P1di4zWtXiIJxcZtkCWS', 0, 0, NULL, NULL, NULL, NULL),
(9, 'Mikulás-a-szád-széle', 'sajtoskifli45@gmail.com', '858afc6a98c070a27c58d4149c70220854adb577bb4e02f049818ddce10d80516db503ed49cc07e21066261f9cefc000d9912e4dff30643c467d3502d0d8e5db', 'Rz3aPj42AhduHR0Re5zT', 0, 0, NULL, NULL, NULL, NULL),
(10, 'nagykuki', 's@g.v', 'b86ad18055bd4ef323832b28995b3ab27bfbdd1d25abe256a8c2da596f98bb9db63ead5106b90dc0857f4280e34005ec104bb7b8ed710387704b86146ca5f587', 'QYeL1zzxSWrl5IukvnE7', 0, 0, NULL, NULL, NULL, NULL),
(11, 'User1_', 'user@gmail.com', 'ecf318ab1c83416ebbd0a2e6508906ef28d62d363f2e504aff1b7f9ea2e3308b118d2bb04612e0a678be95702991bbafac15bd8577231017aa87f4b489f49ed4', 'inwZnzInHzvJ0sZGr4Ts', 0, 0, NULL, NULL, NULL, NULL),
(12, 'Ádám__', 'adam@gmail.com', '2799fd02af5d9591be1ce18a5ae3d23cbb3b7aab45678f8b903a0ac8925baeac669fefd97d99b54baf22bdd7c5a21ed542545da14fd135dc5c62d22051911c43', 'OYoFRi6MdVJu2X7B4nNh', 0, 0, NULL, NULL, NULL, NULL),
(13, 'harcosszabi', 'harcosszabi@gmail.com', 'fe29761629f5dd138febf79f77c10f1c40b919850a3fbf62968cac6e536424ec0766232c69315065a236709b4c2f93da2bb3f8d4cbe11decae3b39800ee1a7da', '5RJJyJH7Uo6Ut0Fdzidh', 0, 0, NULL, NULL, NULL, NULL),
(14, 'kicsiakukim4cm', 'szrobert@gmail.com', 'e3a446ca38eeb2f3aaac67a986d63f6573849322fca90ac8c3686b587a5e4ce89137d5721067ba24b90b6bd22aaa5b6b4aa63900aebdbd396d858f7efec87f08', 'StUJJsDqMhlWI9rjkrMB', 0, 0, NULL, NULL, NULL, NULL),
(15, 'nagyakukim25m', 'szrobert1@gmail.com', '45a953c6a68b00394be30cc9bb00c99494e57fdfaadd683469c4014615cb71c0e90c44c3a0e69794eb43148a36c45087318a386062dd0e4b792d6fe9899aced0', 'AbYovyJadqeyFKKJKmUd', 0, 0, NULL, NULL, NULL, NULL),
(16, 'EmailCimTeszt', 'venter.alex@students.jedlik.eu', '334cbef66a914ddd13ff35d1e431deb3cc257c2d1f4036bb95da0c6188572707ba9152c613be7a2610e02b9fe1018f3d558261b5a7d66a80d702e24e7c145351', 'aktTdrh4PuChqCEzeJ59', 0, 1, NULL, NULL, NULL, NULL),
(17, 'Blasek', 'blasek.balazs@students.jedlik.eu', '0c7215d72987866cc1e67b1a4ed028c2d36dfdcd07da08406783f26af901d2392005a11d431b11eaf18aa4599fc3f32a647b0923fe230286d10658fff54c352a', 'kwvjbFma6yGnmU2JuyKI', 0, 1, NULL, NULL, NULL, NULL),
(18, 'Flashy', 'mr.norbert.horvath@gmail.com', '2e04ebd3f680190d73888b4a14a589f1cddfe92ccd2414270770ce17003af7a0b3fa41146d56ce2e7f22bd87b16509c09bf15fd9b0e9caa622582b034a0d6e72', 'cHcLR8saIqwvWiKpmykW', 1, 1, NULL, NULL, NULL, NULL),
(19, 'Aszerelmed', 'kuczi.dorina@gmail.com', '4860c5e0bff0cf905a82e99643fe876efdd420195aa5da642fabd75bf948f9bdc5d5e2e05595b9b5795fdb9f41c4ab3ac37f26c42d5b09111ada0585c59d54e3', 'OA603weJpbUd41ZE6LwI', 0, 1, NULL, NULL, NULL, NULL),
(20, 'Dorcziii', 'eros.dorczi@gmail.com', '0e9f2f2b28096a0e1fd26e45fbed2384cea8cbe7e1b4f7f643fa5a6836fd5f5d2afd3b946c2c3a53b8ad54ea471958ab41f84909201e63fb931dd5644bad6b8c', 'shQR8sGTPKpPIOakFR95', 0, 1, NULL, NULL, NULL, NULL),
(21, 'bodamate', 'bodamate0818@gmail.com', '1ef5bc05a3dca21295406eb5fd3563166f56fc8f86bc17a13100fafbd03137096c94a6c382aa07b0e1aaf9539a31c4bc53761f9e4263836cf9e627fd0821d8fc', 'rs232QHP3V7fVYdPIAAB', 0, 1, NULL, NULL, NULL, NULL),
(55, 'arminegygeci', 'kubalazs02@gmail.com', '49bc96df58565e481272db96d020a4f014cfb43ec957a80d383e1b79ce76784aa03fcbd29401f6cb894b9f9e025cf5f056ec71bb892ae072927e3aef5d292002', 'dwFEjuilaj5v7ePvWTAt', 0, 1, NULL, NULL, '2023-03-11 21:50:56', NULL),
(56, 'ádosz123', 'kekesi.adam2003@gmail.com', '1ba5c10b682291737d099303018af1ef0a785c2eecd50eaff88339454beee73e41eaa9d12b111ce45adba384ea9501f5b4cfe590eeae0486ad7b0bde18c621b7', 'c0vL238hWYxYnD2rKkCk', 0, 1, NULL, NULL, '2023-03-19 22:42:54', 'ádosz123_profilePicture.png'),
(57, 'mareesz1', 'mikemarcell9@gmail.com', '4a499d4e718a7048523f3504d7e2cd305fb652a8931545e4bdf00747f18b8cbae1ae5676dfdc31ee771270766ef9d1718265b98168e8da53f26680766d624614', '15V6kSUfDugYIc77czZv', 0, 1, NULL, NULL, NULL, NULL),
(58, 'Dávid19', 'sulyokdavid03@gmail.com', '33d03f4c4c6fee1d196fed53a55086f06c4b56f5f71df407ca9e648d6aef4e084acf610bb021aaa5fefe557012b1b60f888b3a980893cecafbd8e3496d73eaeb', 'Tb96Z58WVPj6qg2qt1fo', 0, 1, NULL, NULL, '2023-03-23 21:40:47', NULL),
(59, 'FamePereo', 'zolikarz1948@gmail.com', 'cc1ec98cdcefcbe62976d144cfc069ba82aee96cd599261ae14c3ffc198452befbc250507eec8e083a79ca2c576ea672deacccfcfb18b91f8aa5a49ad42db493', 'POoy9bb0xrDtq74Jo8gL', 0, 0, 'YWdRX3WBVHppfjJo9knePmHUOlSTktEb', NULL, '2023-03-27 01:14:54', NULL),
(60, 'maresz', 'mike.marcell@students.jedlik.eu', '4907390178d3b234529d4f0a9ccfb57b971d6ee561fc5325bfaf1b9c9e96e7b0842e3650a9d49793daa2a5393c019b8f86881fc89e985c09fbe10ea18be4d41a', 'LpSIT36BhEErKLfWnm7Z', 0, 0, 'bnkIC5ntSvWYMCVFRWR7U86S1FTpbjwL', NULL, '2023-03-29 11:11:29', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bugreports`
--
ALTER TABLE `bugreports`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`BuildingID`),
  ADD KEY `buildings_towns_townid_foreign` (`Towns_TownID`);

--
-- Indexes for table `friendlist`
--
ALTER TABLE `friendlist`
  ADD PRIMARY KEY (`RelationID`),
  ADD KEY `friendlist_users_uid_foreign` (`Users_UID`),
  ADD KEY `friendlist_friendid_foreign` (`FriendID`);

--
-- Indexes for table `levelstats_barrack`
--
ALTER TABLE `levelstats_barrack`
  ADD PRIMARY KEY (`Lvl`);

--
-- Indexes for table `levelstats_church`
--
ALTER TABLE `levelstats_church`
  ADD PRIMARY KEY (`Lvl`);

--
-- Indexes for table `levelstats_diplomacy`
--
ALTER TABLE `levelstats_diplomacy`
  ADD PRIMARY KEY (`Lvl`);

--
-- Indexes for table `levelstats_infirmary`
--
ALTER TABLE `levelstats_infirmary`
  ADD PRIMARY KEY (`Lvl`);

--
-- Indexes for table `levelstats_market`
--
ALTER TABLE `levelstats_market`
  ADD PRIMARY KEY (`Lvl`);

--
-- Indexes for table `levelstats_research`
--
ALTER TABLE `levelstats_research`
  ADD PRIMARY KEY (`Lvl`);

--
-- Indexes for table `levelstats_warehouse`
--
ALTER TABLE `levelstats_warehouse`
  ADD PRIMARY KEY (`Lvl`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sieges`
--
ALTER TABLE `sieges`
  ADD PRIMARY KEY (`SiegeID`),
  ADD KEY `sieges_attackertownid_foreign` (`AttackerTownID`),
  ADD KEY `sieges_defendertownid_foreign` (`DefenderTownID`);

--
-- Indexes for table `sieging_units`
--
ALTER TABLE `sieging_units`
  ADD PRIMARY KEY (`SiegingUnitID`),
  ADD KEY `sieging_units_siegeid_foreign` (`SiegeID`),
  ADD KEY `sieging_units_unitid_foreign` (`UnitID`);

--
-- Indexes for table `towns`
--
ALTER TABLE `towns`
  ADD PRIMARY KEY (`TownID`),
  ADD KEY `towns_users_uid_foreign` (`Users_UID`);

--
-- Indexes for table `trained_units`
--
ALTER TABLE `trained_units`
  ADD PRIMARY KEY (`TrainingID`),
  ADD KEY `trained_units_townid_foreign` (`TownID`),
  ADD KEY `trained_units_unitid_foreign` (`UnitID`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`UnitID`),
  ADD UNIQUE KEY `units_unitname_unique` (`UnitName`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UID`),
  ADD UNIQUE KEY `users_username_unique` (`Username`),
  ADD UNIQUE KEY `users_emailaddress_unique` (`EmailAddress`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bugreports`
--
ALTER TABLE `bugreports`
  MODIFY `Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `buildings`
--
ALTER TABLE `buildings`
  MODIFY `BuildingID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `friendlist`
--
ALTER TABLE `friendlist`
  MODIFY `RelationID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `levelstats_barrack`
--
ALTER TABLE `levelstats_barrack`
  MODIFY `Lvl` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `levelstats_church`
--
ALTER TABLE `levelstats_church`
  MODIFY `Lvl` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `levelstats_diplomacy`
--
ALTER TABLE `levelstats_diplomacy`
  MODIFY `Lvl` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `levelstats_infirmary`
--
ALTER TABLE `levelstats_infirmary`
  MODIFY `Lvl` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `levelstats_market`
--
ALTER TABLE `levelstats_market`
  MODIFY `Lvl` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `levelstats_research`
--
ALTER TABLE `levelstats_research`
  MODIFY `Lvl` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `levelstats_warehouse`
--
ALTER TABLE `levelstats_warehouse`
  MODIFY `Lvl` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sieges`
--
ALTER TABLE `sieges`
  MODIFY `SiegeID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sieging_units`
--
ALTER TABLE `sieging_units`
  MODIFY `SiegingUnitID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `towns`
--
ALTER TABLE `towns`
  MODIFY `TownID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `trained_units`
--
ALTER TABLE `trained_units`
  MODIFY `TrainingID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `UnitID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buildings`
--
ALTER TABLE `buildings`
  ADD CONSTRAINT `buildings_towns_townid_foreign` FOREIGN KEY (`Towns_TownID`) REFERENCES `towns` (`TownID`) ON DELETE CASCADE;

--
-- Constraints for table `friendlist`
--
ALTER TABLE `friendlist`
  ADD CONSTRAINT `friendlist_friendid_foreign` FOREIGN KEY (`FriendID`) REFERENCES `users` (`UID`) ON DELETE CASCADE,
  ADD CONSTRAINT `friendlist_users_uid_foreign` FOREIGN KEY (`Users_UID`) REFERENCES `users` (`UID`) ON DELETE CASCADE;

--
-- Constraints for table `sieges`
--
ALTER TABLE `sieges`
  ADD CONSTRAINT `sieges_attackertownid_foreign` FOREIGN KEY (`AttackerTownID`) REFERENCES `towns` (`TownID`),
  ADD CONSTRAINT `sieges_defendertownid_foreign` FOREIGN KEY (`DefenderTownID`) REFERENCES `towns` (`TownID`);

--
-- Constraints for table `sieging_units`
--
ALTER TABLE `sieging_units`
  ADD CONSTRAINT `sieging_units_siegeid_foreign` FOREIGN KEY (`SiegeID`) REFERENCES `sieges` (`SiegeID`),
  ADD CONSTRAINT `sieging_units_unitid_foreign` FOREIGN KEY (`UnitID`) REFERENCES `units` (`UnitID`);

--
-- Constraints for table `towns`
--
ALTER TABLE `towns`
  ADD CONSTRAINT `towns_users_uid_foreign` FOREIGN KEY (`Users_UID`) REFERENCES `users` (`UID`) ON DELETE CASCADE;

--
-- Constraints for table `trained_units`
--
ALTER TABLE `trained_units`
  ADD CONSTRAINT `trained_units_townid_foreign` FOREIGN KEY (`TownID`) REFERENCES `towns` (`TownID`) ON DELETE CASCADE,
  ADD CONSTRAINT `trained_units_unitid_foreign` FOREIGN KEY (`UnitID`) REFERENCES `units` (`UnitID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
