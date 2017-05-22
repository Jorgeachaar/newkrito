<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PicCategoryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PicCategoryImageController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(PicCategoryImage $picCategoryImage)
    {
        //
    }

    public function edit(PicCategoryImage $picCategoryImage)
    {
        //
    }

    public function update(Request $request, PicCategoryImage $picCategoryImage)
    {
        $this->validate($request, [
            'position' => 'required|integer|min:0',
        ]);

        $picCategoryImage->position = $request->input('position');
        $picCategoryImage->save();

        return back();
    }

    public function destroy(PicCategoryImage $picCategoryImage)
    {
        if (isset($picCategoryImage->image) && !empty($picCategoryImage->image)) {

            $path = 'storage/pics/' . $picCategoryImage->pic_category_id . '/images/thumbnail/' . $picCategoryImage->image;

            if (File::exists($path)) {
                File::delete($path);
            }

            $path = 'storage/pics/' . $picCategoryImage->pic_category_id . '/images/' . $picCategoryImage->image;

            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $picCategoryImage->delete();
        return back();
    }
}
