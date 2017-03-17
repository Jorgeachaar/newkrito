<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

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
}
