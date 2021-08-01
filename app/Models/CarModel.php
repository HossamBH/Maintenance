<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $fillable = ['name','brand_id'];

    public function car_brand()
    {
        return $this->belongsTo('App\Models\CarBrand','brand_id');
    }
    public function cars()
    {
        return $this->hasMany('App\Models\Car');
    }
}
