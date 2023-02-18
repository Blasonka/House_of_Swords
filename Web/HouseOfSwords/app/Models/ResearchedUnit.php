<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchedUnit extends Model
{
    use HasFactory;

    // table options
    protected $table = 'researchedunits';
    protected $primaryKey = 'ResearchID';
    public $timestamps = false;

    protected $fillable = [
        'ResearchBuildingID',
        'UnitID'
    ];
}
