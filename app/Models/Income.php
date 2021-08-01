<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = ['trans_id', 'total_amount', 'type_id', 'comments'];

    public function income_type()
    {
        return $this->belongsTo('App\Models\IncomeType');
    }
}
