using System;
using System.Collections;
using System.Collections.Generic;
using System.Data.SqlTypes;
using System.Runtime.Serialization;
using UnityEngine;

[System.Serializable]
public class UserClass
{
    public int UID;
    public string Username;
    public string EmailAddress;
    public string PwdHash;
    public string LastLoginDate;
}

[System.Serializable]
public class Users
{
    public UserClass[] requestedUsers;
}