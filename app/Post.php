<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
//    Here we define properties that we can input (id... is automatically added)
    protected $fillable = [
        'title', 'body', 'user_id'
    ];

    public static function published()
    {
        return self::where('published', 1);
    }
    public static function drafts()
    {
        return self::where('published', 0)->get();
    }
    // Connect post with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        // Connect this model with Comment model
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
