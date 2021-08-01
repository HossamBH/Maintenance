<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['name', 'job_id', 'salary', 'start_date'];

    public function job()
    {
        return $this->belongsTo('App\Models\Job');
    }

    public function inventories()
    {
        return $this->hasMany('App\Models\Inventory');
    }

    public function salaries()
    {
        return $this->hasMany('App\Models\Salary');
    }
}
