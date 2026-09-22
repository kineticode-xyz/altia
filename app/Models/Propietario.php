<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Propietario extends Model
{
    protected $table = 'propietarios';

    public function coches(): HasMany
    {
        return $this->hasMany(Coche::class);
    }
}