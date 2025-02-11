<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Services\ClientService;
use App\Services\SocialMediaService;
use Illuminate\Auth\Access\AuthorizationException;

/**
 * Class ClientController
 *
 * @package App\Http\Controllers
 */
class ClientController extends Controller
{
    /**
     * ClientController constructor.
     *
     * @param ClientService $clientService
     */
    public function __construct(private readonly ClientService $clientService)
    {
        // Initialize the ClientController with a SocialMediaService instance.
    }


    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $this->authorize('viewAny', Client::class);

        return ClientResource::collection($this->clientService->all());
    }

    /**
     * Store a newly created resource in storage.
     * @throws AuthorizationException
     */
    public function store(StoreClientRequest $request): ClientResource
    {
        $this->authorize('create', Client::class);

        return ClientResource::make($this->clientService->store($request->validated()));
    }


    /**
     * Display the specified resource.
     * @throws AuthorizationException
     */
    public function show(int $client): ClientResource
    {
        $clientFind = $this->clientService->find($client);

        $this->authorize('update', $clientFind);

        return ClientResource::make($this->clientService->find($client));
    }

    /**
     * Update the specified resource in storage.
     * @throws AuthorizationException
     */
    public function update(UpdateClientRequest $request, int $client): ClientResource
    {
        $clientFind = $this->clientService->find($client);

        $this->authorize('update', $clientFind);

        return ClientResource::make($this->clientService->update($clientFind, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     * @throws AuthorizationException
     */
    public function destroy(int $client): \Illuminate\Http\Response
    {
        $clientFind = $this->clientService->find($client);

        $this->authorize('update', $clientFind);

        $this->clientService->delete($client);

        return response()->noContent();
    }
}
