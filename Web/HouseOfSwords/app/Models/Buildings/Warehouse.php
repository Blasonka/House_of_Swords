<?php

namespace App\Models\Buildings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    // table properties
    protected $table = 'levelstats_warehouse';
    protected $primaryKey = 'Lvl';
    public $timestamps = false;

    protected $fillable = [
        'MaxBrigadeCount',
        'WoodCollectionPM',
        'StoneCollectionPM',
        'MetalCollectionPM',
        'GoldCollectionPM'
    ];
}
