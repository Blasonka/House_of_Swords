using System;
using System.Collections.Generic;
using System.Security.Cryptography;
using System.Text;

public static class CryptoManager
{
    /// <summary>
    /// Titkosít egy karakterláncot SHA512-es formátumba.
    /// </summary>
    /// <param name="s">Az átalakítandó karakterlánc.</param>
    /// <returns></returns>
    public static string hashString(string s)
    {
        // A titkosító osztály elõkészítése
        SHA512 hasher = SHA512.Create();
        hasher.Initialize();

        // A beírt karakterláncot egy hexadecimális byte tömbbé alakítjuk,
        // majd ezt a tömböt a titkosító osztály segítségével kódoljuk
        byte[] data = hasher.ComputeHash(Encoding.Default.GetBytes(s));

        // Az eredményt byte tömbbõl visszaalakítjuk karakterekké
        string result = BitConverter.ToString(data);

        // A karakterlánc formázása, hogy az adatbázisban lévõvel egyezõ legyen
        // (nincsenek benne kötõjelek, és kisbetûs)
        string reductedResult = "";
        for (int i = 0; i < result.Length; i++)
            if (result[i] != '-') reductedResult += result[i];
        reductedResult = reductedResult.ToLower();

        // A titkosító osztály példányát töröljük a biztonság érdekében.
        hasher.Dispose();

        return reductedResult;
    }

    /// <summary>
    /// Visszaadja a karakterlánc összes lehetséges variációját borsozás után.
    /// </summary>
    /// <param name="s">A borsozandó karakterlánc.</param>
    /// <returns></returns>
    public static List<string> pepperString(string s)
    {
        List<string> pepperedStrings = new List<string>();

        for (char c = 'a'; c <= 'z'; c++)
            pepperedStrings.Add(s + c);
        for (char c = 'A'; c <= 'Z'; c++)
            pepperedStrings.Add(s + c);

        return pepperedStrings;
    }
}

