<?php

namespace App\Http\Requests;

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
     * @return array<string, ValidationRule|array<mixed>|string>
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
            'status'       => 'required|string|in:' . implode(',', \App\Models\Shipment::validStatuses()),
            'details'      => 'nullable|string',
            'documents.*'  => 'required|array',
        ];
    }
}
