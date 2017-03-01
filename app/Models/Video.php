<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
    	'title',
    	'url',
    	'premium'
    ];

    public function setPremiumAttribute($value)
    {
        $this->attributes['premium'] = $value ? true : false;
    }
}
