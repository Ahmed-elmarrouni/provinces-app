<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function provinces()
    {
        return $this->hasMany(Province::class);
    }


    public function employees()
    {
        return $this->hasManyThrough(Employee::class, Province::class);
    }
}
