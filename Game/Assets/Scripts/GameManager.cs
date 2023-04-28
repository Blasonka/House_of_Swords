using System;
using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;
using System.Net;
using System.IO;
using TMPro;
using UnityEngine.UI;

/// <summary>
/// A játék "fõnöke", minden olyan dolgot irányít/tárol, amit több szkriptnek kell elérnie.
/// Például menti a bejelentkezett felhasználó adatait, illetve azt, hogy melyik városában játszik,
/// illetve a játékban a bemenetet érzékeli, hogy gomblenyomásra mi történjen.
/// </summary>
public class GameManager : MonoBehaviour
{
    #region PUBLIC VARIABLES
    [Header("Static Variables")]
    [Space(10)]
    public int maxTownCount = 3;

    public GameObject townIconPrefab;
    public int townIconCoordinatesXMacro = 5;
    public int townIconCoordinatesYMacro = 7;
    public float townIconSizeMacro = 0.15f;

    public int selectedTownOnMap;
    public string selectedTownOnMapName;

    [Space(10)]
    [Header("Dinamic Variables")]
    [Space(10)]
    public User User;
    [Space(5)]
    public Town Town;
    [Space(5)]
    public Dictionary<string, object> Buildings = new Dictionary<string, object>();
    [Space(5)]
    public Unit[] UnitStats;
    #endregion

    #region PRIVATE VARIABLES
    private const int townRefreshRate = 15;

    private bool isMenuOpen = false;
    #endregion

    void Start()
    {
        Screen.SetResolution(Screen.currentResolution.width, Screen.currentResolution.height, FullScreenMode.FullScreenWindow, 60);
        DontDestroyOnLoad(gameObject);

        SceneManager.sceneLoaded += onSceneLoaded;
    }

    private void onSceneLoaded(Scene scene, LoadSceneMode loadSceneMode)
    {
        if (scene.name == "Map") turnOnMinimap();
        if (scene.name == "Game") initializeGame();
    }

    async void Update()
    {
        // OLDALSÓ MENÜ MEGNYITÁSA VAGY BEZÁRÁSA AZ ESCAPE GOMB MEGNYOMÁSÁRA
        if (Input.GetKeyDown(KeyCode.Escape))
        {
            SwitchMenuState();
        }

        #region TEST INPUTS
        if (Input.GetKeyDown(KeyCode.KeypadMinus) && !SceneManager.GetSceneByName("Map").isLoaded) switchSceneAdditive("Map");
        if (Input.GetKeyDown(KeyCode.KeypadPlus)) SceneManager.UnloadSceneAsync("Map");

        if (Input.GetKeyDown(KeyCode.Keypad0))
        {
            Building[] buildings = await APIHelper.fetchBuildings();

            foreach (Building building in buildings)
            {
                Debug.Log(building.BuildingType);
            }
        }
        if (Input.GetKeyDown(KeyCode.Keypad1))
        {
            Building building = await APIHelper.fetchBuildingById(18);

            Debug.Log(building.BuildingType);
        }
        if (Input.GetKeyDown(KeyCode.Keypad2))
        {
            Debug.Log(DateTime.Now.ToString("yyyy - MM - dd HH:mm:ss => fff"));
            Building[] buildings = await APIHelper.fetchBuildingsOfTown(Town);

            foreach (Building building in buildings)
            {
                Debug.Log(building.BuildingType);
            }
        }
        if (Input.GetKeyDown(KeyCode.Keypad3))
        {
            Building building = await APIHelper.fetchBuildingById(18);
            Church church = (Church)Building.ConvertToType(building);

            Debug.LogWarning("Last Mass Date: " + church.lastMassDate);
            Debug.LogWarning("Cooldown remaining: " + church.massCooldown);
        }
        if (Input.GetKeyDown(KeyCode.Keypad4))
        {
            Church.churchLevelVariables? vars = await APIHelper.fetchChurchStats(1);

            if (vars == null || !vars.HasValue)
            {
                Debug.LogWarning("NULL OR NO VALUE");
                return;
            }

            Debug.Log(vars.Value.MassLength.ToString());
        }
        if (Input.GetKeyDown(KeyCode.Keypad5))
        {
            Building result = await APIHelper.postStartMass(18);
            Debug.Log(result.BuildingType);
        }
        if (Input.GetKeyDown(KeyCode.Keypad6))
        {
            Research.researchLevelVariables? result = await APIHelper.fetchResearchStats(1);

            if (result == null)
            {
                Debug.Log("NULL EZ A SZAR");
                return;
            }

            Debug.Log(result.Value.SciencePM);
        }
        if (Input.GetKeyDown(KeyCode.Keypad7))
        {
            Unit[] result = await APIHelper.fetchUnitStats();

            if (result == null)
            {
                Debug.Log("NULL EZ A SZAR");
                return;
            }

            foreach (Unit unit in result)
            {
                Debug.Log(unit.UnitName);
    }
        }
        //if (Input.GetKeyDown(KeyCode.Keypad8))
        //{
        //    Research.ResearchedUnitStruct[] researchedUnits = await APIHelper.fetchResearchedUnits(12);
        //    foreach (Research.ResearchedUnitStruct unit in researchedUnits)
        //    {
        //        Debug.Log("Researched unit: " + JsonUtility.ToJson(unit));
        //    }
        //}
        #endregion
    }

