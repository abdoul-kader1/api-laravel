<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
  use HasFactory;
  
    protected $fillable = [
        'nom',
        'age',
        'taille',
    ];

    public function carte(){
        return $this->hasMany(Carte::class);
    }

    public function abonnement(){
        return $this->hasMany(Abonnement::class);
    }
}
