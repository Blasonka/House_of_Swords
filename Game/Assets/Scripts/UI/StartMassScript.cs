using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class StartMassScript : MonoBehaviour
{
    private GameManager gameManager;

    private void Start()
    {
        gameManager = GameObject.Find("GameManager").GetComponent<GameManager>();
    }

    public void OnStartMassButtonPressed()
    {
        Church churchBuilding = (Church)gameManager.Buildings["Church"];
        churchBuilding.StartMass();
    }
}
