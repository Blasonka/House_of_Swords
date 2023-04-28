using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class CollectScienceScript : MonoBehaviour
{
    private GameManager gameManager;

    private void Start()
    {
        gameManager = GameObject.Find("GameManager").GetComponent<GameManager>();
    }

    public void OnCollectScienceButtonPressed()
    {
        Research researchBuilding = (Research)gameManager.Buildings["Research"];
        researchBuilding.CollectScience();
    }
}
