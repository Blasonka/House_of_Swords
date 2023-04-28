using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;

public class CloseMapScene : MonoBehaviour
{
    /// <summary>
    /// Bezárja a térképet.
    /// </summary>
    public void CloseMap()
    {
        SceneManager.UnloadSceneAsync("Map");
    }
}
