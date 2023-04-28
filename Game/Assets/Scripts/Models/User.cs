[System.Serializable]
public class User
{
    public int UID;

    public string Username;
    public string EmailAddress;
    public string PwdHash;
    public string PwdSalt;

    public int Role;
    public bool IsEmailVerified;

    public string EmailVerificationToken;
    public string GameSessionToken;

    public string LastOnline;
    public string ProfileImageUrl;
}