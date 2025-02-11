<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;
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
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        if (!Gate::allows('admin-user')) {
            // If not, abort with a 403 status code.
            abort(Response::HTTP_FORBIDDEN);
        }
        return UserResource::collection($this->userService->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): UserResource
    {
        if (!Gate::allows('admin-user')) {
            // If not, abort with a 403 status code.
            abort(Response::HTTP_FORBIDDEN);
        }

        return UserResource::make($this->userService->store($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $user): UserResource
    {
        return UserResource::make($this->userService->find($user));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, int $user): UserResource
    {
        if (!Gate::allows('admin-user')) {
            // If not, abort with a 403 status code.
            abort(Response::HTTP_FORBIDDEN);
        }

        return UserResource::make($this->userService->update($user, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $user): \Illuminate\Http\Response
    {
        if (!Gate::allows('admin-user')) {
            // If not, abort with a 403 status code.
            abort(Response::HTTP_FORBIDDEN);
        }
        $this->userService->delete($user);
        return response()->noContent();
    }
}
