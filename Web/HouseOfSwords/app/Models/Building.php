<?php

namespace App\Models;

use App\Models\Buildings\Church;
use App\Models\Buildings\Infirmary;
use App\Models\Buildings\Research;
use App\Models\Buildings\Warehouse;
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
        'Warehouse' => Warehouse::class,
        'Infirmary' => Infirmary::class,
        'Diplomacy' => Church::class,
        'Market' => Church::class
    ];

    // TÁBLA TULAJDONSÁGOK
    protected $table = 'buildings';
    protected $primaryKey = 'BuildingID';
    public $timestamps = false;

    protected $fillable = [
        // BASIC FIELDS
        'Towns_TownID',
        'BuildingType',
        'BuildingLvl',

        // PARAMETERS THAT DEPEND ON THE BUILDING'S TYPE
        // BARRACK
        'LastTrainingDate',
        'TrainedUnitID',
        'TrainedAmount',

        // RESEARCH
        'currentScience',
        'storedScience',

        // CHURCH
        'lastMassDate',

        // INFIRMARY
        'lastCureDate',
        'currentCure',
        'injuredUnits',
        'healedUnits',

        // WAREHOUSE
        'BrigadeInWood',
        'BrigadeInStone',
        'BrigadeInMetal',
        'BrigadeInGold',
        'BrigadeInWarehouse'
    ];

    // KAPCSOLATOK
    public function town(){
        return $this->belongsTo(Town::class, 'Towns_TownID', 'TownID');
    }

    public function levelStats(){
        return $this->hasOne($this->typeClass[$this->BuildingType], 'Lvl', 'BuildingLvl');
    }
}
