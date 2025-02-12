<?php

namespace App\Interfaces;

use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface for the Client model repository.
 *
 * This interface defines the basic functionality for the Client model repository.
 * It provides a facade to the Client model and hides the complexity of the
 * associated database operations.
 *
 * @package App\Interfaces
 * @author  Wesley Santos <wesley.a.santos@gmail.com>
 */
interface ClientRepositoryInterface
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
     * @return Client|null
     */
    public function find(int $id): ?Client;

    /**
     * Store a new record in the repository.
     *
     * @param array $data
     * @return Client
     */
    public function create(array $data): Client;


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
}
