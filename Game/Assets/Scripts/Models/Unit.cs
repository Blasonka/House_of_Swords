[System.Serializable]
public class Unit
{
    public int UnitID;

    public string UnitName;
    public int UnitSize;

    public int AttackValue;
    public int DefenseValue;
    public int MobilityValue;

    public string TrainingTime;

    public int TrainingCostGold;
    public int TrainingCostFallen;
    public int ResearchCost;
}

[System.Serializable]
public class Units
{
    public Unit[] fetchedUnits;
}