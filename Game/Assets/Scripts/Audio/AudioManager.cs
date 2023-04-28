using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.Audio;
using UnityEngine.UI;

public class AudioManager : MonoBehaviour
{
    [SerializeField] private AudioMixerGroup menuMusicMixer;

    void Start()
    {
        DontDestroyOnLoad(gameObject);
    }

    public void MusicVolumeSliderChanged(Slider slider)
    {
        menuMusicMixer.audioMixer.SetFloat("MenuMusicVolume", slider.value);
    }
}
