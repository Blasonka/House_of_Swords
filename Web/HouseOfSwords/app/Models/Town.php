<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory;

    // tábla tulajdonságok
    protected $table = 'towns';
    protected $primaryKey = 'TownID';
    public $timestamps = false;

    protected $fillable = [
        'TownName',
        'HappinessValue',
        'Wood',
        'Stone',
        'Metal',
        'Gold',
        'CampaignLvl',
        'XCords',
        'YCords',
        'Users_UID'
    ];

    // KAPCSOLATOK
    public function user(){
        return $this->belongsTo(User::class, 'Users_UID', 'UID');
    }

    public function buildings(){
        return $this->hasMany(Building::class, 'Towns_TownID', 'TownID');
    }
}
