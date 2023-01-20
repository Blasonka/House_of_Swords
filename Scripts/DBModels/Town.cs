[System.Serializable]
public class Town
{
    public int TownID;
    public string TownName;
    public int HappinessValue;
    public int Wood;
    public int Stone;
    public int Metal;
    public int Gold;
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