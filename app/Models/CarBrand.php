<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarBrand extends Model
{
    protected $fillable = ['name'];

    public function car_models()
    {
        return $this->hasMany('App\Models\CarModel');
    }
}