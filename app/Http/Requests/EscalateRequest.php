<?php

namespace App\Http\Requests;

use App\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed is_closed
 * @property mixed id
 */
class EscalateRequest extends FormRequest
{
    use FailedValidationTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'user_id' => ['string', 'nullable', 'exists:users,id'],
            'result_id' => ['string', 'nullable', 'exists:results,id'],
            'is_closed' => ['required', 'integer', 'in:1,0']
        ];
    }
}
