<?php

use App\Interfaces\UserRepositoryInterface;
use App\Models\Role;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;

test('user repository creation', function () {
    $userRepository = new UserRepository();

    expect($userRepository)->toBeInstanceOf(UserRepositoryInterface::class);
});

test('user repository all', function () {
    $userRepository = new UserRepository();
    $users = $userRepository->all();

    expect($users)->toBeInstanceOf(Collection::class);
});

test('user repository find', function () {
    $userRepository = new UserRepository();
    $user = User::factory()->create();
    $foundUser = $userRepository->find($user->id);

    expect($foundUser->id)->toBe($user->id);
});

test('user repository store', function () {
    $userRepository = new UserRepository();
    $data = ['name' => 'John Doe', 'email' => 'john@example.com', 'password' => 'password', 'role_id' => Role::ADMIN];
    $createdUser = $userRepository->create($data);

    expect($createdUser)->toBeInstanceOf(User::class)
        ->and($createdUser->name)->toBe('John Doe')
        ->and($createdUser->email)->toBe('john@example.com');
});

test('user repository update', function () {
    $userRepository = new UserRepository();
    $user = User::factory()->create();
    $data = ['name' => 'Jane Doe'];
    $updatedUser = $userRepository->update($user->id, $data);

    expect($updatedUser)->toBeTrue()
        ->and($userRepository->find($user->id)->name)->toBe('Jane Doe');
});

test('user repository delete', function () {
    $userRepository = new UserRepository();
    $user = User::factory()->create();
    $userRepository->destroy($user->id);

    expect(User::find($user->id))->toBeNull();
});

test('user repository paginate', function () {
    $userRepository = new UserRepository();
    $users = $userRepository->paginate(10);

    expect($users)->toBeInstanceOf(Illuminate\Pagination\LengthAwarePaginator::class);
});

test('user repository findByEmail', function () {
    $userRepository = new UserRepository();
    $user = User::factory()->create();
    $foundUser = $userRepository->findByEmail($user->email);

    expect($foundUser->id)->toBe($user->id);
});
