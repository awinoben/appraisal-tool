<?php

namespace App\Http\Requests;

use App\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed role_id
 * @property mixed key_result_area_id
 * @property mixed description
 */
class KPIRequest extends FormRequest
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
            'role_id' => ['required', 'string', 'max:255', 'exists:roles,id'],
            'key_result_area_id' => ['required', 'string', 'max:255', 'exists:key_result_areas,id'],
            'description' => ['required', 'string'],
        ];
    }
}
