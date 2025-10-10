<?php

use App\Models\Admin;
use App\Models\Blog\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;



uses(RefreshDatabase::class);

beforeEach(function () {

    $this->admin = Admin::factory()->create();
    $this->actingAs($this->admin, 'admin');
});



/** blog post list */
test('can list blog post', function () {

    $posts = Post::factory()->count(3)->create();

    $response = $this->get(route('admin.blogs.posts.index'));

    $response->assertOk();

    foreach ($posts as $post) {
        $response->assertSee($post->title);
    }
});


/** blog post create */
test('can create blog post', function () {

    $post = Post::factory()->make();

    $response = $this->post(route('admin.blogs.posts.store'), $post->toArray());

    $response->assertRedirect(route('admin.blogs.posts.index'));

    $response->assertStatus(302);

    $this->assertDatabaseHas('blog_posts', [
        'title'           => $post->title,
        'slug'            => $post->slug,
        'content'         => $post->content,
        'seo_title'       => $post->seo_title,
        'seo_description' => $post->seo_description,
        'status'          => $post->status,
    ]);
});
