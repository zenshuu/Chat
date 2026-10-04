<?php

use App\Models\User;

test('the registration page is reachable', function () {
    $this->get(route('register'))
        ->assertOk()
        ->assertSee('Already have an account?')
        ->assertSee(route('login'));
});

test('a visitor can register', function () {
    $this->post(route('register'), [
        'name' => 'Alice Martin',
        'email' => 'alice@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ])
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('home'));

    $this->assertAuthenticated();

    expect(User::where('email', 'alice@example.com')->sole()->name)->toBe('Alice Martin');
});

test('the email must be unique', function () {
    User::factory()->create(['email' => 'taken@example.com']);

    $this->post(route('register'), [
        'name' => 'Impostor',
        'email' => 'taken@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ])->assertSessionHasErrors('email');

    expect(User::where('email', 'taken@example.com')->sole()->name)->not->toBe('Impostor');
});

test('the password must be confirmed', function () {
    $this->post(route('register'), [
        'name' => 'Alice Martin',
        'email' => 'alice@example.com',
        'password' => 'password',
        'password_confirmation' => 'something-else',
    ])->assertSessionHasErrors('password');

    $this->assertGuest();
});

test('a visitor can sign in with valid credentials', function () {
    $user = User::factory()->create();

    $this->post(route('login'), [
        'email' => $user->email,
        'password' => 'password',
    ])->assertSessionHasNoErrors();

    $this->assertAuthenticatedAs($user);
});

test('signing in fails with a wrong password', function () {
    $user = User::factory()->create();

    $this->post(route('login'), [
        'email' => $user->email,
        'password' => 'wrong-password',
    ])->assertSessionHasErrors('email');

    $this->assertGuest();
});

test('a user can sign out', function () {
    $this->actingAs(User::factory()->create())
        ->post(route('logout'))
        ->assertRedirect(route('home'));

    $this->assertGuest();
});
