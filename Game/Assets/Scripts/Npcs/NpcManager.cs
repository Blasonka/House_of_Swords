using System.Collections;
using System.Collections.Generic;
using System;
using UnityEngine;
using Pathfinding;

public class NpcManager : MonoBehaviour
{
    public int minWaitBeforeNewNpc = 1;
    public int maxWaitBeforeNewNpc = 5;

    public GameObject npcPrefab;

    public List<Sprite> npcSprites = new List<Sprite>();
    Transform[] npcSpawnPoints;

    private void Start()
    {
        // Spawnpointok megkeresése és a spawnolás indítása
        npcSpawnPoints = GameObject.Find("SpawnPoints").GetComponentsInChildren<Transform>();

        StartCoroutine(SpawnerCoroutine());
    }

    void SpawnNpc()
    {
        // Random kiindulási és érkezési hely választása
        System.Random r = new System.Random();
        Transform spawn = npcSpawnPoints[r.Next(0, npcSpawnPoints.Length)];
        Transform destination;

        do
        {
            destination = npcSpawnPoints[r.Next(0, npcSpawnPoints.Length)];
        }
        while (spawn.name == destination.name);

        // Az NPC létrehozása és tulajdonságainak beállítása
        GameObject npc = GameObject.Instantiate(npcPrefab, transform);

        npc.transform.position = new Vector3(spawn.position.x, spawn.position.y, -8);
        npc.GetComponent<AIDestinationSetter>().target = destination;

        npc.GetComponentInChildren<SpriteRenderer>().sprite = npcSprites[r.Next(0, npcSprites.Count)];
    }

    IEnumerator SpawnerCoroutine()
    {
        // Az NPC-k létrehozása random időközönként
        SpawnNpc();

        System.Random r = new System.Random();
        yield return new WaitForSeconds(r.Next(minWaitBeforeNewNpc, maxWaitBeforeNewNpc));

        StartCoroutine(SpawnerCoroutine());
    }
}
