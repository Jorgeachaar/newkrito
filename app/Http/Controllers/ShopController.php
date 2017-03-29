<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function show()
    {
    	$categories = ProductCategory::all();
        return view('shop.index', compact('categories'));
    }

    public function list_category($category_id)
    {
    	$category = ProductCategory::findOrFail($category_id);
        return view('shop.list', compact('category'));
    }
}
