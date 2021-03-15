<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = "Status";

    public function getStyle()
    {
        if ($this->id == 1) {
            return 'warning';
        } else if ($this->id == 2) {
            return 'success';
        } else {
            return 'danger';
        }
    }
}
