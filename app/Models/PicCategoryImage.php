<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PicCategoryImage extends Model
{
	protected $fillable = [
		'description',
		'image',
		'pic_category_id'
	];

    // public function category()
    // {
    // 	return $this->belongsTo(PicCategory::class, 'pic_category_id');
    // }

    public function getUrlThumbnailImageAttribute()
    {
        return asset('storage/pics/' . $this->pic_category_id . '/images/thumbnail/' . $this->image);
    }

    public function getUrlImageAttribute()
    {
        return asset('storage/pics/' . $this->pic_category_id . '/images/' . $this->image);
    }
}
