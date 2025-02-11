<?php

namespace App\Http\Resources;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * RoleResource class.
 *
 * @mixin Role
 *
 * @property int $id
 * @property string $name
 */
class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Role $this */
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}
