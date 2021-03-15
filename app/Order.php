<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Order extends Model
{
    protected $fillable = [
        'customer_id', 'delivery_date', 'status_id'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function getTotal()
    {  
        $total = 0;

        foreach($this->orderProducts as $orderProduct) {
            $productUnitType = $orderProduct->product->unit_type;

            if ($productUnitType == 'unit' || $productUnitType == 'pack') {
                $total += $orderProduct->price * $orderProduct->quantity;
            } else {
                $total += ($orderProduct->price * $orderProduct->kg) * $orderProduct->quantity;
            }
        }

        return $total;
    }

    public function getTotalFormatted()
    {
        return number_format($this->getTotal() / 100, 2, ',', '.');
    }

    public function getDeliveryDateAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i');
    }

    public function setDeliveryDateAttribute($value)
    {
        $this->attributes['delivery_date'] =
            Carbon::createFromFormat('d/m/Y H:i', $value)->format('Y-m-d H:i:s');
    }
}
