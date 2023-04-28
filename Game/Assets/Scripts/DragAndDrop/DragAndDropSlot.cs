using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.Events;
using UnityEngine.EventSystems;

public class DragAndDropSlot : MonoBehaviour, IDropHandler
{
    private RectTransform rectTransform;

    public UnityEvent onDroppedInside;
    public UnityEvent onTakenOut;

    private void Start()
    {
        rectTransform = gameObject.GetComponent<RectTransform>();
    }
    public void OnDrop(PointerEventData eventData)
    {
        if (eventData.pointerDrag != null && eventData.pointerDrag.tag == "DraggableItem")
        {
            DragAndDropElement element = eventData.pointerDrag.GetComponent<DragAndDropElement>();
            DragAndDropSlot previousSlot = element.currentSlot;

            if (!previousSlot || previousSlot != this)
            {
                element.newPosition = rectTransform.anchoredPosition;

                if (previousSlot) previousSlot.onTakenOut.Invoke();

                element.currentSlot = gameObject.GetComponent<DragAndDropSlot>();
                Debug.Log(element.currentSlot);
                onDroppedInside.Invoke();
            }
        }

        // DEPRECATED
        //if (eventData.pointerDrag != null && eventData.pointerDrag.tag == "DraggableItem" &&
        //    (eventData.pointerDrag.GetComponent<DragAndDropElement>().currentSlot == null || eventData.pointerDrag.GetComponent<DragAndDropElement>().currentSlot != gameObject))
        //{
        //    eventData.pointerDrag.GetComponent<DragAndDropElement>().newPosition = rectTransform.anchoredPosition;


        //    eventData.pointerDrag.GetComponent<DragAndDropElement>().currentSlot = gameObject.GetComponent<DragAndDropSlot>();
        //    onDroppedInside.Invoke();
        //}
    }
}
