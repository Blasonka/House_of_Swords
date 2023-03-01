<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    // Tábla tulajdonságok
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

    // KAPCSOLATOK
    public function towns() {
        return $this->hasMany(Town::class, 'Users_UID', 'UID');
    }

    public function friends(){
        return $this->belongsToMany(User::class, 'friendlist', 'FriendID', 'Users_UID');
    }

    public function bugreports(){
        return $this->hasMany(Bugreport::class, 'EmailAddress', 'EmailAddress');
    }
}
