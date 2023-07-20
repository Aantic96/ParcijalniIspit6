<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
	// Test
        $posts = Post::latest('created_at')->paginate(10);

        return view('post/index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Post::create([
            'title' => $request['title'],
            'body' => $request['body'],
            'user_id' => auth()->user()->id
        ]);

        return redirect(route('posts.index'))->with('success', 'Post created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post/show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('post/edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $post->update([
            'title' => $request['title'],
            'body' => $request['body'],
        ]);
        
        return redirect(route('posts.show', $post))->with('success', 'Post updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect(route('posts.index'))->with('success', 'Post deleted');
    }
}
