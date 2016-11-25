<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Category;
use App\Tag;
use Session;
use Purifier;
use Image;

class PostController extends Controller
{
    private $categories;
    private $tags;
    public function __construct()
    {
        $this->middleware('auth');
        $this->categories = Category::all();
        $cats = [];
        foreach ($this->categories as $category)
           $cats[$category->id] =  $category->name;
        $this->categories = $cats;
        $this->tags = Tag::all();
        $tgs = [];
        foreach ($this->tags as $tag)
           $tgs[$tag->id] =  $tag->name;
        $this->tags = $tgs;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //comment change 1
        $posts = Post::orderBy('id', 'desc')->paginate(3);
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->withCategories($this->categories)->withTags($this->tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
                'title' => 'required|max:255',
                'slug' => 'required|alpha_dash|min:5|max:255|unique:posts',
                'category_id' => 'required|integer',
                'body' => 'required',
                'featured_image' => 'sometimes|image'
            ));
        $post = new Post;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = Purifier::clean($request->body);
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);
            $post->featured_image = $filename;
        }
        $post->save();
        if ($request->tags)
            $post->tags()->sync($request->tags, false);
        Session::flash('success', 'This post was added successfully.');
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->withPost($post);
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
        return view('posts.edit')->withPost($post)->withCategories($this->categories)->withTags($this->tags);
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
        $post = Post::find($id);
        $this->validate($request, array(
            'title' => 'required|max:255',
            'slug' => "required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
            'category_id' => 'required|integer',
            'body' => 'required',
            'featured_image' => 'sometimes|image'
        ));
        
        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->category_id = $request->input('category_id');
        $post->body = Purifier::clean($request->input('body'));
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);
            $oldImge = $post->featured_image;
            $post->featured_image = $filename;
            if ($oldImge)
                unlink(public_path('images/' . $oldImge));
        }
        $post->save();
        if ($request->tags)
            $post->tags()->sync($request->tags);
        else
            $post->tags()->detach();
        Session::flash('success', 'This post was successfully changed.');
        return redirect()->route('posts.show', $post->id);
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
        $oldImge = $post->featured_image;
        if ($oldImge)
            unlink(public_path('images/' . $oldImge));
        $post->tags()->detach();
        $post->delete();
        Session::flash('success', 'This post was successfully deleted.');
        return redirect()->route('posts.index');
    }
}