    #region SWITCHING SCENES
    public void switchSceneTo(string sceneName)
    {
        AsyncOperation loadingTask = SceneManager.LoadSceneAsync(sceneName, LoadSceneMode.Single);

        if (loadingTask.isDone)
        {
            loadingTask.completed += (AsyncOperation operation) =>
            {
                SceneManager.SetActiveScene(SceneManager.GetSceneByName(sceneName));
            };
        }
    }
    public void switchSceneAdditive(string sceneName)
    {
        AsyncOperation loadingTask = SceneManager.LoadSceneAsync(sceneName, LoadSceneMode.Additive);

        if (loadingTask.isDone)
        {
            loadingTask.completed += (AsyncOperation operation) =>
            {
                SceneManager.SetActiveScene(SceneManager.GetSceneByName(sceneName));
            };
        }
    }
    #endregion

    #region MINIMAP
    async void turnOnMinimap()
    {
        // Előzőleg kiválasztott város nevének visszaírása a címkébe, ha volt ilyen
        GameObject.Find("ChosenTownLabel").GetComponent<TMP_Text>().text = String.IsNullOrEmpty(selectedTownOnMapName) ? "nincs" : selectedTownOnMapName;

        // A térképen látható városok lekérése
        Town[] allTowns = await APIHelper.fetchTowns();

        foreach (Town town in allTowns)
        {
            // Az objektum létrehozása a térképen
            Transform parent = GameObject.Find("WorldTownsHolder").transform;
            GameObject createdIcon = GameObject.Instantiate(townIconPrefab, parent);

            // Az objektum helyzetének beállítása
            createdIcon.transform.localPosition = new Vector3(town.XCords / townIconCoordinatesXMacro, town.YCords / townIconCoordinatesYMacro, parent.position.z);
            createdIcon.transform.localScale *= townIconSizeMacro;

            // Az objektum tulajdonságainak beállítása
            createdIcon.GetComponent<TownOnMapScript>().SetData(town);

            // Random szín beállítása minden város ikonnak - nem néz ki jól
            //createdIcon.GetComponent<Image>().color = UnityEngine.Random.ColorHSV(0.1f, 1f);
        }
    }
    #endregion

    // A JÁTÉK INDÍTÁSA
    private async void initializeGame()
    {
        // TÖLTÕKÉPERNYÕ BEKAPCSOLÁSA
        GameObject.Find("LoadingCanvas").GetComponent<Canvas>().enabled = true;

        // OLDALSÓ MENÜ MEGNYITÁSÁRA ÉS BEZÁRÁSÁRA
        // SZOLGÁLÓ GOMBOK KLIKK ESEMÉNYÉNEK BEÁLLÍTÁSA
        GameObject.Find("CloseMenuButton").GetComponent<Button>().onClick.AddListener(delegate
        {
            SwitchMenuState();
        });
        GameObject.Find("OpenMenuButton").GetComponent<Button>().onClick.AddListener(delegate
        {
            SwitchMenuState();
        });

        // KILÉPÉS GOMBOK KLIKK ESEMÉNYE
        GameObject.Find("ExitToMenuButton").GetComponent<Button>().onClick.AddListener(delegate
        {
            QuitToMenu();
        });
        GameObject.Find("ExitGameButton").GetComponent<Button>().onClick.AddListener(delegate
        {
            QuitGame();
        });

        // EGYSÉGTÍPUSOK LEKÉRDEZÉSE
        UnitStats = await APIHelper.fetchUnitStats();

        // VÁROS ÉPÜLETEINEK BEÁLLÍTÁSA
        Building[] buildingsOfTown = await APIHelper.fetchBuildingsOfTown(Town);
        foreach (Building building in buildingsOfTown)
        {
            Debug.LogWarning(building.BuildingType);
            Buildings.Add(building.BuildingType, Building.ConvertToType(building));
            //Debug.Log($"{building.BuildingType}");
        }

        // UI FRISSÍTÉSE
        updateLabels();

        // VÁRAKOZÁS AZ ADATOKRA
        StartCoroutine(loadingScreen());
    }

