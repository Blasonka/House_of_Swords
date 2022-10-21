-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2022-10-21 16:41:48.197

-- tables
-- Table: BarrackStats
CREATE TABLE BarrackStats (
    Lvl int NOT NULL,
    MaxUnitCount int NOT NULL COMMENT 'maximum mennyi egységet képezhet a user',
    MaxTrainingAmount int NOT NULL COMMENT 'egyszerre hány egységet képezhet',
    MaxAttackRange int NOT NULL COMMENT 'a térképen milyen messze lévő városokra tud támadni'
);

-- Table: Buildings
CREATE TABLE Buildings (
    BuildingID int NOT NULL COMMENT 'épület azonosító',
    BuildingType varchar(20) NOT NULL COMMENT 'épület típusának megnevezése',
    TownID int NOT NULL COMMENT 'melyik városban van az épület',
    BuildingLvl int NOT NULL COMMENT 'épület szintje',
    Params varchar(512) NOT NULL COMMENT 'épület által használt paraméterek, pontosvesszővel elválasztva',
    Towns_TownID int NOT NULL COMMENT 'a város azonosítója',
    CONSTRAINT Buildings_pk PRIMARY KEY (BuildingID)
);

-- Table: Campaign
CREATE TABLE Campaign (
    LevelNum int NOT NULL,
    Enemies varchar(512) NOT NULL COMMENT 'A szinten legyőzendő ellenségek nevei felsorolva egymás után, pontosvesszővel elválasztva.',
    EnemiesCount varchar(512) NOT NULL COMMENT 'A felsorolt ellenségekből rendre hány darab van, pontosvesszővel elválasztva',
    RewardString varchar(128) NOT NULL COMMENT 'fa;kő;fém;arany'
);

-- Table: ChurchStats
CREATE TABLE ChurchStats (
    Lvl int NOT NULL,
    MassLength time NOT NULL COMMENT 'a mise hosszúsága',
    HappinessBoost int NOT NULL COMMENT 'a mise által adott boldogság mennyisége',
    ProductivityMultiplierString varchar(128) NOT NULL COMMENT 'a boldogság hatása a termelékenységre, összetett karakterlánc: pl. 1-10-0,1;11-20-0,3...
az első szám az alsó határ, a második a felső, a harmadik pedig az a szorzó, amivel a termelékenységet be kell szorozni a Warehouseban, ha a boldogságszint a két határ között van'
);

-- Table: DiplomacyStats
CREATE TABLE DiplomacyStats (
    Lvl int NOT NULL,
    MaxAllyCount int NOT NULL COMMENT 'a maximum szövetségesek száma',
    MaxAllyRange int NOT NULL COMMENT 'a térképen milyen messze lévő városokkal lehet szövetkezni'
);

-- Table: FriendList
CREATE TABLE FriendList (
    RelationID int NOT NULL,
    UID int NOT NULL,
    FriendID int NOT NULL,
    Users_UID int NOT NULL,
    CONSTRAINT FriendList_pk PRIMARY KEY (RelationID)
);

-- Table: HospitalStats
CREATE TABLE HospitalStats (
    Lvl int NOT NULL,
    HealingTime time NOT NULL COMMENT 'egy gyógyítási ciklus hossza',
    MaxHealingCount int NOT NULL COMMENT 'hány elesettet tud egyszerre megpróbálni meggyógyítani',
    Effectivity int NOT NULL COMMENT 'a gyógyítás hatékonysága (pl ha 60, akkor az elesettek 60%át sikerül meggyógyítani, a maradék 40 meghal)',
    MaxHealedUnits int NOT NULL COMMENT 'a maximum meggyógyított katonák férőhelye a kórházban'
);

-- Table: MaxBuildingLevels
CREATE TABLE MaxBuildingLevels (
    MaxBarracksLvl int NOT NULL,
    MaxDiplomacyLvl int NOT NULL,
    MaxHospitalLvl int NOT NULL,
    MaxWarehouseLvl int NOT NULL,
    MaxResearchLvl int NOT NULL,
    MaxMarketLvl int NOT NULL,
    MaxChurchLvl int NOT NULL
);

