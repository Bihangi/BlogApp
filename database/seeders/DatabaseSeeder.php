<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Comment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 5 categories
        $categories = Category::factory(5)->create();

        //Create 10 user (authors)
        $users = User::factory(10)->create();

        //Create 15 tags
        $tags = Tag::factory(15)->create();

        //Create 20 posts and associate each with random categories, users and tags
        Post::factory(20)->create()->each(function ($post) use ($categories, $users, $tags) {
            // Associate a random author
            $post->author()->associate($users->random())->save();

            // Associate a random category
            $post->category()->associate($categories->random())->save();

            // Attach random tags to a post
            $post->tags()->attach($tags->random(rand(1, 3))->pluck('id')->toArray());

            //Create random comments for each post
            Comment::factory(rand(0, 5))->create([
                'post_id' => $post->id,
                'author_id' => $users->random()->id, // Associate with a random user
            ]);
        });
    }
}
