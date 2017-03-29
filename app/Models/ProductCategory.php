<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ProductCategory extends Model
{
    protected $fillable = [
        'title',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
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
        return asset('storage/product/category/thumbnail/' . $this->image);
    }

    public function getUrlImageAttribute()
    {
        return asset('storage/' . $this->image);
    }

    public function getUrlThumbnailImage2Attribute()
    {
        return asset('storage/product/category/thumbnail/' . $this->image2);
    }

    public function getUrlImage2Attribute()
    {
        return asset('storage/' . $this->image2);
    }

    public function saveThumbnail($value)
    {
        $url = 'storage/' . $value;

        $img = Image::make($url);
            
        $img->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $urlThumbnail = 'product/category/thumbnail/' . $value;

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

            $path = 'storage/' . $value;

            if (File::exists($path)) {
                File::delete($path);
            }

            $path = 'storage/product/category/thumbnail/' . $value;

            if (File::exists($path)) {
                File::delete($path);
            }
        }
    }
}
