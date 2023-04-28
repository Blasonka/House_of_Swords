using System;
using System.Collections.Generic;
using TMPro;
using UnityEngine;
using UnityEngine.UI;

public class Research
{
    #region PRIVÁT VÁLTOZÓK
    private GameManager _gameManager;
    private Button _claimButton;
    #endregion

    #region ÉPÜLET VÁLTOZÓK
    public int BuildingID;
    public int Towns_TownID;
    public string BuildingType;
    public int BuildingLvl;
    #endregion

    #region PARAMÉTEREK
    public int currentScience;
    public int storedScience;

    #region Deprecated Params
    //public paramsStruct Params;

    //public int currentScience;
    //public int storedScience;
    //public int[] researchedUnits;

    //public struct paramsStruct
    //{
    //    public int currentScience;
    //    public int storedScience;
    //    //public int[] researchedUnits;
    //}
    #endregion

    public List<int> researchedUnits = new List<int>();
    public struct ResearchedUnitStruct
    {
        public int ResearchID;
        public int ResearchBuildingID;
        public int UnitID;
    }
    public struct ManyResearchedUnitsStruct
    {
        public ResearchedUnitStruct[] fetchedUnits;
    }

    private async void getResearchedUnits()
    {
        Debug.Log("Building ID: " + BuildingID);
        //ResearchedUnitStruct[] fetchedUnits = await APIHelper.fetchResearchedUnits(BuildingID);

        //Debug.Log("Fetched units: " + fetchedUnits[0].UnitID);

        //foreach (ResearchedUnitStruct researchedUnit in fetchedUnits)
        //{
        //    researchedUnits.Add(researchedUnit.UnitID);
        //    Debug.Log(researchedUnit.UnitID);
        //}
    }
    #endregion

    #region AZ ÉPÜLET SZINTJÉTÕL FÜGGÕ VÁLTOZÓK
    public researchLevelVariables levelVariables;
    #region Deprecated levelVariables
    //public int SciencePM;
    //public int MaxScience;
    //public List<int> ResearchableUnits = new List<int>();
    #endregion

    public struct researchLevelVariables
    {
        public int Lvl;
        public int SciencePM;
        public int MaxScience;

        #region Deprecated researchLevelVariables
        //public int? NewResearchableUnitId1;
        //public int? NewResearchableUnitId2;
        //public int? NewResearchableUnitId3;
        #endregion
    }
    //public struct manyResearchLevelVariables
    //{
    //    public researchLevelVariables[] fetchedVariables;
    //}

    private async void updateLevelVariables(int newLevel)
    {
        //if (newLevel == BuildingLvl) return;

        researchLevelVariables? fetchedVariables = await APIHelper.fetchResearchStats(BuildingLvl);

        if (fetchedVariables == null)
        {
            Debug.LogError("Research updateLevelVariables failed");
        }

        levelVariables = fetchedVariables.Value;

        #region FALSE LOGIC
        //fetchedVariables = fetchedVariables.Value;

        //SciencePM = fetchedVariables.Value.SciencePM;
        //MaxScience = fetchedVariables.Value.MaxScience;

        // KIKUTATHATÓ EGYSÉGEK KISZÁMOLÁSA
        //researchLevelVariables[] levelsUnderCurrent = await APIHelper.fetchResearchStatsUntil(BuildingLvl);

        //Debug.Log(levelsUnderCurrent[0].SciencePM);

        //foreach (researchLevelVariables levelUnderCurrent in levelsUnderCurrent)
        //{
        //    if (levelUnderCurrent.NewResearchableUnitId1 != null)
        //        ResearchableUnits.Add((int)levelUnderCurrent.NewResearchableUnitId1);
        //    if (levelUnderCurrent.NewResearchableUnitId2 != null)
        //        ResearchableUnits.Add((int)levelUnderCurrent.NewResearchableUnitId2);
        //    if (levelUnderCurrent.NewResearchableUnitId3 != null)
        //        ResearchableUnits.Add((int)levelUnderCurrent.NewResearchableUnitId3);
        //}

        //foreach (int researchedUnit in Params.researchedUnits)
        //{
        //    ResearchableUnits.Remove(researchedUnit);
        //}
        #endregion

        //_gameManager.updateLabels();

        updateUI();

        Debug.Log("Level variables: " + JsonUtility.ToJson(this.levelVariables));
    }
    #endregion

    #region SZÁMÍTOTT MEZÕK
    public TimeSpan timeUntilFull => new TimeSpan(0, (levelVariables.MaxScience - currentScience) / levelVariables.SciencePM, 0);
    #endregion

    #region KONSTRUKTOR
    public Research(Building building)
    {
        _gameManager = GameObject.Find("GameManager").GetComponent<GameManager>();
        _claimButton = GameObject.Find("ClaimButton").GetComponent<Button>();

        //Debug.Log("Problem building's params: " + building.Params);

        Initialize(building);
    }

    private void Initialize(Building building)
    {

        BuildingID = building.BuildingID;
        Towns_TownID = building.Towns_TownID;
        BuildingType = building.BuildingType;
        BuildingLvl = building.BuildingLvl;

        //Params = JsonUtility.FromJson<paramsStruct>(building.Params);

        currentScience = (int)building.currentScience;
        storedScience = (int)building.storedScience;

        //Debug.Log($"Current Science: {currentScience}\nStored Science: {storedScience}");

        if (researchedUnits.Count == 0) getResearchedUnits();

        updateLevelVariables(BuildingLvl);

        Debug.Log("Research building: " + JsonUtility.ToJson(this));
    }
    #endregion

    #region AKCIÓK
    public async void CollectScience()
    {
        Building changesAfterCollection = await APIHelper.postCollectScience(BuildingID);
        if (changesAfterCollection == null)
        {
            _claimButton.interactable = true;
            return;
        }

        //Debug.LogWarning(changesAfterCollection.Params);

        Initialize(changesAfterCollection);
    }
    #endregion

    #region UI FRISSÍTÉS
    public void updateUI()
    {
        string remainingTime = "A maximum tudás összegyűjtéséig hátralévõ idő:\n" + ((timeUntilFull.Hours + timeUntilFull.Minutes + timeUntilFull.Seconds == 0) ? "kész" : ((timeUntilFull.Hours + timeUntilFull.Minutes == 0) ? "kevesebb, mint 1 perc" : $"{timeUntilFull.Hours}:{timeUntilFull.Minutes}"));
        GameObject.Find("TudasCountDownLabel").GetComponent<TMP_Text>().text = remainingTime;

        GameObject.Find("ResearchStatsLabel").GetComponent<TMP_Text>().text = $"Megtermelt tudás:\n{currentScience}\n{levelVariables.SciencePM}/perc";

        // A Begyűjtés gomb kikapcsolása, ha nincs begyűjtendő tudás
        GameObject.Find("ClaimButton").GetComponent<Button>().enabled = currentScience != 0;

        // Begyűjtött tudás kiírása
        GameObject.Find("StoredScienceLabel").GetComponent<TMP_Text>().text = storedScience.ToString();
    }
    #endregion
}
