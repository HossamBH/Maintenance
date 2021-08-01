<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['po_id', 'paid', 'remaining', 'file_attachment', 'comments', 'user_id', 'payment_type'];

    public function purchaseOrder()
    {
        return $this->belongsTo('App\Models\PurchaseOrder', 'po_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
