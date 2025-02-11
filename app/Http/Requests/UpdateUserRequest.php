<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

/**
 * Class UpdateUserRequest.
 *
 * @package App\Http\Requests
 *
 * @property int    $id
 * @property string $name
 * @property string $email
 * @property int    $role_id
 */
class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Check if the current user is authorized to update users.
        return Gate::allows('admin-user');
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // The user's name must be provided, be a string, and not exceed 255 characters
            'name' => ['required', 'string', 'max:255'],

            // The user's email must be provided, be a valid email format, not exceed 255 characters,
            // and be unique in the users table, except for the current user being updated
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->user],

            // The role ID must be provided, be an integer, and exist in the roles table
            'role_id' => ['required', 'int', 'exists:roles,id'],
        ];
    }
}
