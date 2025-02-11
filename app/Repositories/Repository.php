<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

/**
 * A basic repository class.
 *
 * This class provides basic CRUD operations:
 *     - `all()`: Return all the models.
 *     - `find(int $id)`: Return a model instance by its primary key.
 *     - `create(array $data)`: Create a new model instance.
 *     - `update(int $id, array $data)`: Update a model instance by its primary key.
 *     - `delete(int $id)`: Delete a model instance by its primary key.
 *
 * @package App\Repositories
 * @author  Wesley Santos <wesley.a.santos@gmail.com>
 */
class Repository implements RepositoryInterface
{
    /**
     * Create a new repository instance.
     *
     * @param  Model  $model  The model instance.
     */
    public function __construct(protected readonly Model $model)
    {
        //
    }

    /**
     * Return all the models.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }


    /**
     * Find a model instance by its primary key.
     *
     * @param int $id The primary key of the model.
     * @return Model|null The model instance if found, or null.
     * @throws ResourceNotFoundException if the model is not found.
     */
    public function find(int $id): ?Model
    {
        $model = $this->model->find($id);

        // Check if the model was not found.
        if (!$model) {
            // Throw a ResourceNotFoundException if the model was not found.
            abort(Response::HTTP_NOT_FOUND);
        }

        // Return the found model instance.
        return $model;
    }

    /**
     * Create a new model instance.
     *
     * @param array $data
     * @return Model
     */
    public function store(array $data): Model
    {
        // Create a new model instance and save it to the database.
        return $this->model->create($data);
    }


    /**
     * Update a model instance by its primary key.
     *
     * @param int $id The primary key of the model.
     * @param array $data The data to update the model with.
     * @return Model|null The updated model instance.
     * @throws ResourceNotFoundException if the model is not found.
     */
    public function update(int $id, array $data): ?Model
    {
        // Find the model instance by its primary key.
        $model = $this->find($id);

        // Update the model instance with the provided data.
        $model->update($data);

        // Return the updated model instance.
        return $model;
    }

    /**
     * Delete a model instance by its primary key.
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        // Find a model instance by its primary key and delete it.
        $this->model->destroy($id);
    }
}
