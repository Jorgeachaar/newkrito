<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PicCategory;
use Illuminate\Http\Request;

class PicCategoryController extends Controller
{

    public function index()
    {
        $list = PicCategory::all();
        return view('admin.PicCategories.list', compact('list'));
    }

    public function create()
    {
        $categories = PicCategory::pluck('title', 'id'); 
        return view('admin.PicCategories.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->doValidate($request);

        $category = new PicCategory;

        $category->fill($request->all());

        $category->image = "asd";
        $category->image2 = "asd";

        $category->save();

        return $this->urlList();
    }

    public function show(PicCategory $category)
    {
        return('piccategory.show');
    }

    public function edit(PicCategory $item)
    {
        $categories = PicCategory::pluck('title', 'id'); 
        return view('admin.PicCategories.form', compact('item', 'categories'));
    }

    public function update(Request $request, PicCategory $category)
    {
        $this->doValidate($request);

        $category->fill($request->all());

        $category->image = "asd";
        $category->image2 = "asd";


        $category->save();

        return $this->urlList();
    }

    public function destroy(PicCategory $category)
    {
        $category->delete();
        return $this->urlList();
    }

    public function doValidate(Request $request)
    {
        $this->validate($request, [
            'description' => 'required|min:3',
            'title' => 'required|min:3',
            'pic_categories_id' => 'nullable|exists:pic_categories,id',
        ]);
    }

    public function urlList()
    {
        return redirect()->route('picCategories.index');        
    }
}
