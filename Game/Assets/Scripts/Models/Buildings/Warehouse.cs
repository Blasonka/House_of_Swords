using System;
using System.Collections.Generic;
using TMPro;
using UnityEngine;
using UnityEngine.UI;

public class Warehouse
{
    #region SEGÉD VÁLTOZÓK
    private TMP_Text StoneCollectionPMLabel = GameObject.Find("StoneCollectionPMLabel").GetComponent<TMP_Text>();
    private TMP_Text WoodCollectionPMLabel = GameObject.Find("WoodCollectionPMLabel").GetComponent<TMP_Text>();
    private TMP_Text MetalCollectionPMLabel = GameObject.Find("MetalCollectionPMLabel").GetComponent<TMP_Text>();
    private TMP_Text GoldCollectionPMLabel = GameObject.Find("GoldCollectionPMLabel").GetComponent<TMP_Text>();

    private Button RemoveStoneBrigadeButton = GameObject.Find("RemoveStoneBrigadeButton").GetComponent<Button>();
    private Button RemoveWoodBrigadeButton = GameObject.Find("RemoveWoodBrigadeButton").GetComponent<Button>();
    private Button RemoveMetalBrigadeButton = GameObject.Find("RemoveMetalBrigadeButton").GetComponent<Button>();
    private Button RemoveGoldBrigadeButton = GameObject.Find("RemoveGoldBrigadeButton").GetComponent<Button>();
    private Button RemoveAllBrigadesButton = GameObject.Find("RemoveAllBrigadesButton").GetComponent<Button>();

    private TMP_Text StoneResourceQuantity = GameObject.Find("StoneResourceQuantity").GetComponent<TMP_Text>();
    private TMP_Text WoodResourceQuantity = GameObject.Find("WoodResourceQuantity").GetComponent<TMP_Text>();
    private TMP_Text MetalResourceQuantity = GameObject.Find("MetalResourceQuantity").GetComponent<TMP_Text>();
    private TMP_Text GoldResourceQuantity = GameObject.Find("GoldResourceQuantity").GetComponent<TMP_Text>();

    private TMP_Text BrigadeInWarehouseLabel = GameObject.Find("BrigadeInWarehouseLabel").GetComponent<TMP_Text>();

    private List<GameObject> resourceCollectorSlots = new List<GameObject>() {
        GameObject.Find("StoneResourceCollectorSlot"),
        GameObject.Find("WoodResourceCollectorSlot"),
        GameObject.Find("MetalResourceCollectorSlot"),
        GameObject.Find("GoldResourceCollectorSlot")
    };

    private GameObject BrigadeCardSpawnpoint = GameObject.Find("BrigadeCardSpawnpoint");
    private GameObject ResourcePanel = GameObject.Find("ResourcePanel");
    private GameObject BrigadeCardPrefab = (GameObject)Resources.Load("BrigadeCard", typeof(GameObject));
    private GameObject addResourceBrigade;

    #endregion

    #region ÉPÜLET VÁLTOZÓK
    public int BuildingID;
    public int Towns_TownID;
    public string BuildingType;
    public int BuildingLvl;
    #endregion

    #region PARAMÉTEREK
    public int BrigadeInWarehouse;
    public int BrigadeInStone;
    public int BrigadeInWood;
    public int BrigadeInMetal;
    public int BrigadeInGold;
    #endregion

    #region AZ ÉPÜLET SZINTJÉTÕL FÜGGÕ VÁLTOZÓK
    public warehouseLevelVariables levelVariables;
    public struct warehouseLevelVariables
    {
        public int Lvl;
        public int MaxBrigadeCount;
        public double StoneCollectionPM;
        public double WoodCollectionPM;
        public double MetalCollectionPM;
        public double GoldCollectionPM;

        public int MaxCollectedWood;
        public int MaxCollectedStone;
        public int MaxCollectedMetal;
        public int MaxCollectedGold;
    }

    public async void updateLevelVariables(int newLevel)
    {
        warehouseLevelVariables? fetchedVariables = await APIHelper.fetchWarehouseStats(newLevel);

        if (fetchedVariables == null)
        {
            Debug.Log("Warehouse updateLevelVariables failed");
        }

        levelVariables = fetchedVariables.Value;

        updateUI();
    }
    #endregion

