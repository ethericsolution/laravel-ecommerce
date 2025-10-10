<?php

use App\Models\Admin;
use App\Models\Tax;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = Admin::factory()->create();
    $this->actingAs($this->admin, 'admin');
});


/** tax list */
test('can list tax', function () {

    $taxes = Tax::factory()->count(3)->create();

    $response = $this->get(route('admin.taxes.index'));

    $response->assertOk();

    foreach ($taxes as $tax) {
        $response->assertSee($tax->name);
    }
});



/** tax create */
test('can create tax', function () {

    $tax = Tax::factory()->make();

    $response = $this->post(route('admin.taxes.store'), $tax->toArray());

    $response->assertRedirect(route('admin.taxes.index'));

    $response->assertStatus(302);

    $this->assertDatabaseHas('taxes', [
        'name'  => $tax->name,
    ]);
});



/** tax update */
test('can update a tax', function () {

    $tax = Tax::factory()->create();

    $updatedData = [
        'name'  => fake()->name(),
        'type'  => 'fixed',
        'rate'  => fake()->randomFloat(2, 1, 30),
    ];

    $response = $this->put(route('admin.taxes.update', $tax), $updatedData);

    $response->assertRedirect(route('admin.taxes.index'));
    $response->assertStatus(302);

    $this->assertDatabaseHas('taxes', [
        'id'         => $tax->id,
        'name'       => $updatedData['name'],
        'type'       => $updatedData['type'],
        'rate'       => $updatedData['rate'],
    ]);
});



/** tax delete */
test('can delete a tax', function () {
    $tax = Tax::factory()->create();

    $response = $this->delete(route('admin.taxes.destroy', $tax));

    $response->assertRedirect(route('admin.taxes.index'));
    $response->assertStatus(302);

    $this->assertDatabaseMissing('taxes', [
        'id' => $tax->id,
    ]);
});
