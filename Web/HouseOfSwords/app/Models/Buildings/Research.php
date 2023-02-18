<?php

namespace App\Models\Buildings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    use HasFactory;

    protected $table = 'researchstats';
    protected $primaryKey = 'Lvl';
    public $timestamps = false;

    protected $fillable = [
        'SciencePM',
        'MaxScience'
    ];
}
