<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Notifications\UserCreated;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

/**
 * Service to encapsulate the logic of the User model.
 *
 * The purpose of this service is to encapsulate all the logic of the User model.
 * It provides a facade to the User model and hides the complexity of the
 * associated database operations.
 *
 * @package App\Services
 * @author  Wesley Santos <wesley.a.santos@gmail.com>
 */
class UserService
{
    /**
     * Constructor
     *
     * Initialize the service with a UserRepository instance.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(protected readonly UserRepositoryInterface $userRepository)
    {
        // Initialize the service
    }

    /**
     * Get all the users.
     *
     * @return Collection<User>
     */
    public function all(): Collection
    {
        return $this->userRepository->all();
    }


    /**
     * Get a user by ID.
     *
     * @param int $id The ID of the user to retrieve.
     * @return User|null The user with the specified ID if it exists; otherwise, null.
     */
    public function find(int $id): ?User
    {
        // Delegate the find operation to the userRepository
        return $this->userRepository->find($id);
    }


    /**
     * Create a new user.
     *
     * @param array $data The data for the new user.
     * @return User The new user instance.
     */
    public function create(array $data): User
    {
        // Generate a random password for the new user
        $password = fake()->password(8);

        // Encrypt the password before storing
        $data['password'] = Hash::make($password);

        // Store the user in the database using the user repository
        $user = $this->userRepository->create($data);

        // Send a notification with the password to the user
        Notification::send($user, new UserCreated($user->name, $password));

        // Return the new user instance
        return $user;
    }


    /**
     * Update a user by ID.
     *
     * @param int $id The ID of the user to update.
     * @param array $data The data to update the user with.
     * @return bool The updated user if it exists; otherwise, null.
     */
    public function update(int $id, array $data): bool
    {
        // Find a model instance by its primary key and update it with the given data.
        return $this->userRepository->update($id, $data);
    }


    /**
     * Delete a user by ID.
     *
     * @param int $id The ID of the user to delete.
     * @return void
     */
    public function destroy(int $id): void
    {
        // Delegate the delete operation to the userRepository
        $this->userRepository->destroy($id);
    }

    /**
     * Get a paginated list of clients.
     *
     * @param int $rows The number of rows to return per page.
     * @return LengthAwarePaginator The paginated list of clients.
     */
    public function paginate(int $rows): LengthAwarePaginator
    {
        // Delegate the pagination to the clientRepository
        return $this->userRepository->paginate($rows);
    }



    /**
     * Find a user by its email address.
     *
     * @param string $email The email address of the user.
     * @return User|null The user instance if found, or null.
     */
    public function findByEmail(string $email): ?User
    {
        // Delegate the search operation to the userRepository
        return $this->userRepository->findByEmail($email);
    }
}
