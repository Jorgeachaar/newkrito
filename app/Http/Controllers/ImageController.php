<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
	public function index()
	{
		$image = Image::make("laksdljas");
		return "se crea imagen";
	}
}
