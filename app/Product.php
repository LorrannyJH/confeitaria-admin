<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'price', 'description', 'photo', 'unit_type', 'pack_quantity'
    ];

    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct');
    }

    public function getPriceFormattedAttribute()
    {
        return number_format($this->price / 100, 2, ',', '.');
    }

    public function getUnitTypeLabelAttribute()
    {
        if ($this->unit_type == 'unit') {
            return 'Unidade';
        } else if ($this->unit_type == 'kg') {
            return 'Quilo';
        } else {
            return 'Pacote ('.$this->pack_quantity.')';
        }
    }

    public function setPriceAttribute($value)
    {
        $value = str_replace(',', '.', str_replace('.', '', $value));
        $this->attributes['price'] = $value * 100;
    }
}
