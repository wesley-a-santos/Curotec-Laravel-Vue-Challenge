<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Resources\ClientResource;
use App\Http\Resources\GenderResource;
use App\Models\Client;
use App\Services\ClientService;
use App\Services\GenderService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
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
     * ClientController constructor.
     *
     * @param ClientService $clientService Service for handling client operations.
     * @param GenderService $genderService Service for handling gender-related operations.
     */
    public function __construct(
        private readonly ClientService $clientService,
        private readonly GenderService $genderService
    )
    {
        // Initialize the ClientController with the necessary service instances.
    }


    /**
     * Returns a list of all clients.
     *
     * @throws AuthorizationException Thrown if the user doesn't have the required permissions.
     *
     * @return Response The HTTP response containing the list of clients.
     */
    public function index(): Response
    {
        // Check if the user has the required permissions.
        $this->authorize('viewAny', Client::class);

        // Retrieve a paginated list of clients.
        $clients = $this->clientService->paginate(10);

        // Return the list of clients as an Inertia response.
        return Inertia::render('Client/Index', [
            'clients' => ClientResource::collection($clients),
        ]);
    }


    /**
     * Display the client creation form.
     *
     * @throws AuthorizationException Thrown if the user doesn't have permission to create a client.
     *
     * @return Response The HTTP response for the client creation page.
     */
    public function create(): Response
    {
        // Authorize the action of creating a new client
        $this->authorize('create', Client::class);

        // Retrieve and sort all genders for selection in the client creation form
        $genders = GenderResource::collection($this->genderService->all()->sortBy('name'));

        // Return the Inertia response to render the client creation page with the list of genders
        return Inertia::render('Client/Create', [
            'genders' => $genders
        ]);
    }

    /**
     * Creates a new client in the database with the given request data.
     *
     * @param StoreClientRequest $request The request containing the client data.
     * @return RedirectResponse Redirects to the client index page with a success message.
     * @throws AuthorizationException
     */
    public function store(StoreClientRequest $request): RedirectResponse
    {
        // Authorize the action of creating a new client
        $this->authorize('create', Client::class);

        // Validate the request data using the provided request class.
        $requestData = $request->validated();

        // Store the client in the database using the client service.
        $client = $this->clientService->store($requestData);

        // Redirect to the client index page with a success message.
        return redirect()->route('clients.index', $client)->with('message', 'Client created successfully.');
    }

    /**
     * Show the specified client in the database.
     *
     * @param int $client The ID of the client to show.
     * @return Response The HTTP response for the client show page.
     * @throws AuthorizationException Thrown if the user doesn't have permission to show the client.
     */
    public function show(int $client): Response
    {
        // Retrieve the client from the database using the client service.
        $clientFind = $this->clientService->find($client);

        // Authorize the action of showing the client.
        $this->authorize('view', $clientFind);

        // Return the Inertia response to render the client show page.
        return Inertia::render('Client/Show', [
            'client' => ClientResource::make($clientFind)
        ]);
    }


    /**
     * Show the form for editing the specified client.
     *
     * @param int $client The ID of the client to edit.
     * @return Response The HTTP response for the client edit page.
     * @throws AuthorizationException Thrown if the user doesn't have permission to edit the client.
     */
    public function edit(int $client): Response
    {
        // Retrieve the client from the database using the client service.
        $clientFind = $this->clientService->find($client);

        // Authorize the action of updating the client.
        $this->authorize('update', $clientFind);

        // Retrieve and sort all genders for selection in the client edit form.
        $genders = GenderResource::collection($this->genderService->all()->sortBy('name'));

        // Return the Inertia response to render the client edit page with the client and list of genders.
        return Inertia::render('Client/Edit', [
            'client' => ClientResource::make($clientFind),
            'genders' => $genders
        ]);
    }

    /**
     * Updates the specified client in the database.
     *
     * @param int $client The ID of the client to update.
     * @param UpdateClientRequest $request The request containing the new data for the client.
     * @return RedirectResponse Redirects to the client index page with a success message.
     * @throws AuthorizationException Thrown if the user doesn't have permission to update the client.
     */
    public function update(int $client, UpdateClientRequest $request): RedirectResponse
    {
        // Retrieve the client from the database using the client service.
        $clientFind = $this->clientService->find($client);

        // Authorize the action of updating the client.
        $this->authorize('update', $clientFind);

        // Update the client in the database using the client service.
        $this->clientService->update($client, $request->validated());

        // Redirect to the client index page with a success message.
        return redirect()->route('clients.index')
            ->with('message', 'Client updated successfully');
    }

    /**
     * Deletes the specified client from the database.
     *
     * @param int $client The ID of the client to delete.
     * @return RedirectResponse Redirects to the client index page with a success message.
     * @throws AuthorizationException Thrown if the user doesn't have permission to delete the client.
     */
    public function destroy(int $client): RedirectResponse
    {
        // Retrieve the client from the database using the client service.
        $clientFind = $this->clientService->find($client);

        // Authorize the action of deleting the client.
        $this->authorize('delete', $clientFind);

        // Delete the client from the database using the client service.
        $this->clientService->delete($client);

        // Redirect to the client index page with a success message.
        return redirect()->route('clients.index')
            ->with('message', 'Client deleted successfully');
    }

}
