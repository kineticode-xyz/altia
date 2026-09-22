<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Coche extends Model
{
    protected $table = 'coches';

    public function propietario(): BelongsTo
    {
        return $this->belongsTo(Propietario::class);
    }
}