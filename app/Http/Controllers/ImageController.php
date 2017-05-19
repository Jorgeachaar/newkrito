<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;

class ImageController extends Controller
{
	public function index()
	{
		$marco = Image::make(public_path() . '/Krito/img/marco1.png');
		// $img   = Image::make(public_path() . '/Krito/img/logo.png');
		// $img2  = Image::make(public_path() . '/Krito/img/background/contact.jpg');
		// $img->crop(250, 350);
		// $marco->insert($img, 'center');

		// $thumbnail = $img->thumbnail(
  //           $this->size,
  //           Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND
  //       );

  //       return $thumbnail->response('png');
		// return $marco->response('png');
		// return "se crea imagen";

		$img = Image::canvas(300, 200, '#ddd');

		// draw a filled blue circle
		$img->circle(100, 50, 50, function ($draw) {
		    $draw->background('#0000ff');
		});

		// draw a filled blue circle with red border
		$img->circle(10, 100, 100, function ($draw) use $marco {
		    $draw->background($marco);
		    $draw->border(1, '#f00');
		});

		// draw an empty circle with 5px border
		$img->circle(70, 150, 100, function ($draw) {
		    $draw->border(5, '000000');
		});

		return $img->response('png');
	}
}
