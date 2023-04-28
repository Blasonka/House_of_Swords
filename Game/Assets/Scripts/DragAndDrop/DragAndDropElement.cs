using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.EventSystems;

public class DragAndDropElement : MonoBehaviour, IPointerDownHandler, IBeginDragHandler, IEndDragHandler, IDragHandler
{
    private Canvas canvas;
    private RectTransform rectTransform;

    private Vector2 startingPosition;
    public Vector2? newPosition = null;

    private CanvasGroup canvasGroup;
    public DragAndDropSlot currentSlot;

    //slots for warehouse

    private GameManager _gameManager;
    private List<string> warehouseSlots = new List<string>() { "StoneResourceCollectorSlot", "WoodResourceCollectorSlot", "MetalResourceCollectorSlot", "GoldResourceCollectorSlot" };
    private void Awake()
    {
        rectTransform = GetComponent<RectTransform>();
        canvas = FindObjectOfType<Canvas>();
        canvasGroup = GetComponent<CanvasGroup>();
        _gameManager = GameObject.Find("GameManager").GetComponent<GameManager>();
    }
    public void OnBeginDrag(PointerEventData eventData)
    {
        startingPosition = rectTransform.anchoredPosition;

        canvasGroup.alpha = .6f;
        canvasGroup.blocksRaycasts = false;
    }

    public void OnDrag(PointerEventData eventData)
    {
        rectTransform.anchoredPosition += eventData.delta  / canvas.scaleFactor;
    }

    public void OnEndDrag(PointerEventData eventData)
    {
        rectTransform.anchoredPosition = newPosition == null ? startingPosition : (Vector2)newPosition;
        newPosition = null;

        canvasGroup.alpha = 1f;
        canvasGroup.blocksRaycasts = true;
    }

    public void OnPointerDown(PointerEventData eventData)
    {
        // USER CLICKED ON THE OBJECT
        return;
    }

    public async void logSuccessfulDrop()
    {
        Debug.LogWarning("SIKERULT DROPPOLNI");
        Debug.Log(currentSlot);
        if (warehouseSlots.Contains(currentSlot.name)) {
            Building changesAfterDrop = await APIHelper.postAddBrigade(((Warehouse)_gameManager.Buildings["Warehouse"]).BuildingID, currentSlot.name);

            if (changesAfterDrop == null)
            {
                return;
            }
            Debug.LogWarning("changesAfterDrop");

            ((Warehouse)_gameManager.Buildings["Warehouse"]).Initialize(changesAfterDrop);            
        }
    }

    public void logSuccessfulTakeout()
    {
        Debug.LogWarning("SIKERULT KIVENNI");
    }
}
