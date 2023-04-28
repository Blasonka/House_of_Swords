using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using Pathfinding;

public class npcGfx : MonoBehaviour
{
    public AIPath aiPath;

    void Update()
    {
        // flipping based on X speed
        if(aiPath.desiredVelocity.x >= 0.01f) // moving to the right
        {
            transform.localScale = new Vector3(-1f, 1f, 1f);
        }
        else if (aiPath.desiredVelocity.x <= -0.01f) // moving to the left
        {
            transform.localScale = new Vector3(1f, 1f, 1f);
        }
    }
}
