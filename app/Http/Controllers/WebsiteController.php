<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index(){
        $categories = Category::orderBy('name', 'ASC')->where('is_published', '1')->get();
        $posts = Post::orderBy('id', 'ASC')->where('post_type', 'post')->where('is_published', '1')->paginate(5);
        return view('website.index', compact('posts', 'categories'));
    }

    public function post($slug){
        $post = Post::where('slug', $slug)->where('post_type', 'post')->where('is_published', '1')->first();
        if ($post) {
            return view('website.post', compact('post'));
        } else {
            return \Response::view('website.errors.404', array(), 404);
        }
    }

    public function category($slug){
        $category = Category::where('slug', $slug)->where('is_published', '1')->first();
        $posts = $category->posts()->orderBy('posts.id', 'DESC')->where('is_published', '1')->paginate(5);
        if ($category) {
            return view('website.category', compact('category','posts'));
        } else {
            return \Response::view('website.errors.404', array(), 404);
        }
    }
}
