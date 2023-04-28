using System;
using System.Collections.Generic;
using UnityEngine;

public class Barrack
{
    // "ÖRÖKÖLT" VÁLTOZÓK
    public int BuildingID;
    public int Towns_TownID;
    public string BuildingType;
    public int BuildingLvl;

    // AZ ÉPÜLET SZINTJÉTÕL FÜGGÕ VÁLTOZÓK
    //public int MaxAllyCount = 3;
    //public int MaxAllyRange = 15;
    //public TimeSpan FightLength = new TimeSpan(14, 0, 0);

    //public async void updateLevelVariables(int newLevel)
    //{
    //    // ...
    //}

    // PARAMÉTEREK
    public DateTime fightStartDate;
    public int enemyTownId;

    struct paramsStruct
    {
        public string fightStartDate;
        public int enemyTownID;
    }

    // SZÁMÍTOTT MEZÕK
    //public TimeSpan fightCooldown => fightStartDate.Add(FightLength).Subtract(DateTime.Now);

    // KONSTRUKTOR
    public Barrack(Building building)
    {
        BuildingID = building.BuildingID;
        Towns_TownID = building.Towns_TownID;
        BuildingType = building.BuildingType;
        BuildingLvl = building.BuildingLvl;

        //paramsStruct barrackParams = JsonUtility.FromJson<paramsStruct>(building.Params);

        //fightStartDate = Convert.ToDateTime(barrackParams.fightStartDate);
        //enemyTownId = barrackParams.enemyTownID;
        // ...

        //updateLevelVariables(BuildingLvl);
    }
}
