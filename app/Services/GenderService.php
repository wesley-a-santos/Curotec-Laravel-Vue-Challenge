<?php

namespace App\Services;

use App\Models\Gender;
use App\Repositories\GenderRepository;
use Illuminate\Database\Eloquent\Collection;

class GenderService
{
    /**
     * GenderService constructor.
     *
     * @param GenderRepository $genderRepository The repository for gender-related data operations.
     */
    public function __construct(protected readonly GenderRepository $genderRepository)
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

    /**
     * Get a gender by ID.
     *
     * @param int $id The ID of the gender to retrieve.
     * @return Gender|null The gender with the specified ID if it exists; otherwise, null.
     */
    public function find(int $id): ?Gender
    {
        return $this->genderRepository->find($id);
    }

    /**
     * Store a new gender.
     *
     * @param array $data The data to create the gender with.
     * @return Gender The newly created gender.
     */
    public function store(array $data): Gender
    {
        return $this->genderRepository->store($data);
    }


    /**
     * Update a gender by ID.
     *
     * @param int   $id   The ID of the gender to update.
     * @param array $data The data to update the gender with.
     * @return Gender|null The updated gender if it exists; otherwise, null.
     */
    public function update(int $id, array $data): ?Gender
    {
        return $this->genderRepository->update($id, $data);
    }


    /**
     * Delete a gender by ID.
     *
     * @param int $id The ID of the gender to delete.
     */
    public function delete(int $id): void
    {
        // Delete the gender by calling the delete method on the GenderRepository instance.
        $this->genderRepository->delete($id);
    }
}
