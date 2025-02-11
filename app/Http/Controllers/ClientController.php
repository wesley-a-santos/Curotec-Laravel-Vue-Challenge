<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use App\Http\Resources\GenderResource;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Auth\Access\AuthorizationException;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Class ClientController
 *
 * @package App\Http\Controllers
 */
class ClientController extends Controller
{
    /**
     * @param ClientService $clientService
     */
    public function __construct(private readonly ClientService $clientService)
    {
        // Initialize the ClientController with a SocialMediaService instance.
    }


    /**
     * @throws AuthorizationException
     */
    public function index(): Response
    {
        $this->authorize('viewAny', Client::class);

        return Inertia::render('Client/Index');
    }


    /**
     * @throws AuthorizationException
     */
    public function create(): Response
    {
        $this->authorize('create', Client::class);

        return Inertia::render('Client/Create');
    }

    /**
     * @throws AuthorizationException
     */
    public function show(int $client): Response
    {
        $clientFind = $this->clientService->find($client);

        $this->authorize('update', $clientFind);

        return Inertia::render('Client/Show');
    }


    /**
     * @throws AuthorizationException
     */
    public function edit(int $client): Response
    {
        $clientFind = $this->clientService->find($client);

        $this->authorize('update', $clientFind);

        return Inertia::render('Client/Edit');
    }

}
