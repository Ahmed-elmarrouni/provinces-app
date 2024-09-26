<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }


}
