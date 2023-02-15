<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    // tábla tulajdonságok
    protected $table = 'users';
    protected $primaryKey = 'UID';
    public $timestamps = false;

    protected $fillable = [
        'Username',
        'EmailAddress',
        'IsEmailVerified',
        'PwdHash',
        'PwdSalt',
        'Role',
        'EmailVerificationToken',
    ];
}
