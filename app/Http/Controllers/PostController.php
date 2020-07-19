<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->where('post_type', 'post')->get();
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        return view('admin.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'thumbnail' => 'required',
            'title' => 'required|unique:posts',
            'details' => 'required',
            'category_id' => 'required',
        ],
        [
            'thumbnail.required' => 'Enter thumbnail url',
            'title.required' => 'Enter title',
            'title.unique' => 'Title already exist',
            'details.required' => 'Enter Details',
            'category_id.required' => 'Select Categories',
        ]);
        $post = new Post();
        $post->user_id = Auth::id();
        $post->thumbnail = $request->thumbnail;
        $post->title = $request->title;
        $post->sub_title = $request->sub_title;
        $post->slug = str_slug($request->title);
        $post->is_published = $request->is_published;
        $post->details = $request->details;
        $post->post_type = 'post';
        $post->save();
        $post->categories()->sync($request->category_id, false);
        Session::flash('message', 'Post created successfully');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');
//        dd($post);
        return view('admin.post.edit', compact('categories','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'thumbnail' => 'required',
            'title' => 'required|unique:posts,title,' . $post->id . ',id', //ignore this id
            'details' => 'required',
            'category_id' => 'required',
        ],
            [
                'thumbnail.required' => 'Enter thumbnail url',
                'title.required' => 'Enter title',
                'title.unique' => 'Title already exist',
                'details.required' => 'Enter Details',
                'category_id.required' => 'Select Categories',
            ]);

        $post->user_id = Auth::id();
        $post->thumbnail = $request->thumbnail;
        $post->title = $request->title;
        $post->sub_title = $request->sub_title;
        $post->slug = str_slug($request->title);
        $post->is_published = $request->is_published;
        $post->details = $request->details;
        $post->post_type = 'post';
        $post->save();

        $post->categories()->sync($request->category_id);

        Session::flash('message', 'Post updated successfully');
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        Session::flash('delete-message', 'Category deleted successfully');
        return redirect()->route('posts.index');
    }
}
