<?php

namespace App\Repositories;

use App\Models\Client;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class ClientRepository
 *
 * This repository class handles data operations related to the Client model.
 * It leverages the base Repository class to provide common CRUD functionalities
 * and may include additional client-specific data operations.
 *
 * @package App\Repositories
 */
class ClientRepository extends Repository
{
    /**
     * Construct a new ClientRepository.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        // Initialize the parent class with a Client instance.
        parent::__construct($client);
    }

    public function paginate(int $rows): LengthAwarePaginator
    {
        return $this->model->paginate($rows);
    }
}
