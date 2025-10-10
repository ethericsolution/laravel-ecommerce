<?php

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = Admin::create([
        'name' => 'Admin',
        'email' => 'admin@admin.com',
        'password' => Hash::make('123456'),
    ]);
    $this->actingAs($this->admin, 'admin');
});

/** user list */
test('can list users', function () {

    $users = User::factory()->count(3)->create();

    $response = $this->get(route('admin.users.index'));

    $response->assertOk();

    foreach ($users as $user) {
        $response->assertSee($user->first_name);
        $response->assertSee($user->email);
    }
});


/** user create */
test('can create user', function () {

    $data = [
        'first_name'    => 'Test',
        'last_name'     => 'User',
        'email'         => 'test@example.com',
        'phone'         => '9856123450',
        'email_verified_at' => '',
        'password'          => 'password',
        'remember_token'    => 'password',
    ];

    $response = $this->post(route('admin.users.store'), $data);

    $response->assertRedirect(route('admin.users.index'));
    $response->assertStatus(302);

    $this->assertDatabaseHas('users', [
        'email' => 'test@example.com',
    ]);
});


/** email already exists */
test('shows validation error when email already exists', function () {
    $existing = User::factory()->create([
        'email' => 'test@example.com',
    ]);

    $response = $this->post(route('admin.users.store'), [
        'first_name'    => 'Test',
        'last_name'     => 'Another',
        'email'         => 'test@example.com',
        'phone'         => '9856123450',
        'email_verified_at' => '',
        'password'          => 'password',
        'remember_token'    => 'password',
    ]);

    $response->assertSessionHasErrors(['email']);
    $response->assertStatus(302);
});



/** user update */
test('can update a user', function () {

    $user = User::factory()->create();

    $updatedData = [
        'first_name' => fake()->firstName(),
        'last_name' => fake()->lastName(),
        'email' => fake()->unique()->safeEmail(),
        'phone' => fake()->phoneNumber(),
        'password' => Hash::make('123456'),
    ];

    $response = $this->put(route('admin.users.update', $user), $updatedData);

    $response->assertRedirect(route('admin.users.index'));
    $response->assertStatus(302);

    $this->assertDatabaseHas('users', [
        'id'            => $user->id,
        'first_name'    =>  $updatedData['first_name'],
        'last_name'     =>  $updatedData['last_name'],
        'email'         =>  $updatedData['email'],
        'phone'         =>  $updatedData['phone'],
        'password'      =>  $updatedData['password'],
    ]);
});



/** shows validation error when updating with an existing email */
/* test('shows validation error when updating with an existing email', function () {

    $existing = User::factory()->create([
        'email' => 'first@example.com',
    ]);

    $user = User::factory()->create([
        'email' => 'second@example.com',
    ]);

    $response = $this->put(route('admin.users.update', $user), [
        'first_name' => 'Test',
        'email' => 'first@example.com',
        'phone' => '1234567890',
    ]);


    $response->assertSessionHasErrors(['email']);
    $response->assertStatus(302);
});
 */

test('shows validation error when updating with an existing email', function () {

    $existing = User::factory()->create([
        'email' => 'first@example.com',
    ]);

    $user = User::factory()->create([
        'email' => 'second@example.com',
    ]);

    $response = $this->put(route('admin.users.update', $user), [
        'first_name' => 'Test User',
        'email'      => 'first@example.com',
        'phone'      => '1234567890',

    ]);

    $response->assertSessionHasErrors('email');
    $response->assertStatus(302);

    $this->assertDatabaseHas('users', [
        'id'    => $user->id,
        'email' => 'second@example.com',
    ]);
});
