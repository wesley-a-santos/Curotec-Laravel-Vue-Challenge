<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\RoleResource;
use App\Models\User;
use App\Services\UserService;
use App\Services\RoleService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * UserController constructor.
     *
     * @param UserService $userService Service for handling user operations.
     * @param RoleService $roleService Service for handling role-related operations.
     */
    public function __construct(
        private readonly UserService $userService,
        private readonly RoleService $roleService
    )
    {
        // Initialize the UserController with the necessary service instances.
    }


    /**
     * Returns a list of all users.
     *
     * @return Response The HTTP response containing the list of users.
     */
    public function index(): Response
    {
        // Check if the user has the right permissions to access the users.
        if (!Gate::allows('admin-user')) {
            // If not, abort with a 403 status code.
            abort(\Symfony\Component\HttpFoundation\Response::HTTP_FORBIDDEN);
        }

        $users = Cache::tags('users')->remember('users-' . request()->query('page', 1), 300, function () {
            return $this->userService->paginate(10);
        });

        // Return the list of users as an Inertia response.
        return Inertia::render('User/Index', [
            'users' => UserResource::collection($users),
        ]);
    }


    /**
     * Display the user creation form.
     *
     * @return Response The HTTP response for the user creation page.
     */
    public function create(): Response
    {
        // Check if the user has the right permissions to access the users.
        if (!Gate::allows('admin-user')) {
            // If not, abort with a 403 status code.
            abort(\Symfony\Component\HttpFoundation\Response::HTTP_FORBIDDEN);
        }

        // Retrieve and sort all roles for selection in the user creation form
        $roles = RoleResource::collection($this->roleService->all()->sortBy('name'));

        // Return the Inertia response to render the user creation page with the list of roles
        return Inertia::render('User/Create', [
            'roles' => $roles
        ]);
    }

    /**
     * Creates a new user in the database with the given request data.
     *
     * @param StoreUserRequest $request The request containing the user data.
     * @return RedirectResponse Redirects to the user index page with a success message.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        // Check if the user has the right permissions to access the users.
        if (!Gate::allows('admin-user')) {
            // If not, abort with a 403 status code.
            abort(\Symfony\Component\HttpFoundation\Response::HTTP_FORBIDDEN);
        }

        // Validate the request data using the provided request class.
        $requestData = $request->validated();

        // Store the user in the database using the user service.
        $this->userService->create($requestData);

        Cache::tags('users')->clear();


        // Redirect to the user index page with a success message.
        return redirect()->route('users.index')->with('message', 'User created successfully.');
    }

    /**
     * Show the specified user in the database.
     *
     * @param int $user The ID of the user to show.
     * @return Response The HTTP response for the user show page.
     */
    public function show(int $user): Response
    {
// Check if the user has the right permissions to access the users.
        if (!Gate::allows('admin-user')) {
            // If not, abort with a 403 status code.
            abort(\Symfony\Component\HttpFoundation\Response::HTTP_FORBIDDEN);
        }

        // Retrieve the user from the database using the user service.
        $userFind = $this->userService->find($user);

        // Return the Inertia response to render the user show page.
        return Inertia::render('User/Show',[
            'user' => UserResource::make($userFind)
        ]);
    }


    /**
     * Show the form for editing the specified user.
     *
     * @param int $user The ID of the user to edit.
     * @return Response The HTTP response for the user edit page.
     */
    public function edit(int $user): Response
    {
        // Check if the user has the right permissions to access the users.
        if (!Gate::allows('admin-user')) {
            // If not, abort with a 403 status code.
            abort(\Symfony\Component\HttpFoundation\Response::HTTP_FORBIDDEN);
        }

        // Retrieve the user from the database using the user service.
        $userFind = $this->userService->find($user);

        // Retrieve and sort all roles for selection in the user edit form.
        $roles = RoleResource::collection($this->roleService->all()->sortBy('name'));

        // Return the Inertia response to render the user edit page with the user and list of roles.
        return Inertia::render('User/Edit', [
            'user' => UserResource::make($userFind),
            'roles' => $roles
        ]);
    }

    /**
     * Updates the specified user in the database.
     *
     * @param int $user The ID of the user to update.
     * @param UpdateUserRequest $request The request containing the new data for the user.
     * @return RedirectResponse Redirects to the user index page with a success message.
     */
    public function update(int $user, UpdateUserRequest $request): RedirectResponse
    {
        // Check if the user has the right permissions to access the users.
        if (!Gate::allows('admin-user')) {
            // If not, abort with a 403 status code.
            abort(\Symfony\Component\HttpFoundation\Response::HTTP_FORBIDDEN);
        }

        // Update the user in the database using the user service.
        $this->userService->update($user, $request->validated());

        Cache::tags('users')->clear();

        // Redirect to the user index page with a success message.
        return redirect()->route('users.index')
            ->with('message', 'User updated successfully');
    }

    /**
     * Deletes the specified user from the database.
     *
     * @param int $user The ID of the user to delete.
     * @return RedirectResponse Redirects to the user index page with a success message.
     */
    public function destroy(int $user): RedirectResponse
    {
        // Check if the user has the right permissions to access the users.
        if (!Gate::allows('admin-user')) {
            // If not, abort with a 403 status code.
            abort(\Symfony\Component\HttpFoundation\Response::HTTP_FORBIDDEN);
        }

        // Delete the user from the database using the user service.
        $this->userService->destroy($user);

        Cache::tags('users')->clear();

        // Redirect to the user index page with a success message.
        return redirect()->route('users.index')
            ->with('message', 'User deleted successfully');
    }

}
