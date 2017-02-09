<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PicCategory;
use App\Models\PicCategoryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class PicCategoryController extends Controller
{

    public function index()
    {
        $list = PicCategory::all();
        return view('admin.PicCategories.list', compact('list'));
    }

    public function create()
    {
        $categories = $this->getCategoriesForCombo();
        return view('admin.PicCategories.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->doValidate($request);

        $category = new PicCategory;

        $category->fill($request->all());

        if ($request->file('image'))
            $category->image = $request->file('image')->store('pic/category', 'public');

        if ($request->file('image2'))
            $category->image2 = $request->file('image2')->store('pic/category', 'public');

        $category->save();

        return $this->urlList();
    }

    public function show(PicCategory $category)
    {
        return('piccategory.show');
    }

    public function edit(PicCategory $item)
    {
        $categories = $this->getCategoriesForCombo();
        return view('admin.PicCategories.form', compact('item', 'categories'));
    }

    public function update(Request $request, PicCategory $category)
    {
        $this->validate($request, [
            'description' => 'required|min:3',
            'title' => 'required|min:3',
            'pic_categories_id' => 'nullable|exists:pic_categories,id',
        ]);

        $category->fill($request->all());

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
        return redirect()->route('picCategories.index');        
    }

    public function getCategoriesForCombo()
    {
        $categories = PicCategory::pluck('title', 'id'); 
        $categories->prepend("(Ninguno)", "");
        return $categories;
    }

    public function listImage(PicCategory $category)
    {
        dd($category->images()->count());
        return view('admin.PicCategories.listImage', compact('category'));
    }

    public function storeImage(Request $request)
    {
        $this->validate($request,  [
            'pic_category_id' => 'required|exists:pic_categories,id',
            'image.*' => 'image|mimes:jpg,jpeg,png,bmp|max:20000'
        ]);

        $pic_category_id = $request->input('pic_category_id'); 
        $images = $request->file('image');

        if($images && (count($images)>0) )
        {
            foreach($images as $image) {

                $pic_image = new PicCategoryImage;

                $pic_image->fill($request->all());

                $pic_image->description = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);

                $pic_image->image = $image->store('images', 'public');
                
                $img = Image::make($image);
                
                $img->fit(180, 180, function ($constraint) {
                    $constraint->aspectRatio();
                });

                Storage::disk('public')->put('thumbnail/' . $pic_image->image, (string) $img->encode());

                $pic_image->save();

            }
        }

        return back();
    }

}
