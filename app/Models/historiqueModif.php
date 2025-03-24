<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class historiqueModif extends Model
{
    protected $fillable = [
        'ancienNomCavalier',
        'ancienNomCheval',
        'nouveauNomCavalier',
        'nouveauNomCheval',
        'couple_id'
    ];
}
