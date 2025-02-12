<?php

namespace App\Repositories;

use App\Interfaces\ClientRepositoryInterface;
use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class ClientRepository
 *
 * This repository class handles data operations related to the Client model.
 * It leverages the base Repository class to provide common CRUD functionalities
 * and may include additional client-specific data operations.
 *
 * @package App\Repositories
 * @author  Wesley Santos <wesley.a.santos@gmail.com>
 */
class ClientRepository implements ClientRepositoryInterface
{
    /**
     * Retrieve all clients.
     *
     * @return Collection The collection of Client models.
     */
    public function all(): Collection
    {
        // Delegate the retrieval of all clients to the model.
        return Client::all();
    }

    /**
     * Find a client by ID.
     *
     * @param int $id The ID of the client to find.
     * @return Model|null The client model if found; otherwise, null.
     */
    public function find(int $id): ?Client
    {
        // Attempt to find the client by ID or fail if not found.
        return Client::findOrFail($id);
    }

    /**
     * Create a new client record in the database.
     *
     * @param array $data An associative array containing client data.
     * @return Client The newly created Client model instance.
     */
    public function create(array $data): Client
    {
        // Insert a new record into the clients table and return the created Client model
        return Client::create($data);
    }

    /**
     * Update a client record in the database.
     *
     * @param int $id The ID of the client to update.
     * @param array $data An associative array containing client data.
     *
     * @return bool True if the client was updated successfully; otherwise, false.
     */
    public function update(int $id, array $data): bool
    {
        // Update the client record in the database.
        return Client::where('id', '=', $id)->update($data);
    }

    /**
     * Delete a client record from the database.
     *
     * @param int $id The ID of the client to delete.
     */
    public function destroy(int $id): void
    {
        // Delete the client record with the specified ID from the database.
        Client::destroy($id);
    }

    /**
     * Retrieve a paginated list of clients.
     *
     * @param int $rows The number of rows to return per page.
     *
     * @return LengthAwarePaginator The paginated list of clients.
     */
    public function paginate(int $rows): LengthAwarePaginator
    {
        // Delegate the pagination to the model.
        return Client::paginate($rows);
    }
}
