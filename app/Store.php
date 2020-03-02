<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    public function user()
    {
        return $this->belongsTo(\App\User::class,"store_by");
    }
    public function supplier()
    {
        return $this->belongsTo(\App\Supplier::class,"supplier_id");
    }
}
