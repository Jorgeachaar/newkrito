<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;

class ImageController extends Controller
{
	public function index()
	{
		$marco = Image::make(public_path() . '/Krito/img/asd/marco.png');
		$mask  = Image::make(public_path() . '/Krito/img/asd/mask.png');
		$img   = Image::make(public_path() . '/Krito/img/logo.png');
		$img->resize(585, 539);



		$img->mask($mask, true);
		$img->insert($marco, 'center');
		//$marco->resizeCanvas(200, 200, 'center', false, array(255, 255, 255, 0));

		return $img->response('png');
	}
}
