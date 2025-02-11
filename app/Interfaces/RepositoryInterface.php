<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface RepositoryInterface
 *
 * Defines the common operations for all repositories.
 *
 * @package App\Interfaces
 * @author  Wesley Santos <wesley.a.santos@gmail.com>
 */
interface RepositoryInterface
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
     * @return Model|null
     */
    public function find(int $id): ?Model;

    /**
     * Store a new record in the repository.
     *
     * @param array $data
     * @return Model
     */
    public function store(array $data): Model;


    /**
     * Update a record in the repository.
     *
     * @param int $id
     * @param array $data
     * @return Model|null
     */
    public function update(int $id, array $data): ?Model;

    /**
     * Delete a record from the repository.
     *
     * @param int $id The id of the record to delete.
     * @return void
     */
    public function delete(int $id): void;
}
