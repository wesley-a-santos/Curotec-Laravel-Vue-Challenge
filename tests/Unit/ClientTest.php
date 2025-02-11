<?php

use App\Models\Client;
use App\Models\User;
use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->user = User::factory()->create();
    actingAs($this->user);
});

test('client creation', function () {
    $client = Client::factory()->create();

    expect($client->user_id)->toBe($this->user->id)
        ->and($client->first_name)->not()->toBeNull()
        ->and($client->surname)->not()->toBeNull()
        ->and($client->social_security_number)->not()->toBeNull();
});

test('client update', function () {
    $user = User::factory()->create();
    $client = Client::factory()->create(['user_id' => $user->id]);

    $client->update(['first_name' => 'New First Name']);

    expect($client->fresh()->first_name)->toBe('New First Name');
});

test('client deletion', function () {
    $user = User::factory()->create();
    $client = Client::factory()->create(['user_id' => $user->id]);

    $client->delete();

    expect(Client::find($client->id))->toBeNull();
});

test('client relationship with user', function () {
    $client = Client::factory()->create();

    expect($client->user_id)->toBe($this->user->id);
});

test('client scope', function () {
    $client = Client::factory()->create();

    $clients = Client::whereUserId($this->user->id)->get();

    expect($clients->contains($client))->toBeTrue();
});
