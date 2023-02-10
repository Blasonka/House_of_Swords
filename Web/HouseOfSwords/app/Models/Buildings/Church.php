<?php

namespace App\Models\Buildings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    use HasFactory;

    // table properties
    protected $table = 'churchstats';
    protected $primaryKey = 'Lvl';
    public $timestamps = false;

    protected $fillable = [
        'MassLength',
        'HappinessBoost'
    ];
}
