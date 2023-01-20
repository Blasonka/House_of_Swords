using System;
using System.Collections;
using System.Collections.Generic;
using System.Data.SqlTypes;
using System.Runtime.Serialization;
using UnityEngine;

[System.Serializable]
public class User
{
    public int UID;
    public string Username;
    public string EmailAddress;
    public string PwdHash;
    public string PwdSalt;
    public string LastLoginDate;
}