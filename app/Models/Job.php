<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = ['position'];

    public function employees()
    {
        return $this->hasMany('App\Models\Employee');
    }
}
