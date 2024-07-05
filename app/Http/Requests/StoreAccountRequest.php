<?php

namespace App\Http\Requests;

use App\Services\ZohoSdk\Dto\AccountDto;
use Illuminate\Foundation\Http\FormRequest;

class StoreAccountRequest extends FormRequest
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
            'account_name' => ['required', 'string'],
            'website' => ['required', 'url'],
            'phone' => ['required', 'max:30'],
        ];
    }

    public function getAccountDto(): AccountDto
    {
        return new AccountDto(
            $this->validated('account_name'),
            $this->validated('phone'),
            $this->validated('website'),
        );
    }
}
