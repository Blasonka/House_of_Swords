using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class UpdateResearchBuilding : MonoBehaviour
{
    GameManager _gameManager;
    Research _research;
    private void Start()
    {
        _gameManager = GameObject.Find("GameManager").GetComponent<GameManager>();
    }

    /// <summary>
    /// Amikor megnyílik a kutató épület ablaka kattintásra, frissüljenek a kiírt adatai.
    /// </summary>
    /// <param name="eventData"></param>
    public async void OnMouseDown()
    {
        // Melyik a research épület?
        _research = (Research)_gameManager.Buildings["Research"];

        // API HÍVÁS
        _research.currentScience = await APIHelper.fetchCurrentScienceOfResearch(_research.BuildingID);

        // UI FRISSÍTÉS
        _research.updateUI();
    }
}
