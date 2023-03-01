<?php

namespace App\Models\SiegeSystem;

use App\Models\Town;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siege extends Model
{
    use HasFactory;

    protected $table = 'sieges';
    protected $primaryKey = 'SiegeID';
    public $timestamps = false;

    protected $fillable = [
        'AttackerTownID',
        'DefenderTownID',
        'SiegeTime',
        'LootPercentage',
        'AttackerWon'
    ];

    // KAPCSOLATOK
    // The two towns that are fighting.
    public function attacker(){
        return $this->hasOne(Town::class, 'TownID', 'AttackerTownID');
    }

    public function defender(){
        return $this->hasOne(Town::class, 'TownID', 'DefenderTownID');
    }

    // The units on the attacker side.
    public function attackerUnits(){
        return $this->hasMany(SiegingUnits::class, 'SiegeID', 'SiegeID');
    }
}
