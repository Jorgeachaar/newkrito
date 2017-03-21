<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $list = ProductCategory::orderBy('position', 'ASC')->get();
        return view('admin.productCategory.list', compact('list'));
    }

    public function create()
    {
        return view('admin.productCategory.form');
    }

    public function store(Request $request)
    {
        $this->doValidate($request);

        $item = new ProductCategory;

        $item->fill($request->all());

        if ($request->file('image'))
            $item->image = $request->file('image')->store('product/category', 'public');

        if ($request->file('image2'))
            $item->image2 = $request->file('image2')->store('product/category', 'public');

        $maxPosition = ProductCategory::max('position');
        $item->position = $maxPosition ? ++$maxPosition : 1;

        $item->save();

        return $this->urlList();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();
        return $this->urlList();
    }

    public function doValidate(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:3',
            'image' => [
                'required',
                'image',
                // Rule::dimensions()->maxWidth(200)->maxHeight(200),
            // 'image' => 'required|image|dimensions:max_width=700,max_height=700',
            ],
            'image2' => [
                'required',
                'image',
                // Rule::dimensions()->maxWidth(200)->maxHeight(200),
            // 'image' => 'required|image|dimensions:max_width=700,max_height=700',
            ],
        ]);
    }

    public function urlList()
    {
        return redirect()->route('productCategory.index');        
    }
}
