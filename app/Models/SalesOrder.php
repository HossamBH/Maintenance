<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $fillable = ['customer_id', 'sub_total_amount', 'total_taxes', 'total_amount', 'user_id'];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function items()
    {
        return $this->belongsToMany('App\Models\Item','item_sales_order', 'so_id')->withPivot('quantity');
    }
}
