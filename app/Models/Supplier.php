<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['company_name', 'address', 'company_tel_no', 'email', 'contact_person_name', 'contact_person_mobile', 'contact_person_email'];

    public function purchaseOrders()
    {
        return $this->hasMany('App\Models\PurchaseOrder');
    }
}
