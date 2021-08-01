<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'cost','tax'];

    public function maintenances()
    {
        return $this->belongsToMany('App\Models\Maintenance','maintenance_services','maintenance_id','entity_id')->withPivot('entity','subtotal','total','taxes','quantity');
    }
}
