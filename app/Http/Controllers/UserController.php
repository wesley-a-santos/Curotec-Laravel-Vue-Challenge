<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

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
     * @param UserService $userService
     */
    public function __construct(private readonly UserService $userService)
    {
        // Initialize the UserController with a UserService instance.
    }

    /**
     * Returns a list of all users.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        // Check if the user has the right permissions to access the users.
        if (!Gate::allows('admin-user')) {
            // If not, abort with a 403 status code.
            abort(Response::HTTP_FORBIDDEN);
        }

        // Get all users from the database.
        $users = $this->userService->all();

        // Return a response with the users.
        return Inertia::render('Users/Index', [
            'users' => UserResource::collection($users)
        ]);
    }


    /**
     * Show the form for creating a new user.
     *
     * @return \Inertia\Response
     */
    public function create(): \Inertia\Response
    {
        // Check if the user has the right permissions to create a user.
        if (!Gate::allows('admin-user')) {
            // If not, abort with a 403 status code.
            abort(Response::HTTP_FORBIDDEN);
        }

        // Render the 'Users/Create' view.
        return Inertia::render('Users/Create');
    }

    /**
     * Display the specified user.
     *
     * @param int $user
     * @return UserResource
     */
    public function show(int $user): UserResource
    {
        // Check if the user has the right permissions to view the user.
        if (!Gate::allows('admin-user')) {
            // If not, abort with a 403 status code.
            abort(Response::HTTP_FORBIDDEN);
        }

        // Return the user from the database as a UserResource.
        return UserResource::make($this->userService->find($user));
    }

    /**
     * Show the form for editing a user.
     *
     * @param int $user
     * @return \Inertia\Response
     */
    public function edit(int $user): \Inertia\Response
    {
        // Check if the user has the right permissions to edit the user.
        if (!Gate::allows('admin-user')) {
            // If not, abort with a 403 status code.
            abort(Response::HTTP_FORBIDDEN);
        }

        // Render the 'Users/Edit' view.
        return Inertia::render('Users/Edit');
    }
}