    public void updateLabels()
    {
        #region CHURCH
        Church churchBuilding = ((Church)Buildings["Church"]);
        GameObject.Find("WorshipStatsLabel").GetComponent<TMP_Text>().text = $"Boldogság növelés:\n{churchBuilding.HappinessBoost} / Mise";

        if (churchBuilding.massCooldown > TimeSpan.Zero)
        {
            GameObject.Find("CountDownDataLabel").GetComponent<TMP_Text>().text = $"{churchBuilding.massCooldown.Hours} óra {churchBuilding.massCooldown.Minutes} perc";
            GameObject.Find("StartButton").GetComponent<Button>().interactable = false;
        }
        else
        {
            GameObject.Find("CountDownDataLabel").GetComponent<TMP_Text>().text = "kész";
            GameObject.Find("StartButton").GetComponent<Button>().interactable = true;
        }
        #endregion

        // BARRACK
        #region BARRACK
        //TimeSpan fightCooldown = ((Barrack)Buildings["Barrack"]).fightCooldown;
        //int enemyTownId = ((Barrack)Buildings["Barrack"]).enemyTownId;
        //Town enemyTown = await APIHelper.fetchTownByID(enemyTownId);
        //GameObject.Find("FightLabel").GetComponent<TMP_Text>().text = $"{enemyTown.TownName} - {fightCooldown.Hours} óra {fightCooldown.Minutes} perc";
        #endregion

        #region RESEARCH
        Research researchBuilding = (Research)Buildings["Research"];
        if (researchBuilding.levelVariables.Lvl != 0) // ha 0, akkor nem jöttek meg még az adatok
            researchBuilding.updateUI();
        //Research researchBuilding = (Research)Buildings["Research"];
        //GameObject.Find("TudasCountDownLabel").GetComponent<TMP_Text>().text = $"Hátralévõ idõ:\n{researchBuilding.timeUntilFull.Hours}:{researchBuilding.timeUntilFull.Minutes}";
        //GameObject.Find("ResearchStatsLabel").GetComponent<TMP_Text>().text = $"Megtermelt tudás:\n{researchBuilding.currentScience}\n{researchBuilding.levelVariables.SciencePM} / min";
        //GameObject.Find("TudasCountDownLabel").GetComponent<TMP_Text>().text = $"Hátralévõ idõ:\n{researchBuilding.timeUntilFull.Hours}:{researchBuilding.timeUntilFull.Minutes}";
        //GameObject.Find("ResearchStatsLabel").GetComponent<TMP_Text>().text = $"Megtermelt tudás:\n{researchBuilding.currentScience}\n{researchBuilding.levelVariables.SciencePM} / min";
        #endregion

        #region MARKET
        //Market marketBuilding = (Market)Buildings["Market"];
        //GameObject.Find("TaxSlider").GetComponent<Slider>().maxValue = marketBuilding.MaxTax;
        //GameObject.Find("TaxSlider").GetComponent<Slider>().value = marketBuilding.taxAmount;
        //GameObject.Find("TaxIAmountnput").GetComponent<TMP_InputField>().text = $"{marketBuilding.taxAmount}";
        //GameObject.Find("TaxHappinesModifierLabel").GetComponent<TMP_Text>().text = $"Hatás a város boldogságára:\n{marketBuilding.HappinesModifier}";
        #endregion

        #region INFIRMARY
        Infirmary infirmaryBuilding = (Infirmary)Buildings["Infirmary"];
        if (infirmaryBuilding.levelVariables.Lvl != 0) // ha 0, akkor nem jöttek meg még az adatok
            infirmaryBuilding.updateUI();
        #endregion

        #region Warehouse
        Warehouse warehouseBuilding = (Warehouse)Buildings["Warehouse"];
        if (warehouseBuilding.levelVariables.Lvl != 0) // ha 0, akkor nem jöttek meg még az adatok
            warehouseBuilding.updateUI();
        #endregion

        #region TOWN
        GameObject.Find("TownNameLabel").GetComponent<TMP_Text>().text = Town.TownName;
        GameObject.Find("TownWoodLabel").GetComponent<TMP_Text>().text = $"{Town.Wood}/{warehouseBuilding.levelVariables.MaxCollectedWood}";
        GameObject.Find("TownStoneLabel").GetComponent<TMP_Text>().text = $"{Town.Stone}/{warehouseBuilding.levelVariables.MaxCollectedStone}";
        GameObject.Find("TownMetalLabel").GetComponent<TMP_Text>().text = $"{Town.Metal}/{warehouseBuilding.levelVariables.MaxCollectedMetal}";
        GameObject.Find("TownGoldLabel").GetComponent<TMP_Text>().text = $"{Town.Gold}/{warehouseBuilding.levelVariables.MaxCollectedGold}";
        GameObject.Find("TownHappinessValueLabel").GetComponent<TMP_Text>().text = "H: " + Town.HappinessValue;
        #endregion
    }

