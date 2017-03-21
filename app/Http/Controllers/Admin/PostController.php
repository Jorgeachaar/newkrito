<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $list = Post::orderBy('created_at', 'ASC')->get();
        return view('admin.posts.list', compact('list'));
    }

    public function create()
    {
        return view('admin.posts.form');
    }

    public function store(Request $request)
    {
        $this->doValidate($request);

        $item = new Post;

        $item->fill($request->all());

        $item->save();

        return $this->urlList();
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        $item = $post;
        return view('admin.posts.form', compact('item'));
    }

    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required|unique:posts,title,'. $post->id,
            'content' => 'required',
        ]);

        $post->fill($request->all());

        $post->save();

        return $this->urlList();
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return $this->urlList();
    }

    public function doValidate(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:posts',
            'content' => 'required',
        ]);
    }

    public function urlList()
    {
        return redirect()->route('posts.index');        
    }

    public function listImage(Post $post)
    {
        return view('admin.posts.listImage', compact('post'));
    }

    public function storeImage(Request $request)
    {
        $maxPosition = PostImage::max('position');
        $maxPosition = $maxPosition ? ++$maxPosition : 1;

        $this->validate($request,  [
            'post_id' => 'required|exists:posts,id',
            'image.*' => 'image|mimes:jpg,jpeg,png,bmp|max:20000'
        ]);

        $post_id = $request->input('post_id'); 
        $images = $request->file('image');

        if($images && (count($images)>0) )
        {
            foreach($images as $image) {

                $pic_image = new PostImage;

                $pic_image->fill($request->all());
                $pic_image->position = $maxPosition++;

                $pic_image->description = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);

                $pic_image->image = $image->store('post/images', 'public');
                
                $img = Image::make($image);
                
                $img->fit(180, 180, function ($constraint) {
                    $constraint->aspectRatio();
                });

                Storage::disk('public')->put('post/images/thumbnail/' . $pic_image->image, (string) $img->encode());

                $pic_image->save();

            }
        }

        return back();
    }

    public function updateImage(Request $request, PostImage $postImage)
    {
        $this->validate($request, [
            'position' => 'required|integer|min:0',
        ]);

        $postImage->position = $request->input('position');
        $postImage->save();

        return back();
    }

    public function destroyImage(PostImage $postImage)
    {
        $postImage->delete();
        return back();
    }
}
