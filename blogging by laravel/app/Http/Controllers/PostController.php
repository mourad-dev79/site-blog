<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View('admin.post.index')->with('posts' , Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $category = new Category();

        if($category->count() == 0){

            Session::flash('info' , 'you must have some categories');
            return redirect()->back();
        }
        return View('admin.post.create')->with('categories' , Category::all())->with('tags',Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        $this->validate($request , [
            'title' => 'required|max:255',
            'featured' => 'required|image',
            'content' => 'required',
            'category_id' => 'required'
        ]);

        
        $featured = $request->featured;

        $featured_new_name = time().$featured->getClientOriginalname();

        $featured->move('uploads/posts' , $featured_new_name);

        $slug = Str::slug($request->title);
        $post = Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'featured' => 'uploads/posts/'.$featured_new_name,
                'category_id' => $request->category_id,
                'slug'=>$slug,
                'tags' => 'required',
                'user_id' => Auth::id()
                
        ]);

        $post->tags()->attach($request->tags);

        Session::flash('success' , 'post created');

        return redirect()->back();
        
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
        $post = Post::find($id);

        return View('admin.post.edit')->with('posts', $post)->with('categories' , Category::all())->with('tags',Tag::all());
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
        $post = post::find($id);

        $this->validate($request , [
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required'
        ]);

        $post = post::find($id);

        if($request->hasFile('featured'))
        {
            $featured = $request->featured;

        $featured_new_name = time().$featured->getClientOriginalname();

        $featured->move('uploads/posts' , $featured_new_name);

        $post->featured = 'uploads/posts/'.$featured_new_name;

        }

        $post->title = $request->title;
        $post->content = $request->content;

        $post->category_id = $request->category_id;

        $post->save();

        $post->tags()->sync($request->tags);
        Session::flash('success', 'post updated');

        return redirect()->route('post.index');


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

        $post->delete();

        Session::flash('success', 'Post deleted');

        return redirect()->back();
    }


    public function trashed(){

        $post = Post::onlyTrashed()->get();

        return View('admin.post.trashed')->with('posts', $post);
    }

    public function kill($id){

        $post = Post::withTrashed()->where('id',$id)->first();

        $post->forceDelete();
        
        Session::flash('success' , 'post deleted permenntly');

        return redirect()->back();
    }

    public function restore($id){

        $post = Post::withTrashed()->where('id',$id)->first();

        $post->restore();
        
        Session::flash('success' , 'post restored');

        return redirect()->route('post.index');
    }
}
