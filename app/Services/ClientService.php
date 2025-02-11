<?php

namespace App\Services;

use App\Models\Client;
use App\Repositories\ClientRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Service to encapsulate the logic of the Client model.
 *
 * The purpose of this service is to encapsulate all the logic of the Client model.
 * It provides a facade to the Client model and hides the complexity of the
 * associated database operations.
 *
 * @package App\Services
 * @author  Wesley Santos <wesley.a.santos@gmail.com>
 */
class ClientService
{
    /**
     * Constructor
     *
     * Initialize the service with a ClientRepository instance.
     *
     * @param ClientRepository $clientRepository
     */
    public function __construct(protected readonly ClientRepository $clientRepository)
    {
        // Initialize the service
    }

    /**
     * Get all the clients.
     *
     * @return Collection<Client>
     */
    public function all(): Collection
    {
        return $this->clientRepository->all();
    }

    /**
     * Get a client by ID.
     *
     * @param int $id The ID of the client to retrieve.
     * @return Client|null The client with the specified ID if it exists; otherwise, null.
     */
    public function find(int $id): ?Client
    {
        // Delegate the find operation to the clientRepository
        return $this->clientRepository->find($id);
    }

    /**
     * Store a new client.
     *
     * @param array $data The data to create the client with.
     * @return Client The newly created client.
     */
    public function store(array $data): Client
    {
        // Create a new model instance and save it to the database.
        return $this->clientRepository->store($data);
    }


    /**
     * Update a client by ID.
     *
     * @param int $id The ID of the client to update.
     * @param array $data The data to update the client with.
     * @return Client|null The updated client if it exists; otherwise, null.
     */
    public function update(int $id, array $data): ?Client
    {
        // Find a model instance by its primary key and update it with the given data.
        return $this->clientRepository->update($id, $data);
    }

    /**
     * Delete a client by ID.
     *
     * This method deletes a client.
     *
     * @param int $id The ID of the client to delete.
     * @return void
     */
    public function delete(int $id): void
    {
        // Finally, delete the client itself.
        $this->clientRepository->delete($id);
    }

    /**
     * Get a paginated list of clients.
     *
     * @param int $rows The number of rows to return per page.
     * @return LengthAwarePaginator The paginated list of clients.
     */
    public function paginate(int $rows): LengthAwarePaginator
    {
        // Delegate the pagination to the clientRepository
        return $this->clientRepository->paginate($rows);
    }
}
