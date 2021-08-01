<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['entity_id', 'amount', 'payment_type', 'status', 'type'];
}
