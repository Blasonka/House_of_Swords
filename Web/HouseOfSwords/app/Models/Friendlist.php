<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendlist extends Model
{
    use HasFactory;

    // tábla tulajdonságok
    protected $table = 'friendlist';
    protected $primaryKey = 'RelationID';
    public $timestamps = false;

    protected $fillable = [
        'RelationID',
        'Users_UID',
        'FriendID',
        'isConfirmed'
    ];

    // kapcsolatok
    public function FriendUser(){
        return $this->hasOne(User::class, 'UID', 'FriendID');
    }
    public function User(){
        return $this->hasOne(User::class, 'UID', 'Users_UID');
    }
}
