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
        $list = PicCategory::orderBy('position', 'ASC')->get();
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

        $item = new PicCategory;

        $item->fill($request->all());

        if ($request->file('image'))
            $item->image = $request->file('image')->store('pic/category', 'public');

        if ($request->file('image2'))
            $item->image2 = $request->file('image2')->store('pic/category', 'public');

        $maxPosition = PicCategory::max('position');
        $item->position = $maxPosition ? ++$maxPosition : 1;

        $item->save();

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
            'position' => 'required|integer',
        ]);

        if ($request->file('image'))
        {
            $this->validate($request, [
                'image' => 'image|mimes:jpg,jpeg,png,bmp|max:20000'
            ]);
            $category->image = $request->file('image')->store('pic/category', 'public');
        }

        if ($request->file('image2'))
        {
            $this->validate($request, [
                'image2' => 'image|mimes:jpg,jpeg,png,bmp|max:20000'
            ]);
            $category->image2 = $request->file('image2')->store('pic/category', 'public');
        }

        $category->fill($request->all());

        $category->position = $request->input('position');

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
        return view('admin.PicCategories.listImage', compact('category'));
    }

    public function storeImage(Request $request)
    {
        $maxPosition = PicCategoryImage::max('position');
        $maxPosition = $maxPosition ? ++$maxPosition : 1;

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
                $pic_image->position = $maxPosition++;

                $pic_image->description = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);

                $pic_image->image = $image->store('pic/images', 'public');
                
                $img = Image::make($image);
                
                $img->fit(180, 180, function ($constraint) {
                    $constraint->aspectRatio();
                });

                Storage::disk('public')->put('pic/images/thumbnail/' . $pic_image->image, (string) $img->encode());

                $pic_image->save();

            }
        }

        return back();
    }

}
