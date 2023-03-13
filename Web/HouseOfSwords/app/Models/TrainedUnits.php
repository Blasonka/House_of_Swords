<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainedUnits extends Model
{
    use HasFactory;

    // table properties
    protected $table = 'trained_units';
    protected $primaryKey = 'TrainingID';
    public $timestamps = false;

    protected $fillable = [
        'TownID',
        'UnitID ',
        'UnitAmount'
    ];
}
