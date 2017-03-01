<?php

namespace App\Http\Controllers\Admin;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    public function index()
    {
        $list = Video::orderBy('position', 'ASC')->get();
        return view('admin.videos.list', compact('list'));
    }

    public function create()
    {
        return view('admin.videos.form');
    }

    public function store(Request $request)
    {
        $this->doValidate($request);

        $item = new Video;

        $item->fill($request->all());

        $maxPosition = Video::max('position');
        $item->position = $maxPosition ? ++$maxPosition : 1;

        $item->save();

        return $this->urlList();
    }

    public function show(Video $video)
    {
        //
    }

    public function edit(Video $video)
    {
        $item = $video;
        return view('admin.videos.form', compact('item'));
    }

    public function update(Request $request, Video $video)
    {
        $this->doValidate($request);

        $video->fill($request->all());

        $video->position = $request->input('position');

        $video->save();

        return $this->urlList();
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return $this->urlList();
    }

    public function doValidate(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:3',
            'url' => 'required',
        ]);
    }

    public function urlList()
    {
        return redirect()->route('videos.index');        
    }
}
