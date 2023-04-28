using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UIElements;

public class OpenPanel : MonoBehaviour
{
    private GameObject buildingWindow;

    private void Start()
    {
        buildingWindow = GameObject.Find(gameObject.name + "Window");
    }

    private void OnMouseDown()
    {
        buildingWindow.transform.SetAsLastSibling();
        BuildingsManager.enableBuildingWindows(true);
        //transform.parent.gameObject.GetComponent<BuildingsManager>().setBuildingCollidersTo(false);
    }
}
