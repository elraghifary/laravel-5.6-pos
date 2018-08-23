<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['code', 'name', 'description', 'stock', 'price', 'category_id', 'photo'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
