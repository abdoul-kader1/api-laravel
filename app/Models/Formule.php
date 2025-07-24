<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formule extends Model
{
    use HasFactory;
    public $timestamps = false; 

     protected $fillable = [
        'type_formule',
        'prix',
    ];

    public function abonnement(){
        return $this->hasMany(Abonnement::class);
    }
}
