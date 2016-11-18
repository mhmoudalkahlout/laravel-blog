<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Comment;
use App\Post;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'store']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'comment' => 'required|min:5|max:2000'
            ]);
        $post = Post::find($post_id);
        $comment = new Comment();
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->approved = true;
        $comment->post()->associate($post);
        $comment->save();
        Session::flash('success', 'Comment added successfully');
        return redirect()->route('blog.single', [$post->slug]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('comments.edit')->withComment($comment);
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
        $this->validate($request, ['comment' => 'required|min:5|max:2000']);
        $comment = Comment::find($id);
        $comment->comment = $request->comment;
        $comment->save();
        Session::flash('success', 'Comment updated successfully');
        return redirect()->route('posts.show', [$comment->post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $post_id = $comment->post->id;
        $comment->delete();
        Session::flash('success', 'Comment deleted');
        return redirect()->route('posts.show', [$post_id]);
    }
}
