<?php

use App\Models\Chat;
use App\Models\User;

test('a message is stored and the visitor is sent back home', function () {
    $this->post(route('chats.store'), ['message' => 'Hello from a guest'])
        ->assertSessionHasNoErrors()
        ->assertRedirect('/')
        ->assertSessionHas('success', 'Message sent successfully.');

    expect(Chat::where('message', 'Hello from a guest')->sole()->user_id)->toBeNull();
});

test('a message is required', function () {
    $this->post(route('chats.store'), ['message' => ''])
        ->assertSessionHasErrors('message');

    expect(Chat::count())->toBe(0);
});

test('a message cannot exceed 255 characters', function () {
    $this->post(route('chats.store'), ['message' => str_repeat('a', 256)])
        ->assertSessionHasErrors('message');

    expect(Chat::count())->toBe(0);
});

test('the home page lists the messages', function () {
    $user = User::factory()->create();

    Chat::factory()->for($user)->create(['message' => 'A brand new message']);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('A brand new message')
        ->assertSee($user->name);
});

test('the edit page shows the message to update', function () {
    $chat = Chat::factory()->create(['message' => 'A message to edit']);

    $this->get(route('chats.edit', $chat))
        ->assertOk()
        ->assertSee('A message to edit');
});

test('a message is updated', function () {
    $chat = Chat::factory()->create(['message' => 'Before']);

    $this->patch(route('chats.update', $chat), ['message' => 'After'])
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('home'))
        ->assertSessionHas('success', 'Message updated successfully.');

    expect($chat->fresh()->message)->toBe('After');
});

test('a message cannot be updated with an empty value', function () {
    $chat = Chat::factory()->create(['message' => 'Before']);

    $this->patch(route('chats.update', $chat), ['message' => ''])
        ->assertSessionHasErrors('message');

    expect($chat->fresh()->message)->toBe('Before');
});

test('a message is deleted', function () {
    $chat = Chat::factory()->create();

    $this->delete(route('chats.destroy', $chat))
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('home'))
        ->assertSessionHas('success', 'Message deleted successfully.');

    expect(Chat::find($chat->id))->toBeNull();
});
