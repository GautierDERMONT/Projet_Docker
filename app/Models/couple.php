<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class couple extends Model
{
    use HasFactory;

    protected $fillable = [
        'cavalier',
        'cheval',
        'coach',
        'ecurie',
        'temps',
        'penalite',
        'ordrePassage',
        'temps_total',
        'classement',
        'epreuve_id',
    ];
}
