<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'Blogging',
            'Fashion',
            'Car Industry',
            'Health',
            'Sport',
        ];

        foreach ($tags as $tag)
        {
            \App\Tag::create([
               'name' => $tag
            ]);
        }

        \App\Post::all()->each(function (\App\Post $p) use ($tags) {
            // Pluck will make an array out of collection
                $rndIds = \App\Tag::inRandomOrder()->select('id')->take(3)->pluck('id');
                // Add tags to posts, if you want to delete tag use detach
                $p->tags()->attach($rndIds);
        });
    }
}
