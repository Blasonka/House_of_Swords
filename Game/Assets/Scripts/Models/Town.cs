[System.Serializable]
public class Town
{
    public int TownID;
    public string TownName;
    public int HappinessValue;
    public double Wood;
    public double Stone;
    public double Metal;
    public double Gold;
    public int CampaignLvl;
    public int XCords;
    public int YCords;
    public int Users_UID;

}

[System.Serializable]
public class Towns
{
    public Town[] fetchedTowns;
}