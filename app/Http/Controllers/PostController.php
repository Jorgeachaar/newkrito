<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function lists()
    {
    	$posts = Post::orderBy('created_at', 'DESC')->paginate(10);
    	return view('posts.list', compact('posts'));
    }

    public function show(Post $post, $slug)
    {
    	if ($post->slug != $slug) {
    		return redirect(route('posts.show', [$post->id, $post->slug]), 301);
    	}

    	return view('posts.show', compact('post'));
    }    
}
