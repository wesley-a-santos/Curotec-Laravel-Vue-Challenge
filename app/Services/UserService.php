<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Service to encapsulate the logic of the User model.
 *
 * The purpose of this service is to encapsulate all the logic of the User model.
 * It provides a facade to the User model and hides the complexity of the
 * associated database operations.
 *
 * @package App\Services
 * @author  Wesley Santos <wesley.a.santos@gmail.com>
 */
class UserService
{
    /**
     * Constructor
     *
     * Initialize the service with a UserRepository instance.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(protected readonly UserRepository $userRepository)
    {
        // Initialize the service
    }


    /**
     * Get all the users.
     *
     * @return Collection<User>
     */
    public function all(): Collection
    {
        return $this->userRepository->all();
    }


    /**
     * Get a user by ID.
     *
     * @param int $id The ID of the user to retrieve.
     * @return User|null The user with the specified ID if it exists; otherwise, null.
     */
    public function find(int $id): ?User
    {
        // Delegate the find operation to the userRepository
        return $this->userRepository->find($id);
    }


    /**
     * Find a user by its email address.
     *
     * @param string $email The email address of the user.
     * @return User|null The user instance if found, or null.
     */
    public function findByEmail(string $email): ?User
    {
        // Delegate the search operation to the userRepository
        return $this->userRepository->findByEmail($email);
    }


    /**
     * Store a new user.
     *
     * @param array $data The data to create the user with.
     * @return User The newly created user.
     */
    public function store(array $data): User
    {
        // Create a new model instance and save it to the database.
        return $this->userRepository->store($data);
    }


    /**
     * Update a user by ID.
     *
     * @param int $id The ID of the user to update.
     * @param array $data The data to update the user with.
     * @return User|null The updated user if it exists; otherwise, null.
     */
    public function update(int $id, array $data): ?User
    {
        // Find a model instance by its primary key and update it with the given data.
        return $this->userRepository->update($id, $data);
    }


    /**
     * Delete a user by ID.
     *
     * @param int $id The ID of the user to delete.
     * @return void
     */
    public function delete(int $id): void
    {
        // Delegate the delete operation to the userRepository
        $this->userRepository->delete($id);
    }
}
