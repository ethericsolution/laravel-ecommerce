<?php

use App\Models\Admin;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class);

beforeEach(function () {

    $this->admin = Admin::factory()->create();
    $this->actingAs($this->admin, 'admin');
});




/** brands list */
test('can list brands', function () {

    $brands = Brand::factory()->count(3)->create();

    $response = $this->get(route('admin.brands.index'));

    $response->assertOk();

    foreach ($brands as $brand) {
        $response->assertSee($brand->name);
    }
});



/** brand create */
test('can create brand', function () {

    $brand = Brand::factory()->make();

    $response = $this->post(route('admin.brands.store'), $brand->toArray());

    $response->assertRedirect(route('admin.brands.index'));

    $response->assertStatus(302);

    $this->assertDatabaseHas('brands', [
        'name'          => $brand->name,
        'slug'          => $brand->slug,
        'description'   => $brand->description,
        'seo_title'         => $brand->seo_title,
        'seo_description'   => $brand->seo_description,

    ]);
});



/** brand update */
test('can update a brand', function () {

    $brand = Brand::factory()->create();

    $updatedData = [
        'name'  => $name = fake()->unique()->company(),
        'slug'  => Str::slug($name),
        'description' => fake()->paragraph(),
        'seo_title'   => fake()->realText(60),
        'seo_description' => fake()->realText(160),
    ];

    $response = $this->put(route('admin.brands.update', $brand), $updatedData);

    $response->assertRedirect(route('admin.brands.index'));
    $response->assertStatus(302);

    $this->assertDatabaseHas('brands', [
        'id'   => $brand->id,
        'name' => $updatedData['name'],
        'slug' => $updatedData['slug'],
        'description' => $updatedData['description'],
        'seo_title'   => $updatedData['seo_title'],
        'seo_description'   => $updatedData['seo_description'],
    ]);
});



/** brand delete */
test('can delete a brand', function () {
    $brand = Brand::factory()->create();

    $response = $this->delete(route('admin.brands.destroy', $brand));

    $response->assertRedirect(route('admin.brands.index'));
    $response->assertStatus(302);

    $this->assertDatabaseMissing('brands', [
        'id' => $brand->id,
    ]);
});
