<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name_en', 'name_ar'];


    public function areas()
    {
        return $this->hasMany('App\Models\Area');
    }

    public function customers()
    {
        return $this->hasMany('App\Models\Customer');
    }
}
