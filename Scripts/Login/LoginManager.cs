using System.Collections;
using System.Net;
using UnityEngine;
using System.IO;
using System;

using TMPro;
using UnityEngine.UI;
using UnityEngine.Networking;

public class LoginManager : MonoBehaviour
{
    [Header("Variables")]
    [Space(10)]
    public string registerPageLink = "https://houseofswords.hu/register";

    [Space(5)]
    [Header("Login Screen Objects")]
    [Space(5)]
    public TMP_InputField usernameText;
    public TMP_InputField pwdText;
    public TMP_Text errorText;

    [Space(10)]
    [Header("Towns Menu")]
    [Space(5)]
    public GameObject townCreationButton;
    public TMP_InputField townNameInput;
    public TMP_Text townErrorText;
    public GameObject[] townMenuButtons;

    GameObject loginPanel;
    GameObject loggedInPanel;

    GameManager gameManager;
    User user;

    public void Start()
    {
        usernameText.Select();
        pwdText.inputType = TMP_InputField.InputType.Password;

        loginPanel = GameObject.Find("LoginPanel");
        loginPanel.SetActive(true);
        loggedInPanel = GameObject.Find("LoggedInPanel");
        loggedInPanel.SetActive(false);

        gameManager = GameObject.FindGameObjectWithTag("GameManager").GetComponent<GameManager>();

        // Debug.Log(CryptoManager.hashString("wauboikdiekrléciasnmvteveiH"));
    }

    /// <summary>
    /// Megnyitja a felhasználó alapértelmezett böngészõjében a regisztrációs oldalt.
    /// </summary>
    public void registerNavigation()
    {
        Application.OpenURL(registerPageLink);
    }

    /// <summary>
    /// Ellenõrzi a felhasználó által beírt adatok helyességét, és ha minden rendben van, akkor bejelentkezteti a felhasználót.
    /// </summary>
    public void tryLogin()
    {
        displayError();

        string username = usernameText.text;
        string pwd = pwdText.text;

        // user = fetchUserByName(username);
        user = APIHelper.fetchUserByName(username);
        if (user == null)
        {
            displayError("User does not exist.", usernameText);
            return;
        }

        string saltedPwd = pwd + user.PwdSalt;

        if (isPwdCorrect(saltedPwd, user.PwdHash))
        {
            onLoginSuccess(true);
            return;
        }

        displayError("Passwords don't match.", pwdText);
        return;
    }

    /// <summary>
    /// A beírt jelszó ellenõrzése a titkosítási irányelveket követve.
    /// </summary>
    /// <param name="saltedPwd">A beírt jelszó, melynek a végére hozzáfûztük a só-láncot.</param>
    /// <param name="hash">Az adatbázisból érkezett titkosított jelszó, amivel egyeznie kell az elõzõ jelszónak titkosítás után.</param>
    /// <returns>Ha igaz, akkor helyes a beírt jelszó.</returns>
    public bool isPwdCorrect(string saltedPwd, string hash)
    {
        for (int i = 0; i < 52; i++)
            if (CryptoManager.hashString(CryptoManager.pepperString(saltedPwd)[i]) == hash) return true;

        return false;
    }

    /// <summary>
    /// Kiír egy hibát, amibe a bejelentkezés során ütköztünk, vagy kitörli a hibamezõket (ha nem adunk meg paramétereket).
    /// </summary>
    /// <param name="errorValue">A kiírandó hiba (ha van).</param>
    /// <param name="problemField">A bemeneti mezõ, amivel van a probléma (ha van).</param>
    public void displayError(string errorValue = "", TMP_InputField problemField = null)
    {
        errorText.text = errorValue;
        errorText.enabled = errorValue != "";
        if (problemField != null) problemField.Select();
    }

    /// <summary>
    /// Ha elõzõleg kiírtunk egy hibát, és a felhasználó elkezdi kijavítani a beírt adatokat, akkor eltûntetjük a kiírt hibát.
    /// </summary>
    public void inputTextChanged()
    {
        displayError();
    }

    /// <summary>
    /// Bejelentkezéssel, avagy kijelentkezéssel kapcsolatos logika.
    /// </summary>
    /// <param name="value">True: sikeres bejelentkezés; False: kijelentkezés</param>
    public void onLoginSuccess(bool value)
    {
        loginPanel.SetActive(!value);
        loggedInPanel.SetActive(value);
        pwdText.text = "";

        if (value)
        {
            gameManager.User = user;
            int index = 0;
            Town[] townsOfUser = APIHelper.fetchTownsOfUser(user.UID);
            if (townsOfUser.Length > 0)
            {
                foreach (Town town in townsOfUser)
                {
                    townMenuButtons[index].GetComponentInChildren<Text>().text = town.TownName;
                    index++;
                }
            }

            for (int i = index; i < gameManager.maxTownCount; i++)
            {

                townMenuButtons[i].GetComponentInChildren<Text>().text = "Create new town...";

                townMenuButtons[i].GetComponent<Button>().onClick.AddListener(showTownCreationButtons);
            }
        }
        else
        {
            gameManager.User = null;
            townErrorText.text = String.Empty;
            townNameInput.text = String.Empty;
            townErrorText.enabled = false;
            townCreationButton.SetActive(false);
            townNameInput.gameObject.SetActive(false);
        }
    }

    /// <summary>
    /// Új város készítésénél a beírt városnév hosszának ellenõrzése.
    /// </summary>
    /// <param name="enteredName">A beírt városnév</param>
    /// <returns>Üres szöveget, ha minden rendben, ellenkezõ esetben pedig a hibaüzenetet.</returns>
    public string validateTownName(string enteredName)
    {
        if (enteredName.Length < 5) return "A városnév túl rövid (min. 5 karakter)!";
        if (enteredName.Length > 20) return "A városnév túl hosszú (max. 20 karakter)!";
        return String.Empty;
    }

    /// <summary>
    /// Az új városnév beviteli mezõjének változása esetén automatikus validálás.
    /// </summary>
    public void townNameTextChanged()
    {
        string validationResult = validateTownName(townNameInput.text);

        townErrorText.text = validationResult;
        townErrorText.enabled = validationResult != String.Empty;
    }

    /// <summary>
    /// Ha a felhasználó rányomott az új város gombra, akkor jelenjen meg a városnév beviteli mezõ és a létrehozás gomb.
    /// </summary>
    public void showTownCreationButtons()
    {
        townNameInput.gameObject.SetActive(true);
        townCreationButton.SetActive(true);
    }

    /// <summary>
    /// A létrehozás gombra kattintva végsõ ellenõrzés, majd egy kérés küldése a szervernek.
    /// </summary>
    public void tryCreateTown()
    {
        if (validateTownName(townNameInput.text) != String.Empty) return;

        // CREATE TOWN WITH POST REQUEST
        StartCoroutine(APIHelper.postCreateTown(townNameInput.text, gameManager.User.UID));
    }
}