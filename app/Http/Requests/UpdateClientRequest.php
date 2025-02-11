<?php

namespace App\Http\Requests;

use App\Services\ClientService;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateClientRequest extends FormRequest
{
    public function __construct(private readonly ClientService $clientService)
    {
        parent::__construct();
    }


    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $client = $this->clientService->find($this->client);
        return Gate::inspect('update', $client)->allowed();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:15'],
            'surname' => ['required', 'string', 'max:85'],
            'social_security_number' => ['required', 'string', 'max:50'],
            'gender_id' => ['required', 'int', 'exists:genders,id'],
            'birth_date' => ['date'],
            'first_contact_date' => ['required', 'date'],
        ];
    }
}
