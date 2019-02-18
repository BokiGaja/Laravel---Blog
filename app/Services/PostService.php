<?php
/**
 * Created by PhpStorm.
 * User: nemanjagajic
 * Date: 2/15/19
 * Time: 9:40 PM
 */

namespace App\Services;


use App\Comment;
use App\Events\CommentCreated;
use App\Mail\CommentRecieved;
use App\Post;
use Illuminate\Support\Facades\Mail;

class PostService
{
    public static function savePost($postData) : Post
    {
        // Validation
        $postData->validate([
            'title'=>'required|min:5',
            'body'=>'required'
        ]);
        // Add post with user who created it
        return Post::create(
            array_merge(
                $postData->all(),
                ['user_id' => auth()->user()->id]
            )
        );
    }

    public static function editPost($postData)
    {
        $postData->update(request()->validate([
            'title'=>'required|min:5',
            'body'=>'required'
        ]));
    }

    public static function saveComment($commentData, $id): Comment
    {
        $commentData->validate([
            'author'=>'required|min:5',
            'text'=>'required'
        ]);

        $comment = Comment::create([
            'post_id' => $id,
            'author' => $commentData->author,
            'text' => $commentData->text
        ]);

        if ($comment->post->user)
        {
            Mail::to($comment->post->user)->send(new CommentRecieved(
                $comment->post, $comment
            ));
        }

        return $comment;
    }

    public static function flashMessage($message)
    {
        session()->flash('message', $message);
    }
}