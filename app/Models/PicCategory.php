<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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

    public function images()
    {
        return $this->hasMany(PicCategory::class, 'pic_category_id');
    }

    public function setPremiunAttribute($value)
    {
        $this->attributes['premiun'] = $value ? true : false;
    }

    public function setImageAttribute($value)
    {
        $this->attributes['image'] = $value;
        $this->saveThumbnail($value);        
    }

    public function setImage2Attribute($value)
    {
        $this->attributes['image2'] = $value;
        $this->saveThumbnail($value);        
    }


    public function getUrlThumbnailImageAttribute()
    {
        return asset('storage/pic/category/thumbnail/' . $this->image);
    }

    public function getUrlImageAttribute()
    {
        return asset('storage/' . $this->image);
    }

    public function getUrlThumbnailImage2Attribute()
    {
        return asset('storage/pic/category/thumbnail/' . $this->image2);
    }

    public function getUrlImage2Attribute()
    {
        return asset('storage/' . $this->image2);
    }

    public function saveThumbnail($value)
    {
        $url = 'storage/' . $value;

        Image::make($url);

        $img = Image::make($url);
            
        $img->fit(180, 180, function ($constraint) {
            $constraint->aspectRatio();
        });

        $urlThumbnail = 'pic/category/thumbnail/' . $value;

        Storage::disk('public')->put($urlThumbnail, (string) $img->encode());
    }
}
