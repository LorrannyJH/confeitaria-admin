<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_product';

    protected $fillable = [
        'order_id', 'product_id', 'price', 'quantity'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    
    public function getPriceFormatted()
    {
        return number_format($this->price / 100, 2, ',', '.');
    }
}
