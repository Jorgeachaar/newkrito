<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PicCategory extends Model
{
    protected $fillable = [
    	'title',
    	'description',
    	'pic_category_id',
    	'premium',
    ];

    public function category()
    {
    	return $this->belongsTo(PicCategory::class, 'pic_category_id');
    }

    public function categories()
    {
        return PicCategory::where('pic_category_id', $this->id)->get();
    }

    public function images()
    {
        return $this->hasMany(PicCategoryImage::class, 'pic_category_id')
            ->orderBy('position', 'ASC')
            ->orderBy('created_at', 'ASC');
    }

    public static function getMainCategory()
    {
        return static::where('pic_category_id', null)->get();
    }

    public function setPremiumAttribute($value)
    {
        $this->attributes['premium'] = $value ? true : false;
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getUrlAttribute()
    {
        return route('pic.category', [$this->id, $this->slug]);
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

        $img = Image::make($url);
            
        $img->fit(180, 180, function ($constraint) {
            $constraint->aspectRatio();
        });

        $img->fit(300);

        $urlThumbnail = 'pic/category/thumbnail/' . $value;

        Storage::disk('public')->put($urlThumbnail, (string) $img->encode());
    }
}
