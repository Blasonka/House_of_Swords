using System;
using System.Collections.Generic;
using UnityEngine;

public class Market
{
    // "ÖRÖKÖLT" VÁLTOZÓK
    public int BuildingID;
    public int Towns_TownID;
    public string BuildingType;
    public int BuildingLvl;

    // AZ ÉPÜLET SZINTJÉTÕL FÜGGÕ VÁLTOZÓK
    public int MaxTax = 5;
    public int HappinesModifierPerTax = -5;

    public async void updateLevelVariables(int newLevel)
    {
        // ...
    }

    // PARAMÉTEREK
    public int taxAmount;

    struct paramsStruct
    {
        public int taxAmount;
    }

    // SZÁMÍTOTT MEZÕK
    public int HappinesModifier => taxAmount * HappinesModifierPerTax;

    // KONSTRUKTOR

    public Market(Building building)
    {
        BuildingID = building.BuildingID;
        Towns_TownID = building.Towns_TownID;
        BuildingType = building.BuildingType;
        BuildingLvl = building.BuildingLvl;


        //paramsStruct marketParams = JsonUtility.FromJson<paramsStruct>(building.Params);
        //taxAmount = marketParams.taxAmount;        
        //taxAmount = building.taxAmount;        

        updateLevelVariables(BuildingLvl);
    }
}
