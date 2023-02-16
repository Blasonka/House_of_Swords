<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bugreport extends Model
{
    use HasFactory;

    // table properties
    protected $table = 'bugreports';
    protected $primaryKey = 'Id';
    public $timestamps = false;

    protected $fillable = [
        'Text',
        'IsSolved'
    ];
}
