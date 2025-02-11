<?php

namespace App\Http\Resources;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Client $this */
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'surname' => $this->surname,
            'social_security_number' => $this->social_security_number,
            'gender_id' => $this->gender_id,
            'gender' => new GenderResource($this->gender),
            'birth_date' => $this->birth_date->format('Y-m-d'),
            'first_contact_date' => $this->first_contact_date->format('Y-m-d'),
        ];
    }
}
