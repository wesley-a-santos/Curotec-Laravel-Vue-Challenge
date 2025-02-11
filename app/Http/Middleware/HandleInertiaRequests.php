<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * This method is called on every request and can be used to share
     * common data between components. The data can be accessed in components
     * via the `$page.props` property.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                // The user object is shared by default so that we can access
                // it in any component.
                'user' => $request->user(),

                // This boolean is used to conditionally render elements that
                // should only be visible to admins.
                'isAdmin' => $request->user()?->isAdmin(),
            ],
            'flash' => [
                // The flash message is shared by default so that we can access
                // it in any component. It is cleared after the first render.
                'message' => fn () => $request->session()->get('message')
            ],
        ];
    }
}
