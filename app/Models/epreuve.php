<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class epreuve extends Model
{
    use HasFactory;

    public function concours(): BelongsTo
    {
        return $this->belongsTo(concours::class);
    }

    public function couples(): HasMany
    {
        return $this->hasMany(couple::class);
    }
}
