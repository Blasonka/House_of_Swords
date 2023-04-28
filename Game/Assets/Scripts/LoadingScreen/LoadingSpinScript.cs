using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class LoadingSpinScript : MonoBehaviour
{
    public float SpinSpeed = 200f;
    void FixedUpdate()
    {
        //transform.rotation = new Quaternion(, 0);

        transform.Rotate(new Vector3(0, 0, transform.rotation.z - SpinSpeed * Time.deltaTime));
    }
}
