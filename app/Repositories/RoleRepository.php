<?php

namespace App\Repositories;

use App\Models\Role;

/**
 * Class RoleRepository
 *
 * This repository class handles data operations related to the Role model.
 * It leverages the base Repository class to provide common CRUD functionalities
 * and may include additional role-specific data operations.
 *
 * @package App\Repositories
 */
class RoleRepository extends Repository
{
    /**
     * Construct a new RoleRepository.
     *
     * @param  Role  $role
     */
    public function __construct(Role $role)
    {
        // Initialize the parent class with a Role instance.

        parent::__construct($role);
    }
}
