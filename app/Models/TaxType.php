<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxType extends Model
{
    protected $fillable = ['name'];

    public function taxes()
    {
        return $this->hasMany('App\Models\Tax');
    }
}
