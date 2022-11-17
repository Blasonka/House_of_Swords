<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory;

    // tábla tulajdonságok
    protected $table = 'towns';
    protected $primaryKey = 'TownID';
    public $timestamps = true;
}
