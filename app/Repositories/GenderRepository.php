<?php

namespace App\Repositories;

use App\Models\Gender;

/**
 * Class GenderRepository
 *
 * This repository class handles data operations related to the Gender model.
 * It leverages the base Repository class to provide common CRUD functionalities
 * and may include additional gender-specific data operations.
 *
 * @package App\Repositories
 */
class GenderRepository extends Repository
{
    /**
     * Construct a new GenderRepository.
     *
     * @param  Gender  $gender
     */
    public function __construct(Gender $gender)
    {
        // Initialize the parent class with a Gender instance.
        parent::__construct($gender);
    }
}