    #region SZÁMÍTOTT MEZÕK
    //...
    #endregion

    #region KONSTRUKTOR
    public Warehouse(Building building)
    {
        Initialize(building);
        updateLevelVariables(BuildingLvl);        
    }

    public void Initialize(Building building)
    {
        BuildingID = building.BuildingID;
        Towns_TownID = building.Towns_TownID;
        BuildingType = building.BuildingType;
        BuildingLvl = building.BuildingLvl;

        BrigadeInWarehouse = (int)building.BrigadeInWarehouse;
        BrigadeInStone = (int)building.BrigadeInStone;
        BrigadeInWood = (int)building.BrigadeInWood;
        BrigadeInMetal = (int)building.BrigadeInMetal;
        BrigadeInGold = (int)building.BrigadeInGold;

        updateLevelVariables(BuildingLvl);

        createNewBrigade();

        foreach (var resourceCollectorSlot in resourceCollectorSlots)
        {
            resourceCollectorSlot.GetComponent<DragAndDropSlot>().onDroppedInside.RemoveAllListeners();
            resourceCollectorSlot.GetComponent<DragAndDropSlot>().onDroppedInside.AddListener(delegate
            {
                addResourceBrigade.GetComponent<DragAndDropElement>().logSuccessfulDrop();
                GameObject.Destroy(addResourceBrigade);
            });
        }

        if (BrigadeInWarehouse < 1)
        {
            GameObject.Destroy(addResourceBrigade);
        }

        if (BrigadeInStone > 0) { RemoveStoneBrigadeButton.interactable = true; } else { RemoveStoneBrigadeButton.interactable = false; }
        if (BrigadeInWood > 0) { RemoveWoodBrigadeButton.interactable = true; } else { RemoveWoodBrigadeButton.interactable = false; }
        if (BrigadeInMetal > 0) { RemoveMetalBrigadeButton.interactable = true; } else { RemoveMetalBrigadeButton.interactable = false; }
        if (BrigadeInGold > 0) { RemoveGoldBrigadeButton.interactable = true; } else { RemoveGoldBrigadeButton.interactable = false; }
        if (BrigadeInStone + BrigadeInWood + BrigadeInMetal + BrigadeInGold > 0) { RemoveAllBrigadesButton.interactable = true; } else { RemoveAllBrigadesButton.interactable = false; }
    }
    #endregion

    #region AKCIÓK
    private void createNewBrigade()
    {
        GameObject.Destroy(addResourceBrigade);
        addResourceBrigade = GameObject.Instantiate(BrigadeCardPrefab, ResourcePanel.transform);
        addResourceBrigade.GetComponent<RectTransform>().anchoredPosition = BrigadeCardSpawnpoint.GetComponent<RectTransform>().anchoredPosition;
    }

    public async void RemoveBrigade(string resource)
    {
        Building changesAfterRemoveBrigade = await APIHelper.postRemoveBrigade(BuildingID, resource);

        if (changesAfterRemoveBrigade == null) return;

        Debug.LogWarning("changesAfterRemoveBrigade");

        Initialize(changesAfterRemoveBrigade);
    }
    #endregion

    #region UI FRISSÍTÉS
    public void updateUI()
    {
        StoneCollectionPMLabel.text = $"termelés\n{levelVariables.StoneCollectionPM*BrigadeInStone}/perc";
        WoodCollectionPMLabel.text = $"termelés\n{levelVariables.WoodCollectionPM*BrigadeInWood}/perc";
        MetalCollectionPMLabel.text = $"termelés\n{levelVariables.MetalCollectionPM*BrigadeInMetal}/perc";
        GoldCollectionPMLabel.text = $"termelés\n{levelVariables.GoldCollectionPM*BrigadeInGold}/perc";

        StoneResourceQuantity.text = $"{BrigadeInStone}x";
        WoodResourceQuantity.text = $"{BrigadeInWood}x";
        MetalResourceQuantity.text = $"{BrigadeInMetal}x";
        GoldResourceQuantity.text = $"{BrigadeInGold}x";

        BrigadeInWarehouseLabel.text = $"{BrigadeInWarehouse}x/{levelVariables.MaxBrigadeCount}";
    }
    #endregion
}
