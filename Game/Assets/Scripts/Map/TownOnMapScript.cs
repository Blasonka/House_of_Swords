using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.EventSystems;
using TMPro;

public class TownOnMapScript : MonoBehaviour, IPointerDownHandler
{
    public int TownID;
    public string TownName;

    /// <summary>
    /// Beállítja a város ikon tulajdonságait a város objektum alapján.
    /// </summary>
    /// <param name="town"></param>
    public void SetData(Town town)
    {
        TownID = town.TownID;
        TownName = town.TownName;

        gameObject.GetComponentInChildren<TMP_Text>().text = TownName;
    }

    /// <summary>
    /// A térképen a városra kattintáskor mi történjen.
    /// </summary>
    public void OnPointerDown(PointerEventData eventData)
    {
        // Kiválasztás mentése a GameManagerben
        GameObject.Find("GameManager").GetComponent<GameManager>().selectedTownOnMap = TownID;
        GameObject.Find("GameManager").GetComponent<GameManager>().selectedTownOnMapName = TownName;

        // Feltűntetni a kiválasztott város nevét a térképen
        GameObject.Find("ChosenTownLabel").GetComponent<TMP_Text>().text = TownName;

        // Kijelölés vizuálisan - egy keret rámozgatása az ikonra
        // ...
    }
}
