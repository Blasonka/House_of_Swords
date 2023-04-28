using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class CureScript : MonoBehaviour
{
    private GameManager gameManager;
    private void Start()
    {
        gameManager = GameObject.Find("GameManager").GetComponent<GameManager>();
    }

    public void OnStartCureButtonPressed()
    {
        Infirmary infirmaryBuilding = (Infirmary)gameManager.Buildings["Infirmary"];
        infirmaryBuilding.StartCure();
    }
    public void OnFinishCureButtonPressed()
    {
        Infirmary infirmaryBuilding = (Infirmary)gameManager.Buildings["Infirmary"];
        infirmaryBuilding.FinishCure();
    }
}
