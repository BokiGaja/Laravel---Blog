<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
//    Here we define properties that we can input (id... is automatically added)
    protected $fillable = [
        'title', 'body'
    ];

    public static function published()
    {
        return self::where('published', 1)->get();
    }
    public static function drafts()
    {
        return self::where('published', 0)->get();
    }

    public function comments()
    {
        // Connect this model with Comment model
        return $this->hasMany(Comment::class);
    }
}
