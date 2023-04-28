using System;
using UnityEngine;

[System.Serializable]
public class Building
{
    public int BuildingID;
    public int Towns_TownID;
    public string BuildingType;
    public int BuildingLvl;

    // RESEARCH PARAMÉTEREK
    public int? currentScience = null;
    public int? storedScience = null;

    // CHURCH PARAMÉTEREK
    public string lastMassDate = null;

    // INFIRMARY PARAMÉTEREK
    public string lastCureDate = null;
    public int? currentCure = null;
    public int? injuredUnits = null;
    public int? healedUnits = null;

    // WAREHOUSE PARAMÉTEREK
    public int? BrigadeInWarehouse = null;
    public int? BrigadeInStone = null;
    public int? BrigadeInWood = null;
    public int? BrigadeInMetal = null;
    public int? BrigadeInGold = null;

    public static object ConvertToType(Building building)
    {
        object convertedBuilding = null;
        Debug.Log("Building:\n" + JsonUtility.ToJson(building));

        switch (building.BuildingType)
        {
            case "Church":
                convertedBuilding = new Church(building);
                break;
            case "Barrack":
                convertedBuilding = new Barrack(building);
                break;
            case "Warehouse":
                convertedBuilding = new Warehouse(building);
                break;
            case "Research":
                convertedBuilding = new Research(building);
                break;
            case "Market":
                convertedBuilding = new Market(building);
                break;
            case "Infirmary":
                convertedBuilding = new Infirmary(building);
                break;
            default:
                convertedBuilding = null;
                break;
        }

        return convertedBuilding;
    }

    public static Building ConvertToBuilding(object building, string buildingType)
    {
        Building convertedBuilding = new Building();

        switch (buildingType)
        {
            case "Research":
                Research researchBuilding = (Research)building;
                convertedBuilding.BuildingID = researchBuilding.BuildingID;
                convertedBuilding.BuildingLvl = researchBuilding.BuildingLvl;
                convertedBuilding.BuildingType = researchBuilding.BuildingType;
                convertedBuilding.Towns_TownID = researchBuilding.Towns_TownID;

                convertedBuilding.currentScience = researchBuilding.currentScience;
                convertedBuilding.storedScience = researchBuilding.storedScience;
                break;
            case "Church":
                // convertedBuilding = new Building();
                break;
            case "Warehouse":
                // convertedBuilding = new Building();
                break;
            default:
                convertedBuilding = null;
                break;
        }

        return convertedBuilding;
    }
}

[System.Serializable]
public class Buildings
{
    public Building[] fetchedBuildings;
}