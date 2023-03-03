<?php

namespace App\Models\SiegeSystem;

use App\Models\Town;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainedUnit extends Model
{
    use HasFactory;

    protected $table = 'trained_units';
    protected $primaryKey = 'TrainingID';
    public $timestamps = false;

    protected $fillable = [
        'TownID',
        'UnitID',
        'UnitAmount'
    ];

    // KAPCSOLATOK
    public function town(){
        return $this->hasOne(Town::class, 'TownID', 'TownID');
    }

    public function unitType(){
        return $this->hasOne(Unit::class, 'UnitID', 'UnitID');
    }
}
