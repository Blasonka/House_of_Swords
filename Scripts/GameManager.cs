using System;
using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;

using System.Net;
using System.IO;

/// <summary>
/// A játék "fõnöke", minden olyan dolgot irányít/tárol, amit több mindennek kell elérnie. Például menti a bejelentkezett felhasználó adatait, illetve azt, hogy melyik városában játszik.
/// </summary>
public class GameManager : MonoBehaviour
{
    [Header("Static Variables")]
    [Space(10)]
    public string usersAPIRoute = "https://houseofswords.hu/api/users";
    public string townsAPIRoute = "https://houseofswords.hu/api/towns";
    public int maxTownCount = 3;
    public GameObject townIconPrefab;

    [Space(10)]
    [Header("Dinamic Variables")]
    [Space(10)]
    public User User;
    [Space(5)]
    public Town Town;

    void Start()
    {
        Screen.SetResolution(Screen.currentResolution.width, Screen.currentResolution.height, true);
        DontDestroyOnLoad(gameObject);
    }

    void Update()
    {
        if (Input.GetKeyDown(KeyCode.KeypadMinus)) StartCoroutine(goToMap());
    }

    IEnumerator goToMap()
    {
        SceneManager.LoadScene(1);
        yield return new WaitForSeconds(1);
        SceneManager.SetActiveScene(SceneManager.GetSceneByBuildIndex(1));

        fetchTowns();
    }

    void fetchTowns()
    {
        HttpWebRequest request;
        HttpWebResponse response = new HttpWebResponse();

        try
        {
            request = (HttpWebRequest)WebRequest.Create(townsAPIRoute);
            request.Method = "GET";
            response = (HttpWebResponse)request.GetResponse();
        }
        catch (Exception ex)
        {
            Debug.Log(ex.Message);
        }

        StreamReader sr = new StreamReader(response.GetResponseStream());
        string json = sr.ReadToEnd();

        Town[] fetchedTowns = JsonUtility.FromJson<Towns>("{\"fetchedTowns\":" + json + "}").fetchedTowns;

        foreach (Town town in fetchedTowns)
        {
            GameObject createdIcon = GameObject.Instantiate(townIconPrefab);

            createdIcon.transform.position = new Vector2(town.XCords / 100, town.YCords / 100);

            createdIcon.GetComponent<SpriteRenderer>().color = UnityEngine.Random.ColorHSV(0.1f, 1f);
        }

    }
}
