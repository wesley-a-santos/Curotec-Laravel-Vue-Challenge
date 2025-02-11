<?php

use App\Models\Client;
use App\Models\User;
use function Pest\Laravel\actingAs;

test('user creation', function () {
    $user = User::factory()->create();

    expect($user->name)->not()->toBeNull()
        ->and($user->email)->not()->toBeNull()
        ->and($user->password)->not()->toBeNull();
});

test('user update', function () {
    $user = User::factory()->create();

    $user->update(['name' => 'New Name']);

    expect($user->fresh()->name)->toBe('New Name');
});

test('user deletion', function () {
    $user = User::factory()->create();

    $user->delete();

    expect(User::find($user->id))->toBeNull();
});

test('user relationship with clients', function () {
    $user = User::factory()->create();

    actingAs($user);

    $client = Client::factory()->create();

    expect($user->clients->contains($client))->toBeTrue();
});

test('user role', function () {
    $user = User::factory()->create();

    expect($user->role)->not()->toBeNull();
});
