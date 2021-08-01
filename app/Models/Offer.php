<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = ['category_id', 'item_id', 'price_after_discount', 'discount_type', 'discount_value'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }
}
