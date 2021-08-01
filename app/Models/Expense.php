<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['trans_id', 'total_amount', 'type_id', 'comments','file_attachment'];

    public function expense_type()
    {
        return $this->belongsTo('App\Models\ExpenseType','type_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
