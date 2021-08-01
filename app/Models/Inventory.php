<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = ['address', 'tel_no', 'emp_id'];

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee','emp_id');
    }

    public function purchaseOrders()
    {
        return $this->hasMany('App\Models\PurchaseOrder');
    }

    public function items()
    {
        return $this->belongsToMany('App\Models\Item');
    }
}
