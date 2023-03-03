<?php

namespace App\Models;

use App\Models\Buildings\Church;
use App\Models\Buildings\Research;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    // ÉPÜLETTÍPUSNAK ÉS OSZTÁLYÁNAK SZÓTÁRA
    private $typeClass = [
        'Barrack' => Church::class,
        'Church' => Church::class,
        'Research' => Research::class,
        'Warehouse' => Church::class,
        'Infirmary' => Church::class,
        'Diplomacy' => Church::class,
        'Market' => Church::class
    ];

    // TÁBLA TULAJDONSÁGOK
    protected $table = 'buildings';
    protected $primaryKey = 'BuildingID';
    public $timestamps = false;

    protected $fillable = [
        'Towns_TownID',
        'BuildingType',
        'BuildingLvl',
        'lastMassDate',
        'lastCureDate',
        'currentCure',
        'injuredUnits',
        'healedUnits'
    ];

    // KAPCSOLATOK
    public function town(){
        return $this->belongsTo(Town::class, 'Towns_TownID', 'TownID');
    }

    public function levelStats(){
        return $this->hasOne($this->typeClass[$this->BuildingType], 'Lvl', 'BuildingLvl');
    }
}
