<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = ['name_en', 'name_ar', 'city_id'];


    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function customers()
    {
        return $this->hasMany('App\Models\Customer');
    }
}
