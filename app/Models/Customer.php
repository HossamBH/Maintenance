<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'mobile', 'city_id', 'area_id', 'email', 'address'];

    public function area()
    {
        return $this->belongsTo('App\Models\Area');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function salesOrders()
    {
        return $this->hasMany('App\Models\SalesOrder');
    }
    public function cars()
    {
        return $this->hasMany('App\Models\Car');
    }
}
