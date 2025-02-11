<?php

use App\Models\Client;
use App\Models\Gender;
use App\Models\User;
use App\Repositories\ClientRepository;
use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->user = User::factory()->create();
    actingAs($this->user);
});

test('client repository creation', function () {
    $clientRepository = new ClientRepository(new Client());

    expect($clientRepository)->toBeInstanceOf(ClientRepository::class);
});

test('client repository all', function () {
    $clientRepository = new ClientRepository(new Client());
    $clients = $clientRepository->all();

    expect($clients)->toBeInstanceOf(Illuminate\Database\Eloquent\Collection::class);
});

test('client repository find', function () {
    $clientRepository = new ClientRepository(new Client());
    $client = Client::factory()->create();
    $foundClient = $clientRepository->find($client->id);

    expect($foundClient->id)->toBe($client->id);
});

test('client repository store', function () {
    $clientRepository = new ClientRepository(new Client());
    $data = [
        'first_name' => 'John',
        'surname' => 'Doe',
        'social_security_number' => '1234567890',
        'gender_id' => Gender::MALE,
        'birth_date' => '1990-01-01',
        'first_contact_date' => '2020-01-01'
    ];
    $createdClient = $clientRepository->store($data);

    expect($createdClient)->toBeInstanceOf(Client::class)
        ->and($createdClient->first_name)->toBe('John')
        ->and($createdClient->surname)->toBe('Doe')
        ->and($createdClient->social_security_number)->toBe('1234567890');
});

test('client repository update', function () {
    $clientRepository = new ClientRepository(new Client());
    $client = Client::factory()->create();
    $data = ['first_name' => 'Jane'];
    $updatedClient = $clientRepository->update($client->id, $data);

    expect($updatedClient->id)->toBe($client->id)
        ->and($updatedClient->first_name)->toBe('Jane');
});

test('client repository delete', function () {
    $clientRepository = new ClientRepository(new Client());
    $client = Client::factory()->create();
    $clientRepository->delete($client->id);

    expect(Client::find($client->id))->toBeNull();
});

test('client repository paginate', function () {
    $clientRepository = new ClientRepository(new Client());
    $clients = $clientRepository->paginate(10);

    expect($clients)->toBeInstanceOf(Illuminate\Pagination\LengthAwarePaginator::class);
});
