<?php

use App\Models\Admin;
use App\Models\Coupon;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class);


beforeEach(function () {

    $this->admin = Admin::factory()->create();
    $this->actingAs($this->admin, 'admin');
});



/** coupon list */
test('can list coupon', function () {

    $coupons = Coupon::factory()->count(3)->create();

    $response = $this->get(route('admin.coupons.index'));

    $response->assertOk();

    foreach ($coupons as $coupon) {
        $response->assertSee($coupon->code);
    }
});



/** coupon create */
test('can create coupon', function () {

    $coupon = Coupon::factory()->make();

    $response = $this->post(route('admin.coupons.store'), $coupon->toArray());

    $response->assertRedirect(route('admin.coupons.index'));

    $response->assertStatus(302);

    $this->assertDatabaseHas('coupons', [
        'code'        => $coupon->code,
        'description' => $coupon->description,
        'type'        => $coupon->type,
        'value'       => $coupon->value,

    ]);
});




/** coupon update */
test('can update a coupon', function () {

    $types = ['flat', 'percent'];

    $coupon = Coupon::factory()->create();

    $updatedData = [
        'code'          => fake()->regexify('[A-Za-z0-9]{10}'),
        'description'   => fake()->realText(60),
        'type'          => fake()->randomElement($types),
        'value'         => fake()->numberBetween(1, 100),
        'max_discount_value' => fake()->numberBetween(1, 100),
        'start_date'    => now(),
        'end_date'      => now()->addDays(10),
        'total_quantity'    => fake()->numberBetween(1, 200),
        'use_per_user'      => fake()->numberBetween(1, 10),
        'min_cart_value'    => fake()->numberBetween(100, 500),
        'max_cart_value'    => fake()->numberBetween(500, 2000),
        'is_for_new_user'   => fake()->boolean(),
    ];

    $response = $this->put(route('admin.coupons.update', $coupon), $updatedData);

    $response->assertRedirect(route('admin.coupons.index'));
    $response->assertStatus(302);

    $this->assertDatabaseHas('coupons', [
        'id'   => $coupon->id,
        'code'          => $updatedData['code'],
        'description'   => $updatedData['description'],
        'type'          => $updatedData['type'],
        'value'         => $updatedData['value'],
    ]);
});



/** coupon delete */
test('can delete a coupon', function () {
    $coupon = Coupon::factory()->create();

    $response = $this->delete(route('admin.coupons.destroy', $coupon));

    $response->assertRedirect(route('admin.coupons.index'));
    $response->assertStatus(302);

    $this->assertDatabaseMissing('coupons', [
        'id' => $coupon->id,
    ]);
});
