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
		$canva = $img = Image::canvas(442, 473); //'#4318EE'
		$marco = Image::make(public_path() . '/Krito/img/asd/marco.png');
		$mask  = Image::make(public_path() . '/Krito/img/asd/mask2.png');
		// $img   = Image::make(public_path() . '/Krito/img/logo.png');
		$img   = Image::make($request->file('image'));
		
		$img->fit(312, 316);
		$img->mask($mask, true);

		$canva->insert($img, 'top-left', 67, 114);
		$canva->insert($marco, 'center');

		return $canva->response('png');
	}
}
