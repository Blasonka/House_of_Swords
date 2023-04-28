using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using Pathfinding;

public class DestroyNpcUponArrival : MonoBehaviour
{
    public float arrivalDistanceThreshold = 10f;

    Transform destination;

    private void Awake()
    {
        destination = gameObject.GetComponent<AIDestinationSetter>().target;

        StartCoroutine(CheckIfArrivedCoroutine());
    }

    IEnumerator CheckIfArrivedCoroutine()
    {
        if (destination == null)
        {
            yield return new WaitForSeconds(.5f);

            destination = gameObject.GetComponent<AIDestinationSetter>().target;

            if (destination == null)
            {
                StartCoroutine(CheckIfArrivedCoroutine());
                yield break;
            }
        }

        if ((transform.position.x < destination.position.x + arrivalDistanceThreshold) &&
            (transform.position.x > destination.position.x - arrivalDistanceThreshold) &&
            (transform.position.y < destination.position.y + arrivalDistanceThreshold) &&
            (transform.position.y > destination.position.y - arrivalDistanceThreshold))
        {
            GameObject.Destroy(gameObject);
        }
    }
}
