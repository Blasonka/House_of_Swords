<?php

namespace App\Models\Buildings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diplomacy extends Model
{
    use HasFactory;

    // table properties
    protected $table = 'levelstats_diplomacy';
    protected $primaryKey = 'Lvl';
    public $timestamps = false;
}
