<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function catigories()
    {
        return $this->hasMany('App\Models\Category');
    }

    public function items()
    {
        return $this->hasMany('App\Models\Item');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

    public function purchaseOrders()
    {
        return $this->hasMany('App\Models\PurchaseOrder');
    }

    public function salaries()
    {
        return $this->hasMany('App\Models\Salary');
    }

    public function salesOrders()
    {
        return $this->hasMany('App\Models\SalesOrder');
    }

    public function expenses()
    {
        return $this->hasMany('App\Models\Expense');
    }
    public function cars()
    {
        return $this->hasMany('App\Models\Car');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */

    public function getJWTCustomClaims()
    {
        return [];
    }
}
