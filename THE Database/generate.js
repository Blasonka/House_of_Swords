use HouseOfSwords;

// ÖSSZEKAPCSOLÓDÓ TÁBLÁK

db.users.insertMany([
    // FELHASZNÁLÓK ADATAI (bejelentkezéshez, illetve azonosításhoz)
    {
        _id: 1,
        UserName: "admin",
        EmailAddress: "blasek.balazs@gmail.com",
        PwdHash: "f6f809cb210d98022cd466631bf95190b965b9f7885bb48bf1f716a89cba49583b0ee50e29b3d741e8797a0d1035dc0889356385de903faddd22a8fcdca50fbb",
        PwdSalt: "xbSVinazxDnPAqNco0qe",
        LastLoginDate: "2022-10-22 14:17:41"
    },
    {
        _id: 2,
        UserName: "admin2",
        EmailAddress: "venteralex1@gmail.com",
        PwdHash: "c6d8d9bb045f9da8d3e0f73356c8e6a31990bae59022216642f4d645325c6a7ad54a90312e503ce4ec8e7b974a1f337afb9f70af0db153887f7f93acdbf0be9e",
        PwdSalt: "t2V7ZtEY8hWYeDYwRiJA",
        LastLoginDate: "2022-10-22 14:17:41"
    },
    {
        _id: 3,
        UserName: "admin3",
        EmailAddress: "laura.luksa03@gmail.com",
        PwdHash: "fc61a1a372095cadfd3ac9d96e63c07d03a6dfddf0a22040524a88d478e860f24f1927e458b736e135d94ce4982adbdce4ff94f3c327c7047697984549379244",
        PwdSalt: "eVhEHxtt6Ygi9h649z3n",
        LastLoginDate: "2022-10-22 14:17:41"
    }
]);

db.towns.insertMany([
    // A FELHASZNÁLÓK ÁLTAL LÉTREHOZOTT VÁROSOK ÉS ADATAIK
    // Ezekkel a városokkal játszhatnak a felhasználók, itt mentjük
    // a városok nyersanyagait, koordinátáit stb.
    {
        _id: 1,
        users_id: 1,
        TownName: "Blasi varosa",
        HappinessValue: 15,
        Wood: 100,
        Stone: 100,
        Metal: 100,
        Gold: 100,
        CampaignLvl: 5,
        XCords: 45,
        YCords: 14
    },
    {
        _id: 2,
        users_id: 2,
        TownName: "Alex1",
        HappinessValue: 15,
        Wood: 100,
        Stone: 100,
        Metal: 100,
        Gold: 100,
        CampaignLvl: 5,
        XCords: 123,
        YCords: -15
    },
    {
        _id: 3,
        users_id: 2,
        TownName: "Alex2",
        HappinessValue: 15,
        Wood: 100,
        Stone: 100,
        Metal: 100,
        Gold: 100,
        CampaignLvl: 5,
        XCords: 132,
        YCords: 144
    }
]);

db.buildings.insertMany([
    // A VÁROSOKBAN TALÁLHATÓ ÉPÜLETEK
    // Mindegyik városban lehetnek épületek, ezeknek van egy típusa,
    // szintje és paramétereik (például hogy a katonai épületben
    // épp folyik-e toborzás)
    {
        _id: 1,
        town_id: 1,
        BuildingType: "Barracks",
        BuildingLvl: 3,
        Params: {
            TrainingUnits: false,
            // ...
        }
    },
    {
        _id: 2,
        town_id: 1,
        BuildingType: "Warehouse",
        BuildingLvl: 4,
        Params: {
            Builders: 3,
            DivisionOfLabor: [2, 1, 0, 0],
            // ...
        }
    }
]);

db.friendlist.insertMany([
    // TÖBB-A-TÖBBHÖZ BARÁTLISTA
    // Egy kapcsolat felvétele két felhasználó között
    // _id: kapcsolat ID-je
    // users_id: a felhasználó id-je
    // friend_id: a barát id-je
    {
        _id: 1,
        users_id: 2,
        friend_id: 1
    },
    {
        _id: 2,
        users_id: 1,
        friend_id: 2
    }
]);

// KONSTANS TÁBLÁK
// A játék olyan változói, amit csak a játék frissítésével lehetne cserélni,
// de mivel adatbázisban tároljuk, így itt simán ki lehet cserélni
db.barrackstats.insertMany([
    // A katonai épület tulajdonságai szintenként változnak
    // _id: az épület szintje
    // MaxUnitCount: ezen a szinten hány katonai egységet tud tárolni
    // MaxTrainingAmount: ezen a szinten hány katonai egységet tud egyszerre toborozni
    // MatAttackRange: ezen a szinten milyen messze lévő városokat tud támadni a felhasználó
    {
        _id: 1,
        MaxUnitCount: 20,
        MaxTrainingAmount: 10,
        MaxAttackRange: 50
    },
    {
        _id: 2,
        MaxUnitCount: 30,
        MaxTrainingAmount: 12,
        MaxAttackRange: 60
    }
]);

db.warehousestats.insertMany([
    // Nyersanyaggyűjtő épület adatai
    // _id: épület szinje
    // MaxBrigadeCount: a maximálisan felbérelhető gyűjtőosztagok száma (akik gyűjteni fogják a nyersanyagokat
    // TrainingCost(nyersanyag_neve): az egyes nyersanyagokhoz küldeni brigádokat ennyi nyersanyagba kerül
    // (nyersanyag_neve)CollectionPM: percenként hány nyersanyagot tud gyűjteni egy brigád az adott fajtából
    {
        _id: 1,
        MaxBrigadeCount: 2,
        TrainingCostWood: 10,
        TrainingCostStone: 10,
        TrainingCostMetal: 5,
        TrainingCostGold: 1,
        WoodCollectionPM: 10,
        StoneCollectionPM: 10,
        MetalCollectionPM: 1,
        GoldCollectionPM: 1/30
    }
]);
