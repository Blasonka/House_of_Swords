using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class CloseButton : MonoBehaviour
{
    public void DoCloseWindow()
    {
        BuildingsManager.enableBuildingWindows(false);
        //transform.parent.gameObject.GetComponent<BuildingsManager>().setBuildingCollidersTo(true);
    }
}
    