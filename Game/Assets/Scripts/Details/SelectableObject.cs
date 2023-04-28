using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.EventSystems;
using UnityEngine.UI;

public class SelectableObject : MonoBehaviour, IPointerEnterHandler, IPointerExitHandler
{
    private SpriteRenderer r;
    private Image i;

    private void Awake()
    {
        r = gameObject.GetComponent<SpriteRenderer>();
        i = gameObject.GetComponent<Image>();
    }

    // Ha ez egy kivalaszthato objektum
    private void OnMouseOver()
    {
        if (r != null)
        {
            r.color = new Color(r.color.r, r.color.g, r.color.b, 0.7f);
        }
    }

    private void OnMouseExit()
    {
        if (r != null)
        {
            r.color = new Color(r.color.r, r.color.g, r.color.b, 1);
        }
    }

    // Ha ez egy kivalaszthato UI elem
    public void OnPointerEnter(PointerEventData eventData)
    {
        if (i != null)
        {
            i.color = new Color(i.color.r, i.color.g, i.color.b, 0.7f);
        }
    }

    public void OnPointerExit(PointerEventData eventData)
    {
        if (i != null)
        {
            i.color = new Color(i.color.r, i.color.g, i.color.b, 1);
        }
    }
}
