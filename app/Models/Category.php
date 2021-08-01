<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'tax_id', 'user_id'];


    public function tax()
    {
        return $this->belongsTo('App\Models\Tax');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
    }
}
