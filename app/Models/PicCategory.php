<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PicCategory extends Model
{
    protected $fillable = [
    	'title',
    	'description',
    	'pic_category_id',
    	'premiun',
    ];

    public function category()
    {
    	return $this->belongsTo(PicCategory::class, 'pic_category_id');
    }

    public function setPremiunAttribute($value)
    {
        $this->attributes['premiun'] = $value ? true : false;
    }
}
