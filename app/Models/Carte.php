<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carte extends Model
{
     use HasFactory;
     public $timestamps = false; 

     protected $fillable = [
        'client_id',
        'nom',
        'actif',
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }
}
