using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class BuildingsManager : MonoBehaviour
{
    public List<Collider2D> buildings = new List<Collider2D>();

    public bool windowIsOpen = false;

    private void Start()
    {
        foreach (Transform child in transform)
        {
            buildings.Add(child.gameObject.GetComponent<Collider2D>());
            //Debug.Log(child.gameObject.name);
        }

        enableBuildingWindows(false);
    }

    public static void enableBuildingWindows(bool value)
    {
        GameObject.Find("WindowCanvas").GetComponent<Canvas>().enabled = value;

        BuildingsManager buildingsManager = GameObject.Find("BuildingsManager").GetComponent<BuildingsManager>();
        buildingsManager.setBuildingCollidersTo(!value);
        buildingsManager.windowIsOpen = value;
    }

    public void setBuildingCollidersTo(bool isEnabled)
    {
        foreach (Collider2D building in buildings)
        {
            building.GetComponent<BoxCollider2D>().enabled = isEnabled;
        }
    }
}
