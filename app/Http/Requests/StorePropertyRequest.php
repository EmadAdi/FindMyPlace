<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:properties,slug,' . ($this->property->id ?? 'null'),
            'type' => 'required|string',
            'status' => 'required|string',
            'area' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'governorate_id' => 'required|exists:governorates,id',
            'place_id' => 'required|exists:places,id',
            'price' => 'required|numeric|min:0',
            'user_id' => 'required|exists:users,id',
            'bedroom_number' => 'required|integer|min:0',
            'bathroom_number' => 'required|integer|min:0',
            'has_kitchen' => 'boolean',
            'has_pool' => 'boolean',
            'has_garden' => 'boolean',
            'has_living_room' => 'boolean',
            'main_image' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ];

    }
}
