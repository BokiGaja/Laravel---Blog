<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommentRecieved;

// You can use this one for validation also
//use App\Http\Requests\CreatePostRequest;

class PostsController extends Controller
{
    // Adding middleware to some functions from controller
//    public function __construct()
//    {
//        $this->middleware('auth', ['only' => ['create', 'store', 'edit', 'update', 'delete']]);
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::published();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'title'=>'required|min:5',
            'body'=>'required'
        ]);
        // Add post with user who created it
        Post::create(
            array_merge(
                $request->all(),
                ['user_id' => auth()->user()->id]
            )
        );
        // Return to page after submitting input
        return redirect(route('posts-index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    Here you get id of Post
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
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
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post)
    {
        $post->update(request()->validate([
            'title'=>'required|min:5',
            'body'=>'required'
        ]));

        return redirect('/posts/'.$post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/posts');
    }

    public function addComment(Request $request, $id)
    {
        $request->validate([
            'author'=>'required|min:5',
            'text'=>'required'
        ]);
        $comment = Comment::create([
            'post_id' => $id,
            'author' => $request->author,
            'text' => $request->text
        ]);
        if ($comment->post->user)
        {
            Mail::to($comment->post->user)->send(new CommentRecieved(
                $comment->post, $comment
            ));
        }
        return redirect()->back();
    }
}
