<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $guarded=[];

    public function scopeActive($query)
    {
          return $query->where('status', 1);
    }
    public function scopeDeactive($query)
    {
          return $query->where('status', 0);
    }

    public function stores()
    {
        return $this->hasMany(\App\Store::class,"id");
    }
}
