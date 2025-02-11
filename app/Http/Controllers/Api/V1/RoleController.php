<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Services\RoleService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class RoleController
 *
 * @package App\Http\Controllers
 */
class RoleController extends Controller
{
    /**
     * RoleController constructor.
     *
     * @param RoleService $roleService
     */
    public function __construct(private readonly RoleService $roleService)
    {
        // Initialize the RoleController with a RoleService instance.

    }

    /**
     * Return all the models.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        // Call the all method on the RoleService to get all the models.
        return RoleResource::collection($this->roleService->all());
    }

}
