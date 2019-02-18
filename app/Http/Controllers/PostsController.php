<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;
use App\Post;

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
        return view('posts.index', [
            'posts' => Post::published()
        ]);
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
        $createdPost = PostService::savePost($request);
        // Return to page after submitting input
        if ($createdPost !== null)
        {
            PostService::flashMessage('Your post has been created');
            return redirect(route('posts-index'));
        }
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
        $this->authorize('update', $post);
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
        PostService::editPost($post);
        PostService::flashMessage('Your post has been updated');
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
        PostService::flashMessage('Your post has been deleted');
        return redirect('/posts');
    }

    public function addComment(Request $request, $id)
    {
        $comment = PostService::saveComment($request, $id);
        if ($comment !== null)
        {
            return redirect()->back();
        }
    }
}
