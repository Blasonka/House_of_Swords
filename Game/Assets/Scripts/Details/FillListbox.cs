using UnityEngine;

public class FillListbox : MonoBehaviour
{
    // Start is called before the first frame update
    void Start()
    {
        GameObject FightLabelTemplate = transform.GetChild(0).gameObject;
        GameObject g;
        for (int i = 0; i < 10; i++)
        {
            g = Instantiate(FightLabelTemplate, transform);
        }
        Destroy(FightLabelTemplate);

    }
       
}
