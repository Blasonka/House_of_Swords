using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class BrigadeScript : MonoBehaviour
{
    private GameManager gameManager;
    Warehouse warehouseBuilding;
    private void Start()
    {
        gameManager = GameObject.Find("GameManager").GetComponent<GameManager>();
        //warehouseBuilding = (Warehouse)gameManager.Buildings["Warehouse"];
    }

    public void OnRemoveStoneButtonPressed()
    {
        warehouseBuilding = (Warehouse)gameManager.Buildings["Warehouse"];
        warehouseBuilding.RemoveBrigade("stone");
    }

    public void OnRemoveWoodButtonPressed()
    {
        warehouseBuilding = (Warehouse)gameManager.Buildings["Warehouse"];
        warehouseBuilding.RemoveBrigade("wood");
    }

    public void OnRemoveMetalButtonPressed()
    {
        warehouseBuilding = (Warehouse)gameManager.Buildings["Warehouse"];
        warehouseBuilding.RemoveBrigade("metal");
    }

    public void OnRemoveGoldButtonPressed()
    {
        warehouseBuilding = (Warehouse)gameManager.Buildings["Warehouse"];
        warehouseBuilding.RemoveBrigade("gold");
    }

    public void OnRemoveAllButtonPressed()
    {
        warehouseBuilding = (Warehouse)gameManager.Buildings["Warehouse"];
        warehouseBuilding.RemoveBrigade("all");
    }
}