-- Table: ResearchStats
CREATE TABLE ResearchStats (
    Lvl int NOT NULL,
    SciencePM int NOT NULL COMMENT 'gyűjtött tudás percenként',
    MaxScience int NOT NULL COMMENT 'maximálisan szedhető tudás',
    ResearchableUnits varchar(512) NOT NULL COMMENT 'a kikutatható egységek nevei (;)',
    ResearchCostPerunit varchar(512) NOT NULL COMMENT 'a kikutatható egységek mennyi tudásba kerülnek (;)'
);

-- Table: Towns
CREATE TABLE Towns (
    TownID int NOT NULL COMMENT 'a város azonosítója',
    UID int NOT NULL COMMENT 'a felhasználó azonosítója',
    HappinessValue int NOT NULL,
    Wood int NOT NULL,
    Stone int NOT NULL,
    Metal int NOT NULL,
    Gold int NOT NULL,
    CampaignLvl int NOT NULL,
    Coordinates varchar(20) NOT NULL COMMENT 'a város koordinátája a világtérkép síkján',
    Users_UID int NOT NULL,
    CONSTRAINT Towns_pk PRIMARY KEY (TownID)
);

-- Table: UnitStats
CREATE TABLE UnitStats (
    UnitName varchar(20) NOT NULL,
    UnitSize int NOT NULL,
    AttackValue int NOT NULL,
    DefenseValue int NOT NULL,
    MobilityValue int NOT NULL,
    TrainingTime time NOT NULL COMMENT 'A képzés ideje',
    TrainingCostGold int NOT NULL COMMENT 'Aranyköltség a képzéshez',
    TrainingCostFallen int NOT NULL COMMENT 'A meggyógyított katonákból mennyi kell egy ilyen egység létrehozásához.'
);

-- Table: Users
CREATE TABLE Users (
    UID int NOT NULL,
    Username varchar(20) NOT NULL,
    EmailAddress varchar(256) NOT NULL,
    PwdHash longtext NOT NULL COMMENT 'a felhasználó által beírt jelszó sha-512-es titkosítással tárolva',
    LastLoginDate datetime NOT NULL,
    CONSTRAINT Users_pk PRIMARY KEY (UID)
);

-- Table: WarehouseStats
CREATE TABLE WarehouseStats (
    Lvl int NOT NULL,
    MaxBrigadeCount int NOT NULL COMMENT 'a maximálisan felbérelhető nyersanyaggyűjtő brigádok száma',
    TrainingCostWood int NOT NULL COMMENT 'a külön állomásokhoz mennyibe kerül egy brigádot felbérelni',
    TrainingCostStone int NOT NULL COMMENT 'a külön állomásokhoz mennyibe kerül egy brigádot felbérelni',
    TrainingCostMetal int NOT NULL COMMENT 'a külön állomásokhoz mennyibe kerül egy brigádot felbérelni',
    TrainingCostGold int NOT NULL COMMENT 'a külön állomásokhoz mennyibe kerül egy brigádot felbérelni',
    WoodCollectionPM float(2) NOT NULL COMMENT 'brigádok gyűjtési sebessége a nyersanyagból',
    StoneCollectionPM float(2) NOT NULL COMMENT 'brigádok gyűjtési sebessége a nyersanyagból',
    MetalCollectionPM float(2) NOT NULL COMMENT 'brigádok gyűjtési sebessége a nyersanyagból',
    GoldCollectionPM float(2) NOT NULL COMMENT 'brigádok gyűjtési sebessége a nyersanyagból'
);

-- foreign keys
-- Reference: Buildings_Towns (table: Buildings)
ALTER TABLE Buildings ADD CONSTRAINT Buildings_Towns FOREIGN KEY Buildings_Towns (Towns_TownID)
    REFERENCES Towns (TownID);

-- Reference: FriendList_Users (table: FriendList)
ALTER TABLE FriendList ADD CONSTRAINT FriendList_Users FOREIGN KEY FriendList_Users (Users_UID)
    REFERENCES Users (UID);

-- Reference: Towns_Users (table: Towns)
ALTER TABLE Towns ADD CONSTRAINT Towns_Users FOREIGN KEY Towns_Users (Users_UID)
    REFERENCES Users (UID);

-- End of file.

