<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;

class ImageController extends Controller
{
	public function index()
	{
		return view('image');
	}

	public function store(Request $request)
	{
		$marco = Image::make(public_path() . '/Krito/img/asd/marco.png');
		$mask  = Image::make(public_path() . '/Krito/img/asd/mask.png');
		$img   = Image::make($request->file('image'));
		
		$img->fit(442, 473);

		$img->mask($mask, true);
		$img->insert($marco, 'center');		

		return $img->response('png');
	}

	public function store2(Request $request)
	{
		// C:\Users\Ercilia\Desktop\Fotos de Henry\img\tattoos\henry\FullColor
		$border_type = $request->input('border_type');
		$canva = $img = Image::canvas(442, 473); //'#4318EE'
		if ($border_type == "1") {
			$marco = Image::make(public_path() . '/Krito/img/asd/marco.png');
		} else {
			$marco = Image::make(public_path() . '/Krito/img/asd/marco2.png');
		}
		$mask  = Image::make(public_path() . '/Krito/img/asd/mask2.png');
		$img   = Image::make($request->file('image'));
		
		$img->fit(312, 316);
		$img->mask($mask, true);

		$canva->insert($img, 'top-left', 67, 114);
		$canva->insert($marco, 'center');

		return $canva->response('png');
	}
}
