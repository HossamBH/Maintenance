<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'serial_number', 'description', 'price', 'taxed_price', 'active', 'unit', 'user_id'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
    }

    public function inventories()
    {
        return $this->belongsToMany('App\Models\Inventory');
    }

    public function salesOrders()
    {
        return $this->belongsToMany('App\Models\SalesOrder')->withPivot('quantity');
    }

    public function purchaseOrders()
    {
        return $this->belongsToMany('App\Models\PurchaseOrder');
    }
    public function maintenances()
    {
        return $this->belongsToMany('App\Models\Maintenance','maintenance_services','entity_id')->withPivot('entity','subtotal','total','taxes','quantity');
    }
}
