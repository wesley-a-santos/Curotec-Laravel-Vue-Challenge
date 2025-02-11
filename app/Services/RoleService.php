<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use Illuminate\Database\Eloquent\Collection;

class RoleService
{
    public function __construct(protected RoleRepository $roleRepository)
    {
    }

    /**
     * Return all the models.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->roleRepository->all();
    }
}
