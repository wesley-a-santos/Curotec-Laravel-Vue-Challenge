<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

/**
 * Class UserClientsScope
 *
 * This class implements a global scope that automatically adds a constraint
 * to Eloquent queries to filter results by the authenticated user's ID.
 *
 * @package App\Models\Scopes
 */
class UserClientsScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param Builder $builder
     * @param Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model): void
    {
        // Add a constraint to the query to filter by the authenticated user's ID
        $builder->where('user_id', auth()->id());
    }
}
