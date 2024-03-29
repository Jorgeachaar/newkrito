<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

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
        if($this->image)
            $this->deleteImage($this->image);
        $this->attributes['image'] = $value;
        //$this->saveThumbnail($value);        
    }

    public function setImage2Attribute($value)
    {
        if($this->image2)
            $this->deleteImage($this->image2);
        $this->attributes['image2'] = $value;
        //$this->saveThumbnail($value);        
    }

    public function getUrlThumbnailImageAttribute()
    {
        return asset('storage/pics/' . $this->id . '/thumbnail/' . $this->image);
    }

    public function getUrlImageAttribute()
    {
        return asset('storage/pics/' . $this->id . '/' . $this->image);
    }

    public function getUrlThumbnailImage2Attribute()
    {
        return asset('storage/pics/' . $this->id . '/thumbnail/' . $this->image2);
    }

    public function getUrlImage2Attribute()
    {
        return asset('storage/pics/' . $this->id . '/' . $this->image2);
    }

    public function saveThumbnail($value)
    {
        $url = 'storage/' . $value;

        $img = Image::make($url);
            
        $img->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $urlThumbnail = 'pic/category/thumbnail/' . $value;

        Storage::disk('public')->put($urlThumbnail, (string) $img->encode());
    }

    public function delete() 
    {
        $this->deleteImage($this->image);
        $this->deleteImage($this->image2);
        parent::delete();
    }

    public function deleteImage($value)
    {
        if (isset($value) && !empty($value)) {

            $path = 'storage/pics/' . $this->id . '/' . $value;

            if (File::exists($path)) {
                File::delete($path);
            }

            $path = 'storage/pics/' . $this->id . '/thumbnail/' . $value;

            if (File::exists($path)) {
                File::delete($path);
            }
        }
    }
}
