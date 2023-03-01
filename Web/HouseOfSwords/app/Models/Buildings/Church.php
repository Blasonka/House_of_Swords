<?php

namespace App\Models\Buildings;

use App\Models\Building;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    use HasFactory;

    // TÁBLA TULAJDONSÁGOK
    protected $table = 'levelstats_church';
    protected $primaryKey = 'Lvl';
    public $timestamps = false;

    protected $fillable = [
        'MassLength',
        'HappinessBoost'
    ];

}
