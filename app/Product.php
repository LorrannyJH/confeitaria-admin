<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'price', 'description', 'photo', 'price_by_weight'
    ];

    public function getPriceFormatted()
    {
        return number_format($this->price / 100, 2, ',', '.');
    }
}
