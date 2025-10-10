<?php

use App\Models\Admin;
use App\Models\Banner;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class);

beforeEach(function () {

    $this->admin = Admin::factory()->create();
    $this->actingAs($this->admin, 'admin');
});



/** banner list */
test('can list banners', function () {

    $banners = Banner::factory()->count(3)->create();

    $response = $this->get(route('admin.banners.index'));

    $response->assertOk();

    foreach ($banners as $banner) {
        $response->assertSee($banner->name);
        $response->assertSee($banner->link);
    }
});



/** Banner create */
test('can create banner', function () {

    $banner = Banner::factory()->make();

    $response = $this->post(route('admin.banners.store'), $banner->toArray());

    $response->assertRedirect(route('admin.banners.index'));

    $response->assertStatus(302);

    $this->assertDatabaseHas('banners', [
        'name' => $banner->name,
        'link' => $banner->link,
        'location' => $banner->location,
        'is_active' => $banner->is_active,
        'is_new_tab' => $banner->is_new_tab,
    ]);
});



/** banner update */
test('can update a banner', function () {
    $banner = Banner::factory()->create();

    $updatedData = [
        'name'          => fake()->name(),
        'link'          => fake()->optional()->url(),
        'location'      => 'slider',
        'is_active'     => fake()->boolean(),
        'is_new_tab'    => fake()->boolean(),
    ];

    $response = $this->put(route('admin.banners.update', $banner), $updatedData);

    $response->assertRedirect(route('admin.banners.index'));
    $response->assertStatus(302);

    $this->assertDatabaseHas('banners', [
        'id'         => $banner->id,
        'name'       => $updatedData['name'],
        'link'       => $updatedData['link'],
        'location'   => $updatedData['location'],
        'is_active'  => $updatedData['is_active'],
        'is_new_tab' => $updatedData['is_new_tab'],
    ]);
});



/** banner delete */
test('can delete a banner', function () {
    $banner = Banner::factory()->create();

    $response = $this->delete(route('admin.banners.destroy', $banner));

    $response->assertRedirect(route('admin.banners.index'));
    $response->assertStatus(302);

    $this->assertDatabaseMissing('banners', [
        'id' => $banner->id,
    ]);
});
