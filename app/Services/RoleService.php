<?php

namespace App\Services;

use App\Interfaces\RoleRepositoryInterface;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

/**
 * Service to encapsulate the logic of the Role model.
 *
 * The purpose of this service is to encapsulate all the logic related to the Role model.
 * It provides a facade to the Role model and hides the complexity of the
 * associated database operations.
 *
 * @package App\Services
 * @author  Wesley Santos <wesley.a.santos@gmail.com>
 */
class RoleService
{
    /**
     * RoleService constructor.
     *
     * @param RoleRepositoryInterface $roleRepository The repository for role-related data operations.
     */
    public function __construct(protected readonly RoleRepositoryInterface $roleRepository)
    {
        // Initialize the RoleService with a RoleRepository instance.
    }

    /**
     * Get all roles.
     *
     * @return Collection<Role>
     */
    public function all(): Collection
    {
        return $this->roleRepository->all();
    }

}
