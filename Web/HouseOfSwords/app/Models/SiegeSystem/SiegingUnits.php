<?php

namespace App\Models\SiegeSystem;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiegingUnits extends Model
{
    use HasFactory;

    protected $table = 'sieging_units';
    protected $primaryKey = 'SiegingUnitID';
    public $timestamps = false;

    protected $fillable = [
        'SiegeID',
        'UnitID',
        'UnitAmount'
    ];

    // KAPCSOLATOK
    // The siege these units are attacking in.
    public function siege(){
        return $this->hasOne(Siege::class, 'SiegeID', 'SiegeID');
    }

    // The type of units that are attacking in the siege.
    // Usually used together with the UnitAmount field.
    public function unitType(){
        return $this->hasOne(Unit::class, 'UnitID', 'UnitID');
    }
}
