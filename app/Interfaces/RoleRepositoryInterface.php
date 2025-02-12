<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

/**
 * Interface for the Role model repository.
 *
 * This interface defines the basic functionality for the Role model repository.
 * It provides a facade to the Role model and hides the complexity of the
 * associated database operations.
 *
 * @package App\Interfaces
 * @author  Wesley Santos <wesley.a.santos@gmail.com>
 */
interface RoleRepositoryInterface
{
    /**
     * Returns all records from the repository.
     *
     * @return Collection
     */
    public function all(): Collection;

}
