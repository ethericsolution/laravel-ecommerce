<?php

use App\Models\Admin;
use App\Models\Blog\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;



uses(RefreshDatabase::class);

beforeEach(function () {

    $this->admin = Admin::factory()->create();
    $this->actingAs($this->admin, 'admin');
});



/** blog category list */
test('can list blog category', function () {

    $categories = Category::factory()->count(3)->create();

    $response = $this->get(route('admin.blogs.categories.index'));

    $response->assertOk();

    foreach ($categories as $category) {
        $response->assertSee($category->name);
    }
});



/** blog category create */
test('can create blog category', function () {

    $category = Category::factory()->make();

    $response = $this->post(route('admin.blogs.categories.store'), $category->toArray());

    $response->assertRedirect(route('admin.blogs.categories.index'));

    $response->assertStatus(302);

    $this->assertDatabaseHas('blog_categories', [
        'name'          => $category->name,
        'slug'          => $category->slug,
        'description'   => $category->description,
        'seo_title'         => $category->seo_title,
        'seo_description'   => $category->seo_description,
    ]);
});



/** blog category update */
test('can update a blog category', function () {

    $category = Category::factory()->create();

    $updatedData = [
        'name'  => $name = fake()->unique()->words(3, true),
        'slug'  => Str::slug($name),
        'description' => fake()->paragraph(),
        'seo_title'   => fake()->realText(60),
        'seo_description' => fake()->realText(160),
    ];

    $response = $this->put(route('admin.blogs.categories.update', $category), $updatedData);

    $response->assertRedirect(route('admin.blogs.categories.index'));
    $response->assertStatus(302);

    $this->assertDatabaseHas('blog_categories', [
        'id'   => $category->id,
        'name' => $updatedData['name'],
        'slug' => $updatedData['slug'],
        'description' => $updatedData['description'],
        'seo_title'   => $updatedData['seo_title'],
        'seo_description'   => $updatedData['seo_description'],
    ]);
});



/** blog category delete */
test('can delete a blog category', function () {
    $category = Category::factory()->create();

    $response = $this->delete(route('admin.blogs.categories.destroy', $category));

    $response->assertRedirect(route('admin.blogs.categories.index'));
    $response->assertStatus(302);

    $this->assertDatabaseMissing('blog_categories', [
        'id' => $category->id,
    ]);
});
