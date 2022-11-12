<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    use HasFactory;

    // tábla tulajdonságok
    protected $table = 'users';
    protected $primaryKey = 'UID';
    public $timestamps = false;

    protected $fillable = ['Username', 'EmailAddress', 'PwdHash', 'PwdSalt'];

    // public function setPwdHashAttribute($value){
    //     $randomChar = chr(random_int(0, 25)+65);
    //     $this->attributes["PwdHash"] = hash('sha512', $value.$this->PwdHash.$value.$this->PwdSalt.$randomChar);
    // }
}
