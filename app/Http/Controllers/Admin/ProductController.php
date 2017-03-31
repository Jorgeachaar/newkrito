<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Storage;

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

    public function edit(Product $product)
    {
        $item = $product;
        $category = ProductCategory::findOrFail($product->product_category_id);
        return view('admin.products.form', compact('item', 'category'));
    }

    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'title' => 'required|min:3',
            'description' => 'required|min:3',
            'price' => 'required',
            'product_category_id' => 'required',
        ]);

        $product->fill($request->all());

        $product->save();

        return redirect()->route('products.show', $request->input('product_category_id'));
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back();
    }

    public function AddImages(Product $product)
    {
        return view('admin.products.listImage', compact('product'));
    }

    public function StoreImages(Request $request, Product $product)
    {
        $maxPosition = ProductImage::max('position');
        $maxPosition = $maxPosition ? ++$maxPosition : 1;

        $this->validate($request,  [
            'image.*' => 'image|mimes:jpg,jpeg,png,bmp|max:20000'
        ]);

        $images = $request->file('image');

        if($images && (count($images)>0) )
        {
            foreach($images as $image) {

                $pic_image = new ProductImage;

                $pic_image->product_id = $product->id;
                $pic_image->position = $maxPosition++;

                $pic_image->description = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);

                $pic_image->image = $image->store('product/images', 'public');
                
                $img = Image::make($image);
                
                $img->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                });

                Storage::disk('public')->put('product/images/thumbnail/' . $pic_image->image, (string) $img->encode());

                $img->resize(100, null, function ($constraint) {
                    $constraint->aspectRatio();
                });

                Storage::disk('public')->put('product/images/thumbnail/small' . $pic_image->image, (string) $img->encode());

                $pic_image->save();

            }
        }

        return back();
    }
}
