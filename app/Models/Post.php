<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = [
		'title',
		'content'
	];

	public function setTitleAttribute($value)
	{
		$this->attributes['title'] = $value;

		$this->attributes['slug'] = str_slug($value);
	}

	public function images()
    {
    	return $this->hasMany(PostImage::class);
    }
}
