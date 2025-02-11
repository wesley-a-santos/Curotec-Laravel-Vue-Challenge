<?php

namespace App\Http\Resources;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * UserResource class.
 *
 * @mixin User
 *
 * @property int         $id
 * @property string      $name
 * @property string      $email
 * @property Role        $role
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var User $this */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role_id'  => $this->role_id,
            'role' => RoleResource::make($this->role),
            'clients_count' => $this->clients_count
        ];
    }
}
