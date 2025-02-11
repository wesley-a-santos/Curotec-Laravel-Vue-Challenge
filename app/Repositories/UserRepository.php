<?php

namespace App\Repositories;

use App\Models\User;

/**
 * Class UserRepository
 *
 * This repository class handles data operations related to the User model.
 * It leverages the base Repository class to provide common CRUD functionalities
 * and may include additional user-specific data operations.
 *
 * @package App\Repositories
 */
class UserRepository extends Repository
{
    /**
     * Construct a new UserRepository.
     *
     * @param  User  $user
     */
    public function __construct(User $user)
    {
        // Initialize the parent class with a User instance.
        parent::__construct($user);
    }

    /**
     * Find a user by its email address.
     *
     * @param string $email The email address of the user.
     * @return User|null The user instance if found, or null.
     */
    public function findByEmail(string $email): ?User
    {
        // Use the Eloquent Builder to find a user by its email address.
        // The `first()` method is used to retrieve the first matching record.
        // If no record is found, the `first()` method will return null.
        return $this->model->where('email', '=', $email)->first();
    }
}
