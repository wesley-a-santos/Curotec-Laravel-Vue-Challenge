<?php

namespace App\Repositories;

use App\Interfaces\GenderRepositoryInterface;
use App\Models\Gender;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class GenderRepository
 *
 * This repository class handles data operations related to the Gender model.
 * It leverages the base Repository class to provide common CRUD functionalities
 * and may include additional gender-specific data operations.
 *
 * @package App\Repositories
 * @author  Wesley Santos <wesley.a.santos@gmail.com>
 */
class GenderRepository implements GenderRepositoryInterface
{

    /**
     * Retrieve all genders from the database.
     *
     * @return Collection A collection of Gender models.
     */
    public function all(): Collection
    {
        // Delegate the retrieval of all genders to the model.
        return Gender::all();
    }
}
