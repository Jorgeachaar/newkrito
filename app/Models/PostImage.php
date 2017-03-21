<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    protected $fillable = [
		'description',
		'image',
		'post_id'
	];

	public function getUrlThumbnailImageAttribute()
    {
        return asset('storage/post/images/thumbnail/' . $this->image);
    }

    public function getUrlImageAttribute()
    {
        return asset('storage/' . $this->image);
    }
}
