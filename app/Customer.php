<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'phone'
    ];

    public function address()
    {
        return $this->hasOne('App\Address');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}