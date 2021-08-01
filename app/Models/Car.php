<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['license_number', 'color', 'comments', 'year', 'motor_no', 'kms', 'type', 'user_id','model_id','customer_id'];

    public function car_model()
    {
        return $this->belongsTo('App\Models\CarModel','model_id');
    }
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function maintenances()
    {
        return $this->hasMany('App\Models\Maintenance');
    }


}
