<?php

/* test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
}); */

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

test('login screen can be rendered', function () {
    $response = $this->get(route('admin.login'));

    $response->assertStatus(200);
});



/** admin authentication */
test('admin can authenticate using the login screen', function () {

    $admin = Admin::factory()->create([
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),
    ]);

    $this->post(route('admin.login'), [
        'email' => 'admin@example.com',
        'password' => 'password',
    ])

        ->assertRedirect(route('admin.dashboard'));

    $this->assertAuthenticatedAs($admin, 'admin');
});


/** invalid password */
test('admin can not authenticate with invalid password', function () {
    $admin = Admin::factory()->create();

    $this->post(route('admin.login'), [
        'email' => $admin->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});



/** admin logout */
test('admin can logout', function () {

    $admin = Admin::factory()->create();

    $response = $this->actingAs($admin, 'admin')->post(route('admin.logout'));

    $this->assertGuest('admin');

    $response->assertRedirect(route('admin.login'));
});
