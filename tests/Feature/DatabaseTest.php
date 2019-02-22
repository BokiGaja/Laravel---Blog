<?php

namespace Tests\Feature;

use App\Comment;
use App\Post;
use App\Tag;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatabaseTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPostsTable()
    {
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();

        $post->user_id = $user->id;
        $post->save();
        $this->assertDatabaseHas('posts', ['title' => $post->title]);
    }

    public function testCommentsTable()
    {
        $post = factory(Post::class)->create();
        $post->comments()->saveMany(factory(Comment::class, 6)->make());

        $user = factory(User::class)->create();
        $post->user_id = $user->id;
        $post->save();

        $this->assertEquals(6, $post->comments->count());
    }

    public function testTagsTable()
    {
        $post = factory(Post::class)->create();
        $post->tags()->saveMany(factory(Tag::class, 10)->make());

        $user = factory(User::class)->create();
        $post->user_id = $user->id;
        $post->save();

        $this->assertEquals(10, $post->tags->count());
    }
}
