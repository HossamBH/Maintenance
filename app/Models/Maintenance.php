<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $fillable = ['car_id', 'subtotal','taxes','total','entrance_date','delivery_date','duration'];
    
    public function car()
    {
        return $this->belongsTo('App\Models\Car','car_id');
    }
    public function services()
    {
        return $this->belongsToMany('App\Models\Service','maintenance_services','maintenance_id')->withPivot('entity','subtotal','total','taxes','quantity');
    }
}
