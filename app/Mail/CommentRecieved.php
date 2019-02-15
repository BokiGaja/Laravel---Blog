<?php

namespace App\Mail;

use App\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Post;

class CommentRecieved extends Mailable
{
    use Queueable, SerializesModels;

    public $post;
    public $comment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Post $post, Comment $comment)
    {
        $this->post = $post;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.comment-received', [
            'post' => $this->post,
            'comment' => $this->comment
        ]);
    }
}
