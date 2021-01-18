<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'cep', 'street', 'number', 'district', 'city', 'uf', 'complement', 'customer_id'
    ];
}