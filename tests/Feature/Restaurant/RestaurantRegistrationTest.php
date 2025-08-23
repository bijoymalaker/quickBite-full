<?php

use App\Models\User;

test('restaurant registration screen can be rendered', function () {
    $response = $this->get('/restaurant/register');

    $response->assertStatus(200);
});

test('new restaurant owners can register', function () {
    $response = $this->post('/register', [
        'name' => 'Restaurant Owner',
        'email' => 'restaurant@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'restaurant',
    ]);

    $this->assertAuthenticated();
    
    // Check that user was created with restaurant role
    $user = User::where('email', 'restaurant@example.com')->first();
    $this->assertNotNull($user);
    $this->assertEquals('restaurant', $user->role);
    
    $response->assertRedirect(route('dashboard', absolute: false));
});

test('restaurant registration requires role validation', function () {
    $response = $this->post('/register', [
        'name' => 'Restaurant Owner',
        'email' => 'restaurant@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        // role is missing
    ]);

    $response->assertSessionHasErrors('role');
});

test('restaurant registration validates role values', function () {
    $response = $this->post('/register', [
        'name' => 'Restaurant Owner',
        'email' => 'restaurant@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'invalid-role', // invalid role
    ]);

    $response->assertSessionHasErrors('role');
});
