<?php

use App\Models\User;

test('restaurant login screen can be rendered', function () {
    $response = $this->get('/restaurant/login');

    $response->assertStatus(200);
});

test('restaurant owners can authenticate using the restaurant login', function () {
    $user = User::factory()->create([
        'role' => 'restaurant',
        'password' => bcrypt('password'),
    ]);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
        'role' => 'restaurant',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});

test('restaurant login requires role parameter', function () {
    $user = User::factory()->create([
        'role' => 'restaurant',
        'password' => bcrypt('password'),
    ]);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
        // role is missing
    ]);

    $response->assertSessionHasErrors('role');
});

test('customers cannot login through restaurant login with wrong role', function () {
    $user = User::factory()->create([
        'role' => 'customer',
        'password' => bcrypt('password'),
    ]);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
        'role' => 'restaurant', // wrong role
    ]);

    $this->assertGuest();
    $response->assertSessionHasErrors('email');
});

test('restaurant owners cannot login with customer role', function () {
    $user = User::factory()->create([
        'role' => 'restaurant',
        'password' => bcrypt('password'),
    ]);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
        'role' => 'customer', // wrong role
    ]);

    $this->assertGuest();
    $response->assertSessionHasErrors('email');
});
