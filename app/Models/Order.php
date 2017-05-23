<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $fillable = [
		'user_id',
		'cart_paypal',
		'name',
		'email',
		'phone',
		'address',
		'subtotal'
	];  

    public function items()
    {
    	return $this->hasMany(OrderItem::class);
    }
}