    IEnumerator loadingScreen()
    {
        // MEGVIZSGÁLNI, HOGY MEGJÖTT-E AZ ÖSSZES ÉPÜLET ADATA A BACKENDRÕL
        bool didEverythingLoad = true;

        foreach (KeyValuePair<string, object> k in Buildings)
        {
            object building = k.Value;
            switch (k.Key)
            {
                case "Church":
                    if (((Church)building).MassLength == null)
                    {
                        didEverythingLoad = false;
                        //Debug.Log("church nem toltott be");
                    }
                    break;
                case "Barrack":
                    // FEJLESZTÉS ALATT
                    break;
                case "Warehouse":
                    if (((Warehouse)building).levelVariables.MaxCollectedGold == 0)
                    {
                        didEverythingLoad = false;
                        //Debug.Log("warehouse nem toltott be");
                    }
                    break;
                case "Research":
                    if (((Research)building).levelVariables.Lvl == 0)
                    {
                        didEverythingLoad = false;
                        //Debug.Log("research nem toltott be");
                    }
                    break;
                case "Market":
                    if (((Market)building).HappinesModifierPerTax == 0)
                    {
                        didEverythingLoad = false;
                        //Debug.Log("market nem toltott be");
                    }
                    break;
                case "Infirmary":
                    if (((Infirmary)building).levelVariables.HealingTime == null)
                    {
                        didEverythingLoad = false;
                        //Debug.Log("infirmary nem toltott be");
                    }
                    break;
                case "Diplomacy":
                    // FEJLESZTÉS ALATT
                    break;
                default:
                    break;
            }
        }

        if (!didEverythingLoad)
        {
            // HA NEM JÖTT MEG MINDEN ADAT, VÁRJUNK MÉG 
            // EGY MÁSODPERCET, ÉS ELLENÕRIZZÜK ÚJRA
            Debug.Log("DATA HAS NOT ARRIVED YET: " + DateTime.Now.ToString());

            yield return new WaitForSeconds(1f);

            StartCoroutine(loadingScreen());
            yield break;
        }
        else
        {
            Debug.Log("DATA HAS ARRIVED: " + DateTime.Now.ToString());

            // MEGJÖTT MINDEN ADAT, KAPCSOLJUK KI A TÖLTÕKÉPERNYÕT
            GameObject.Find("LoadingCanvas").GetComponent<Canvas>().enabled = false;

            // INDÍTSUNK EGY IDÕKÖZÖNKÉNTI 
            // FRISSÍTÕ FOLYAMATOT A BACKENDEN LÉVÕ ADATOKKAL
            StartCoroutine(periodicalTownRefresh());
        }
    }
    IEnumerator periodicalTownRefresh()
    {
        Debug.Log("Periodical refresh: " + DateTime.Now.ToString());
        updateLabels();

        updateTownStats();

        yield return new WaitForSeconds(townRefreshRate);

        StartCoroutine(periodicalTownRefresh());
    }

    async void updateTownStats()
    {
        this.Town = await APIHelper.fetchTownByID(this.Town.TownID);
    }

    // OLDALSÓ MENÜ MEGNYITÁSA ÉS BEZÁRÁSA
    /// <summary>
    /// Ha az oldalsó menü nincs megnyitva akkor megnyílik, ellenkezõ esetben bezárul.
    /// </summary>
    public void SwitchMenuState()
    {
        isMenuOpen = !isMenuOpen;

        GameObject.Find("MenuPanel").GetComponent<Canvas>().enabled = isMenuOpen;

        GameObject.Find("OpenMenuButton").GetComponent<Button>().interactable = !isMenuOpen;
        GameObject.Find("CloseMenuButton").GetComponent<Button>().interactable = isMenuOpen;
    }

    // KILÉPÉS A JÁTÉKBÓL
    public void QuitToMenu()
    {
        StopAllCoroutines();
        StartQuitToMenuSequence();
    }
    private async void StartQuitToMenuSequence()
    {
        // Csak akkor térjünk vissza a menübe, ha a kilépési kérés el lett küldve a szervernek.
        await APIHelper.postLogout();

        Destroy(GameObject.Find("AudioManager"));

        switchSceneTo("Menu");

        Destroy(gameObject);
    }

    public void QuitGame()
    {
        StopAllCoroutines();
        StartQuitSequence();
    }
    private async void StartQuitSequence()
    {
        // Csak akkor záródjon be a játék, ha a kilépési kérés el lett küldve a szervernek.
        await APIHelper.postLogout();

        Application.Quit();
    }
}
