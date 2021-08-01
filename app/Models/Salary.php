<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = ['emp_id', 'month', 'salary_date', 'bonus', 'deduction', 'total', 'comments', 'user_id'];

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee', 'emp_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
