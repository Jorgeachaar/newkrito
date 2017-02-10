<?php

namespace App\Http\Controllers;

use App\Models\PicCategory;
use Illuminate\Http\Request;

class PicController extends Controller
{
    public function show(PicCategory $picCategory, $slug)
    {
    	if ($picCategory->slug != $slug) {
    		return redirect($picCategory->url, 301);
    	}

    	return view('pics.show', compact('picCategory'));
    }

    public function listCategory ($id) 
	{
		$Category = ImgCategory::find($id);
		return view('pics.list')->with('Category', $Category);
	}

	public function listImg($id)
	{
		$Album = ImgAlbum::find($id);
		return view('pics.listImg')->with('Album', $Album);
	}
}
