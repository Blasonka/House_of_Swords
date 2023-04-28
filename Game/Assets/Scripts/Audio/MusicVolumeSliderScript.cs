using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class MusicVolumeSliderScript : MonoBehaviour
{
    AudioManager _audioManager;
    private void Start()
    {
        _audioManager = GameObject.Find("AudioManager").GetComponent<AudioManager>();
    }
    public void OnSliderChanged()
    {
        _audioManager.MusicVolumeSliderChanged(gameObject.GetComponent<Slider>());
    }
}
