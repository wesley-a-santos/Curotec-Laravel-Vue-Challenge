<?php

use App\Models\Role;
use App\Models\User;
use App\Repositories\UserRepository;

test('user repository creation', function () {
    $userRepository = new UserRepository(new User());

    expect($userRepository)->toBeInstanceOf(UserRepository::class);
});

test('user repository all', function () {
    $userRepository = new UserRepository(new User());
    $users = $userRepository->all();

    expect($users)->toBeInstanceOf(Illuminate\Database\Eloquent\Collection::class);
});

test('user repository find', function () {
    $userRepository = new UserRepository(new User());
    $user = User::factory()->create();
    $foundUser = $userRepository->find($user->id);

    expect($foundUser->id)->toBe($user->id);
});

test('user repository store', function () {
    $userRepository = new UserRepository(new User());
    $data = ['name' => 'John Doe', 'email' => 'john@example.com', 'password' => 'password', 'role_id' => Role::ADMIN];
    $createdUser = $userRepository->store($data);

    expect($createdUser)->toBeInstanceOf(User::class)
        ->and($createdUser->name)->toBe('John Doe')
        ->and($createdUser->email)->toBe('john@example.com');
});

test('user repository update', function () {
    $userRepository = new UserRepository(new User());
    $user = User::factory()->create();
    $data = ['name' => 'Jane Doe'];
    $updatedUser = $userRepository->update($user->id, $data);

    expect($updatedUser->id)->toBe($user->id)
        ->and($updatedUser->name)->toBe('Jane Doe');
});

test('user repository delete', function () {
    $userRepository = new UserRepository(new User());
    $user = User::factory()->create();
    $userRepository->delete($user->id);

    expect(User::find($user->id))->toBeNull();
});

test('user repository paginate', function () {
    $userRepository = new UserRepository(new User());
    $users = $userRepository->paginate(10);

    expect($users)->toBeInstanceOf(Illuminate\Pagination\LengthAwarePaginator::class);
});

test('user repository findByEmail', function () {
    $userRepository = new UserRepository(new User());
    $user = User::factory()->create();
    $foundUser = $userRepository->findByEmail($user->email);

    expect($foundUser->id)->toBe($user->id);
});
