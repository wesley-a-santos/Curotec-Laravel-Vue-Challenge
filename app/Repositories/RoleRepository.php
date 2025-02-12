<?php

namespace App\Repositories;

use App\Interfaces\RoleRepositoryInterface;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class RoleRepository
 *
 * This repository class handles data operations related to the Role model.
 * It leverages the base Repository class to provide common CRUD functionalities
 * and may include additional role-specific data operations.
 *
 * @package App\Repositories
 * @author  Wesley Santos <wesley.a.santos@gmail.com>
 */
class RoleRepository  implements RoleRepositoryInterface
{

    /**
     * Retrieve all roles from the database.
     *
     * @return Collection A collection of Role models.
     */
    public function all(): Collection
    {
        // Fetch all records from the roles table
        return Role::all();
    }
}
