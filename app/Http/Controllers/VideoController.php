<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function show()
    {
    	$videos = Video::orderBy('position', 'ASC')->get();
    	return view('videos.show', compact('videos'));
    }
}
