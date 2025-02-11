<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGenderRequest;
use App\Http\Requests\UpdateGenderRequest;
use App\Http\Resources\GenderResource;
use App\Services\GenderService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GenderController
 *
 * @package App\Http\Controllers
 */
class GenderController extends Controller
{
    /**
     * GenderController constructor.
     *
     * @param GenderService $genderService
     */
    public function __construct(private readonly GenderService $genderService)
    {
        // Initialize the GenderController with a GenderService instance.
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        if (!Gate::allows('admin-gender')) {
            // If not, abort with a 403 status code.
            abort(Response::HTTP_FORBIDDEN);
        }
        return GenderResource::collection($this->genderService->all());
    }
}
