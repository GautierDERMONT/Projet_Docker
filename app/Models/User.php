<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Ajouter 'nom' dans le tableau $fillable
    protected $fillable = [
        'login',
        'password',
        'role',
        'nom',  // Ajouter le champ 'nom' ici
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Ajouté pour que Laravel utilise le champ "login" au lieu de "email"
    public function getAuthIdentifierName()
    {
        return 'login';
    }
}
