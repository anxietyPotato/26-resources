<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Allow all users for now, or add logic if needed
        return true;
    }

    public function rules(): array
    {
        return [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role'  => 'required|in:admin,client,driver',
        ];
    }

    public function messages(): array
    {
        return [
            'role.in' => 'The role must be one of: admin, client, or driver.',
        ];
    }
}
