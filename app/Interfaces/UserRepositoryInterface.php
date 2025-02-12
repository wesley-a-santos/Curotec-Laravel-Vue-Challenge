<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface for the User model repository.
 *
 * This interface defines the basic functionality for the User model repository.
 * It provides a facade to the User model and hides the complexity of the
 * associated database operations.
 *
 * @package App\Interfaces
 * @author  Wesley Santos <wesley.a.santos@gmail.com>
 */
interface UserRepositoryInterface
{
    /**
     * Returns all records from the repository.
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Find a record by id.
     *
     * @param int $id
     * @return User|null
     */
    public function find(int $id): ?User;

    /**
     * Store a new record in the repository.
     *
     * @param array $data
     * @return User
     */
    public function create(array $data): User;

    /**
     * Update a record in the repository.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete a record from the repository.
     *
     * @param int $id The id of the record to delete.
     * @return void
     */
    public function destroy(int $id): void;

    /**
     * Return a paginated list of records from the repository.
     *
     * @param int $rows The number of records per page.
     * @return LengthAwarePaginator The paginated list of records.
     */
    public function paginate(int $rows): LengthAwarePaginator;

    /**
     * Find a user by its email address.
     *
     * @param string $email The email address of the user.
     * @return User|null The user instance if found, or null.
     */
    public function findByEmail(string $email): ?User;
}
