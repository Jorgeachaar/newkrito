<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
    	'facebook',
    	'twitter',
    	'instagram',
    	'wishlist',
    	'about',
    	'contact'
    ];

    public static function getSetting()
    {
    	return static::firstOrCreate(['id'=> 1], [
			'facebook' => 'https://www.facebook.com/kritosg',
	    	'twitter' => 'https://twitter.com/Krito_LoveXXX',
	    	'instagram' => 'https://instagram.com/kritolove/',
	    	'wishlist' => 'http://www.amazon.com/registry/wishlist/IWDI671UNZMU',
	    	'about' => "Hello, my name is Karolina Restrepo, I'm a colombian alternative model, living in Buenos Aires, Argentina. tattoo artist, designer and piercer. I want to share with you this space, my passion for art, for photography and design. Enjoy and welcome to my universe! KritoLove",
	    	'contact' => "Feel free to email us to provide some feedback , give us suggestions, or to just say hello!",
    	]);
    }


}
