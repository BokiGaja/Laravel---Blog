<?php

namespace Tests\Feature;

use App\Http\Controllers\PostsController;
use App\Post;
use App\User;
use Couchbase\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nexmo\Call\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // validate index
    public function admin()
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'email_verified_at' => now()
        ]);
        return $admin;
    }

    public function testIndexValid()
    {
        $response = $this->get('/posts');

        $response->assertStatus(200);
    }

    // validate create
    public function testCreateValid()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/posts/create');

        $response->assertStatus(200);
    }

    public function testCreateInvalid()
    {
        $response = $this->get('/posts/create');

        $response->assertStatus(302);
    }

    // validate store
    public function testStoreValid()
    {
        $this->actingAs(factory(User::class)->create());
        $this->post('posts', [
            'title' => 'Title',
            'body' => 'body',
            'tags' => ['tag']
        ]);
        $this->assertDatabaseHas('posts', ['title' => 'Title']);
    }

    public function testStoreInvalid()
    {
        $this->post('posts', [
            'title' => 'Title2',
            'body' => 'body',
            'tags' => ['tag']
        ]);
        $this->assertDatabaseMissing('posts', ['title' => 'Title2']);
    }

    // test show
    public function testShowValid()
    {
        $post = factory(Post::class)->create();
        $response = $this->get('/posts/'.$post->id);
        $response->assertStatus(200);
    }

    // test edit
    public function testEditValid()
    {
        // Creating admin user

        $this->actingAs($this->admin());
        $post = factory(Post::class)->create();

        $response = $this->get('posts/'.$post->id.'/edit');
        $response->assertStatus(200);
    }

    public function testEditInvalid()
    {
        $post = factory(Post::class)->create();
        $response = $this->get('posts/'.$post->id.'/edit');
        $response->assertStatus(302);
    }

    // test update
    public function testUpdateValid()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->post('posts', [
            'title' => 'Title2',
            'body' => 'body2',
            'tags' => ['tag2']
        ]);
        $post = Post::where('user_id', '=', $user->id)->first();
        $this->put('posts/'.$post->id, [
            'title' => 'Title3',
            'body' => 'body3',
            'tags' => ['tag3']
        ]);
        $this->assertDatabaseHas('posts', ['title' => 'Title3']);
    }

    public function testUpdateInvalid()
    {
        $post = factory(Post::class)->create();
        $this->put($post, [
            'title' => 'Title4',
            'body' => 'body4',
            'tags' => ['tag4']
        ]);
        $this->assertDatabaseMissing('posts', ['title' => 'Title4']);
    }

    // test Destroy
    public function testDestroyValid()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->post('posts', [
            'title' => 'Title5',
            'body' => 'body5',
            'tags' => ['tag5']
        ]);
        $post = Post::where('user_id', '=', $user->id)->first();
        $post->delete();
        $this->assertDatabaseMissing('posts', ['title' => 'Title5']);
    }

    public function testDestroyinValid()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->post('posts', [
            'title' => 'Title6',
            'body' => 'body6',
            'tags' => ['tag6']
        ]);
        $post = Post::where('user_id', '!=', $user->id)->first();
        $post->delete();
        $this->assertDatabaseHas('posts', ['title' => 'Title6']);
    }

    // test PostComment
    public function testPostCommentValid()
    {
        $post = factory(Post::class)->create();
        $this->post('/posts/'.$post->id.'/comments', [
            'author' => 'Author1',
            'text' => 'Text1',
            'post_id' => $post->id
        ]);
        $this->assertDatabaseHas('comments', ['author' => 'Author1']);
    }
}
