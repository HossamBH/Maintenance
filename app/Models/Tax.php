<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $fillable = ['type_id', 'percentage'];

    public function type()
    {
        return $this->belongsTo('App\Models\TaxType');
    }
    public function categories()
    {
        return $this->hasMany('App\Models\Category');
    }
}
