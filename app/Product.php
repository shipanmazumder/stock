<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
    {
        return $this->belongsTo(\App\Category::class);
    }
    public function scopeActive($query)
    {
          return $query->where('status', 1);
    }
    public function scopeDeactive($query)
    {
          return $query->where('status', 0);
    }
}
