<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function provinces()
    {
        return $this->hasMany(Province::class);
    }
}
