<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    	'title',
    	'description',
    	'price',
    	'product_category_id'
    ];

    public function Images()
    {
    	return $this->hasMany(ProductImage::class);
    }
}
