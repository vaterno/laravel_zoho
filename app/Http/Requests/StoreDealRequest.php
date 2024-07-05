<?php

namespace App\Http\Requests;

use App\Services\ZohoSdk\Dto\DealDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Services\ZohoSdk\Enum\DealStage;

class StoreDealRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'stage' => ['required', 'string', Rule::in(DealStage::toArray())],
            'account_id' => ['required', 'integer'],
        ];
    }

    public function getDealDto(): DealDto
    {
        return new DealDto(
            $this->validated('name'),
            $this->validated('stage'),
            $this->validated('account_id'),
        );
    }
}
