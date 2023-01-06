using System;
using System.Collections;
using System.Collections.Generic;
using System.IO;
using System.Net;
using UnityEngine;
using UnityEngine.Networking;

public static class APIHelper
{
    // API ROUTES
    public static string usersAPIRoute = "https://houseofswords.hu/api/users";
    public static string townsAPIRoute = "https://houseofswords.hu/api/towns";

    // NETWORK COMMUNICATION

    /// <summary>
    /// Lekéri az adatbázisból a felhasználó adatait.
    /// </summary>
    /// <param name="username">A felhasználó neve, ami alapján történik a keresés.</param>
    /// <returns>A keresett felhasználó.</returns>
    public static User fetchUserByName(string username)
    {
        HttpWebRequest request;
        HttpWebResponse response;
        try
        {
            request = (HttpWebRequest)WebRequest.Create(usersAPIRoute + "?Username=" + username);
            request.Method = "GET";
            response = (HttpWebResponse)request.GetResponse();
        }
        catch (Exception ex)
        {
            Debug.LogError(ex.Message);
            return null;
        }

        StreamReader sr = new StreamReader(response.GetResponseStream());
        string json = sr.ReadToEnd();

        return JsonUtility.FromJson<User>(json.TrimStart('[').TrimEnd(']'));
    }

    /// <summary>
    /// A felhasználó városainak lekérése az adatbázisból.
    /// </summary>
    /// <param name="UID">A felhasználó azonosítója.</param>
    /// <returns></returns>
    public static Town[] fetchTownsOfUser(int UID)
    {
        HttpWebRequest request;
        HttpWebResponse response;
        try
        {
            request = (HttpWebRequest)WebRequest.Create(townsAPIRoute + "?Users_UID=" + UID);
            request.Method = "GET";
            response = (HttpWebResponse)request.GetResponse();

        }
        catch (Exception ex)
        {
            Debug.LogError(ex.Message);
            return null;
        }

        // Debug.Log(response.GetResponseStream());
        StreamReader sr = new StreamReader(response.GetResponseStream());
        string json = sr.ReadToEnd();

        // Debug.Log(json);

        if (!json.StartsWith('[') && !json.EndsWith(']')) json = '[' + json + ']';

        return JsonUtility.FromJson<Towns>("{\"fetchedTowns\":" + json + "}").fetchedTowns;
    }

    /// <summary>
    /// Aszinkron POST kérés, melyben a szerver hozzon létre a megadott névvel a felhasználónak egy új várost.
    /// </summary>
    /// <param name="townName">A megadott városnév.</param>
    /// <param name="UID">A felhasználó ID-je, akié lesz a város.</param>
    /// <returns></returns>
    public static IEnumerator postCreateTown(string townName, int UID)
    {
        UnityWebRequest request;

        WWWForm data = new WWWForm();
        data.AddField("TownName", townName);
        //string json = JsonUtility.ToJson(new TownToCreate(townNameInput.text));
        //Debug.Log(json);
        request = UnityWebRequest.Post(townsAPIRoute + "/create/" + UID, data);

        yield return request.SendWebRequest();

        if (request.result != UnityWebRequest.Result.Success)
        {
            Debug.LogError("NINCS NET");
        }
        else
        {
            Debug.Log(request.downloadHandler.text);
        }

        request.Dispose();
    }
}
