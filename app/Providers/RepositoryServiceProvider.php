<?php

namespace App\Providers;

use App\Interfaces\ClientRepositoryInterface;
use App\Interfaces\GenderRepositoryInterface;
use App\Interfaces\RoleRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\ClientRepository;
use App\Repositories\GenderRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

/**
 * RepositoryServiceProvider
 *
 * Registers repository interfaces and their corresponding concrete implementations
 * in the Laravel service container, enabling dependency injection and inversion
 * of control for repository classes.
 *
 * This provider is responsible for binding repository interfaces to their
 * implementations, allowing services to depend on abstractions rather than
 * concrete implementations.
 *
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(GenderRepositoryInterface::class, GenderRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        // Register other repository interfaces and implementations here

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
