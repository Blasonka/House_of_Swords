using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class CameraMovement : MonoBehaviour
{
    public float cameraSpeedKeyboard = 10f;
    public float cameraSpeedMouse = 1f;
    public float cameraDragSensitivity = 5f;

    private KeyCode[] movementKeys = new KeyCode[4] { KeyCode.W, KeyCode.D, KeyCode.S, KeyCode.A }; // FEL JOBBRA LE BALRA

    private GameObject topLeftBorder;
    private GameObject bottomRightBorder;

    private BuildingsManager buildingsManager;

    private Vector3 initialMousePos;

    /// <summary>
    /// Függvény a kamera-mozgás billentyûinek beállítására.
    /// </summary>
    /// <param name="up">Felfelé mozgás - null, ha nem változik.</param>
    /// <param name="right">Jobbra mozgás - null, ha nem változik.</param>
    /// <param name="down">Lefelé mozgás - null, ha nem változik.</param>
    /// <param name="left">Balra mozgás - null, ha nem változik.</param>
    public void changeMovementKeys(KeyCode? up = null, KeyCode? right = null, KeyCode? down = null, KeyCode? left = null)
    {
        if (up != null) movementKeys[0] = (KeyCode)up;
        if (right != null) movementKeys[1] = (KeyCode)right;
        if (down != null) movementKeys[2] = (KeyCode)down;
        if (left != null) movementKeys[3] = (KeyCode)left;
    }

    private void clampCameraToBounds()
    {
        if (transform.position.x < topLeftBorder.transform.position.x) transform.position = new Vector3(topLeftBorder.transform.position.x, transform.position.y, transform.position.z);
        if (transform.position.x > bottomRightBorder.transform.position.x) transform.position = new Vector3(bottomRightBorder.transform.position.x, transform.position.y, transform.position.z);
        if (transform.position.y > topLeftBorder.transform.position.y) transform.position = new Vector3(topLeftBorder.transform.position.x, topLeftBorder.transform.position.y, transform.position.z);
        if (transform.position.y < bottomRightBorder.transform.position.y) transform.position = new Vector3(topLeftBorder.transform.position.x, bottomRightBorder.transform.position.y, transform.position.z);
    }

    private void Start()
    {
        topLeftBorder = GameObject.Find("TopLeftBorder");
        bottomRightBorder = GameObject.Find("BottomRightBorder");

        buildingsManager = GameObject.Find("BuildingsManager").GetComponent<BuildingsManager>();
    }

    private void Update()
    {
        // A KAMERA VISSZAÁLLÍTÁSA ALAPHELYZETBE (TESZTELÉSHEZ)
        if (Input.GetKeyDown(KeyCode.R)) transform.position = new Vector3(0, 0, -10);

        // KAMERAMOZGÁS EGÉRREL
        if (Input.GetMouseButtonDown(0))
        {
            initialMousePos = Input.mousePosition;
        }
        if (Input.GetMouseButton(0) && !buildingsManager.windowIsOpen)
        {
            Vector3 delta = (Input.mousePosition - initialMousePos) * cameraSpeedMouse;


            delta *= Time.deltaTime;
            transform.position -= delta;

            clampCameraToBounds();

            //Mathf.Clamp(transform.position.x, topLeftBorder.transform.position.x, bottomRightBorder.transform.position.x);
            //Mathf.Clamp(transform.position.y, bottomRightBorder.transform.position.y, topLeftBorder.transform.position.y);

            //if (isWithinBounds(transform.position - delta))
            //{
            //}

            initialMousePos = Input.mousePosition;
            return;
        }

        // KAMERAMOZGÁS BILLENTYÛKKEL, HA AZ EGÉRREL NEM MOZOG
        if (Input.GetKey(movementKeys[0]) && transform.position.y < topLeftBorder.transform.position.y) transform.position = new Vector3(transform.position.x, transform.position.y + cameraSpeedKeyboard * Time.deltaTime, transform.position.z);
        if (Input.GetKey(movementKeys[1]) && transform.position.x < bottomRightBorder.transform.position.x) transform.position = new Vector3(transform.position.x + cameraSpeedKeyboard * Time.deltaTime, transform.position.y, transform.position.z);
        if (Input.GetKey(movementKeys[2]) && transform.position.y > bottomRightBorder.transform.position.y) transform.position = new Vector3(transform.position.x, transform.position.y - cameraSpeedKeyboard * Time.deltaTime, transform.position.z);
        if (Input.GetKey(movementKeys[3]) && transform.position.x > topLeftBorder.transform.position.x) transform.position = new Vector3(transform.position.x - cameraSpeedKeyboard * Time.deltaTime, transform.position.y, transform.position.z);
    }
}
