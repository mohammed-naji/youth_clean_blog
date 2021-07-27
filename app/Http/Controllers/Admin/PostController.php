<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::orderBy('id', 'desc')->get();
        $posts = Post::latest('id')->with(['author', 'category'])->paginate(10);
        // dd($posts);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        // upload file
        $ex = $request->file('image')->getClientOriginalExtension();
        $new_name = rand() . '_' . time() . '.' . $ex;
        $request->file('image')->move(public_path('uploads'), $new_name);

        // save post
        $post = Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'body' => $request->body,
            'image' => $new_name,
            'excerpt' => $request->excerpt,
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id
        ]);

        if($post) {
            return redirect()->route('admin.posts.index');
        } else  {
            return redirect()->back()->with('error', 'There is an error in your data');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $post = Post::find($id);
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'image',
            'category_id' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
        ]);

        $post = Post::find($id);

        $new_name = $post->image;
        if($request->has('image')) {
            $ex = $request->file('image')->getClientOriginalExtension();
            $new_name = rand() . '_' . time() . '.' . $ex;
            $request->file('image')->move(public_path('uploads'), $new_name);
        }

        $post = $post->update([
            'title' => $request->title,
            'image' => $new_name,
            'category_id' => $request->category_id,
            'excerpt' => $request->excerpt,
            'body' => $request->body,
        ]);

        if($post) {
            return redirect()->route('admin.posts.index');
        } else  {
            return redirect()->back()->with('error', 'There is an error in your data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        unlink(public_path('uploads/'.$post->image));
        $post->delete();
        return redirect()->back();
    }
}
