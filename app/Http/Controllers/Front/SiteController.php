<?php

namespace App\Http\Controllers\Front;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function index()
    {
        $posts = Post::latest('id')->with(['author'])->simplePaginate(10);
        return view('front.index',[
            'posts' => $posts
        ]);
    }

    public function show(Post $post)
    {
        return view('front.post')->with('post', $post->load('author'));
    }
}
