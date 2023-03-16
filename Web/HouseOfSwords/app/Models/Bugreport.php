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
        'EmailAddress',
        'IsSolved',
        'Date'
    ];

    // KAPCSOLATOK
    public function user(){
        if ($this->EmailAddress != null) {
            return $this->hasOne(User::class, 'EmailAddress', 'EmailAddress');
        }

        return null;
    }
}
