<?php

namespace App\Services;

use App\Interfaces\GenderRepositoryInterface;
use App\Models\Gender;
use Illuminate\Database\Eloquent\Collection;

/**
 * Service to encapsulate the logic of the Gender model.
 *
 * The purpose of this service is to encapsulate all the logic of the Gender model.
 * It provides a facade to the Gender model and hides the complexity of the
 * associated database operations.
 *
 * @package App\Services
 * @author  Wesley Santos <wesley.a.santos@gmail.com>
 */
class GenderService
{
    /**
     * GenderService constructor.
     *
     * @param GenderRepositoryInterface $genderRepository The repository for gender-related data operations.
     */
    public function __construct(protected readonly GenderRepositoryInterface $genderRepository)
    {
        // Initialize the GenderService with a GenderRepository instance.
    }

    /**
     * Get all genders.
     *
     * @return Collection<Gender>
     */
    public function all(): Collection
    {
        return $this->genderRepository->all();
    }

}
