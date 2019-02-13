<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'post_id', 'author', 'text'
    ];
    public function post()
    {
        // Connect Comment to Post model
        return $this->belongsTo(Post::class);
    }
}
