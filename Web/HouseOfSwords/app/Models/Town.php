<?php

namespace App\Models;

use App\Models\SiegeSystem\Siege;
use App\Models\SiegeSystem\TrainedUnit;
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

    // SIEGE SYSTEM
    public function initiatedSieges(){
        return $this->hasMany(Siege::class, 'AttackerTownID', 'TownID');
    }

    public function incomingSieges(){
        return $this->hasMany(Siege::class, 'DefenderTownID', 'TownID');
    }

    public function trainedUnits(){
        return $this->hasMany(TrainedUnit::class, 'TownID', 'TownID');
    }
}
