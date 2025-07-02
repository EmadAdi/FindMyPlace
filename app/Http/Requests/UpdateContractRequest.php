<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\ContractStatus;
use App\Enums\ContractDuration;

class UpdateContractRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id',
            'contract_date' => 'required|date',
            'contract_status' => 'required|in:' . implode(',', array_column(ContractStatus::cases(), 'value')),
            'contract_duration' => 'required|in:' . implode(',', array_column(ContractDuration::cases(), 'value')),
         ];
    }
}
