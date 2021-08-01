<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $fillable = ['supplier_id', 'expected_on', 'inventory_id', 'comments', 'paid', 'remaining', 'total_amount', 'user_id', 'payment_type'];

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }

    public function inventory()
    {
        return $this->belongsTo('App\Models\Inventory');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function items()
    {
        return $this->belongsToMany('App\Models\Item', 'item_purchase_order', 'po_id')->withPivot('quantity', 'cost');
    }
}
