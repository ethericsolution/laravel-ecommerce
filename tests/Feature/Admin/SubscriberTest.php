<?php

use App\Models\Admin;
use App\Models\Subscriber;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class);


beforeEach(function () {

    $this->admin = Admin::factory()->create();
    $this->actingAs($this->admin, 'admin');
});


/** subscriber list */
test('can list subscriber', function () {

    $subscribers = Subscriber::factory()->count(3)->create();

    $response = $this->get(route('admin.subscribers.index'));

    $response->assertOk();

    foreach ($subscribers as $subscriber) {
        $response->assertSee($subscriber->code);
    }
});



/** subscriber create */
test('can create subscriber', function () {

    $subscriber = Subscriber::factory()->make();

    $response = $this->post(route('admin.subscribers.store'), $subscriber->toArray());

    $response->assertRedirect(route('admin.subscribers.index'));

    $response->assertStatus(302);

    $this->assertDatabaseHas('subscribers', [
        'name'  => $subscriber->name,
        'email' => $subscriber->email,
    ]);
});



/** subscriber update */
test('can update a subscriber', function () {

    $subscriber = Subscriber::factory()->create();

    $updatedData = [
        'name'  => fake()->name(),
        'email' => fake()->unique()->safeEmail(),
    ];

    $response = $this->put(route('admin.subscribers.update', $subscriber), $updatedData);

    $response->assertRedirect(route('admin.subscribers.index'));
    $response->assertStatus(302);

    $this->assertDatabaseHas('subscribers', [
        'id'         => $subscriber->id,
        'name'       => $updatedData['name'],
        'email'      => $updatedData['email'],
    ]);
});



/** subscriber delete */
test('can delete a subscriber', function () {
    $subscriber = Subscriber::factory()->create();

    $response = $this->delete(route('admin.subscribers.destroy', $subscriber));

    $response->assertRedirect(route('admin.subscribers.index'));
    $response->assertStatus(302);

    $this->assertDatabaseMissing('subscribers', [
        'id' => $subscriber->id,
    ]);
});
