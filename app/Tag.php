<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // If you have table that's name is not by Laravel convention you
    // can connect model with table like this
//    protected $table = 'tagovi';

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
