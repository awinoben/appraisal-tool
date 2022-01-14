<?php

namespace App\Http\Requests;

use App\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed users
 * @property mixed project_id
 */
class AssignedProjectRequest extends FormRequest
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
            'project_id' => ['required', 'string', 'max:255', 'exists:projects,id'],
            'users' => ['required', 'array'],
            'is_closed' => ['nullable', 'integer', 'in:1,0']
        ];
    }
}
