<?php

namespace App\Http\Controllers\Admin;

use App\Models\PicCategoryImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $picCategoryImage->delete();
        return back();
    }
}
