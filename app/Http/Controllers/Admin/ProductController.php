<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // return "$id";
    }

    public function create(Request $request)
    {
        $category = ProductCategory::findOrFail($request->input('id'));
        return view('admin.products.form', compact('category'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:3',
            'description' => 'required|min:3',
            'price' => 'required',
            'product_category_id' => 'required',
        ]);

        $item = new Product;

        $item->fill($request->all());

        $item->save();

        return redirect()->route('products.show', $request->input('product_category_id'));
    }

    public function show($id)
    {
        $category = ProductCategory::findOrFail($id);
        return view('admin.products.list', compact('category'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
