<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class UserRepository
 *
 * This repository class handles data operations related to the User model.
 * It leverages the base Repository class to provide common CRUD functionalities
 * and may include additional user-specific data operations.
 *
 * @package App\Repositories
 * @author  Wesley Santos <wesley.a.santos@gmail.com>
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * Retrieve all users from the database.
     *
     * @return Collection A collection of User models.
     */
    public function all(): Collection
    {
        // Fetch all records from the users table
        return User::all();
    }

    /**
     * Find a user by ID.
     *
     * @param int $id The ID of the user to retrieve.
     * @return User|null The user with the specified ID if it exists; otherwise, null.
     */
    public function find(int $id): ?User
    {
        return User::findOrFail($id);
    }

    /**
     * Create a new user record in the database.
     *
     * @param array $data An associative array containing user data.
     * @return User The newly created User model instance.
     */
    public function create(array $data): User
    {
        // Insert a new record into the users table and return the created User model
        return User::create($data);
    }

    /**
     * Update a user record in the database.
     *
     * @param int $id The ID of the user to update.
     * @param array $data An associative array containing user data.
     * @return bool True if the user was updated successfully; otherwise, false.
     */
    public function update(int $id, array $data): bool
    {
        // Update a record in the users table and return true if successful; otherwise, false
        return User::where('id', '=', $id)->update($data);
    }

    /**
     * Delete a user record from the database.
     *
     * @param int $id The ID of the user to delete.
     */
    public function destroy(int $id): void
    {
        // Delete a record from the users table
        User::destroy($id);
    }

    /**
     * Return a paginated list of users from the database.
     *
     * @param int $rows The number of records per page.
     * @return LengthAwarePaginator The paginated list of User models.
     */
    public function paginate(int $rows): LengthAwarePaginator
    {
        // Delegate the pagination to the User model.
        return User::paginate($rows);
    }

    /**
     * Find a user by email address.
     *
     * @param string $email The email address to search for.
     * @return User|null The user instance if found, or null.
     */
    public function findByEmail(string $email): ?User
    {
        // Search for the user by their email address
        return User::where('email', '=', $email)->firstOrFail();
    }
}
