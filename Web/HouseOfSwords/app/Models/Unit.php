<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    // table properties
    protected $table = 'unitstats';
    protected $primaryKey = 'UnitID';
    public $timestamps = false;

    protected $fillable = [
        "UnitName",
        "UnitSize",
        "AttackValue",
        "DefenseValue",
        "MobilityValue",
        "TrainingTime",
        "TrainingCostGold",
        "TrainingCostFallen",
        "ResearchCost"
    ];
}
