<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Setting;
use App\Tag;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index(){

        
        return view('welcome')
                        ->with('title' , Setting::first()->site_name)
                        ->with('categories' , Category::take(5)->get())
                        ->with('first_post', Post::orderby('created_at', 'desc')->first())
                        ->with('second_post', Post::orderby('created_at', 'desc')->skip(1)->take(1)->get()->first())
                        ->with('third_post', Post::orderby('created_at', 'desc')->skip(2)->take(1)->get()->first())
                        ->with('laravel',Category::find(1))
                        ->with('wordpress', Category::find(5))
                        ->with('setting' , Setting::first());
    }

    public function singlePost($slug){

        $post = Post::where('slug', $slug)->first();

        $next_id = Post::where('id' , '>' , $post->id)->min('id');
        $previous = Post::where('id' , '<' , $post->id)->max('id');

        return view('single')->with('post', $post)
                            ->with('categories' , Category::take(5)->get())
                            ->with('setting' , Setting::first())
                            ->with('next', Post::find($next_id))
                            ->with('previous', Post::find($previous))
                            ->with('tags', Tag::all());
    }

    public function category($id){

        $category = Category::find($id);

        return view('category')->with('category', $category)
                               ->with('title', $category->name)
                               ->with('setting' , Setting::first())
                               ->with('categories' , Category::take(5)->get());
    }

    public function tag($id){

        $tag = Tag::find($id);

        return view('tag')->with('tag', $tag)
                          ->with('setting' , Setting::first())
                          ->with('categories' , Category::take(5)->get());
    }
}
