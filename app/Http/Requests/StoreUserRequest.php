<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Password;

/**
 * Class StoreUserRequest.
 *
 * This class handles the validation and authorization logic for storing a new user.
 *
 * @package App\Http\Requests
 *
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $password_confirmation
 * @property int $role_id
 */
class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Check if the current user has the 'admin-user' ability.
        return Gate::allows('admin-user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            // The user's name must be provided, be a string, and not exceed 255 characters
            'name' => ['required', 'string', 'max:255'],

            // The user's email must be provided, be a valid email format, not exceed 255 characters,
            // and be unique in the users table
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],

            // The role ID must be provided, be an integer, and exist in the roles table
            'role_id' => ['required', 'int', 'exists:roles,id'],
        ];
    }
}
