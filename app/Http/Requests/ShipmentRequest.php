<?php

namespace App\Http\Requests;

use App\Models\Shipment;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ShipmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title'        => 'required|string|max:128',
            'from_city'    => 'required|string|max:64',
            'from_country' => 'required|string|max:64',
            'to_city'      => 'required|string|max:64',
            'to_country'   => 'required|string|max:64',
            'price'        => 'required|integer|min:0',
            'status'       => 'required|string|in:' . implode(',', Shipment::validStatuses()),
            'details'      => 'nullable|string',
            'documents' => 'sometimes|array',
            'documents.*' => 'file|mimes:jpg,jpeg,png,webp,pdf|max:10240',
            'user_id' => 'nullable|exists:users,id',

        ];
    }
}
