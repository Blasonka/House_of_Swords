using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class SliderValueChanged : MonoBehaviour
{
    [SerializeField] private UnityEngine.UI.Slider slider;

    [SerializeField] private TMPro.TMP_InputField sliderInput;

    void Start()
    {
        slider.onValueChanged.AddListener(v =>
        {
            sliderInput.text = v.ToString("0");
        });
        sliderInput.onValueChanged.AddListener(v =>
        {
            slider.value = int.Parse(v);
        });
    }
}
