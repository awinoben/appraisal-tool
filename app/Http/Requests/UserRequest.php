<?php

namespace App\Http\Requests;

use App\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed country_id
 * @property mixed role_id
 * @property mixed name
 * @property mixed email
 * @property mixed is_active
 * @property mixed joining_date
 * @property mixed employee_number
 * @property mixed employee_designation
 * @property mixed project_id
 * @property mixed branch_id
 */
class UserRequest extends FormRequest
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
            'branch_id' => ['required', 'string', 'max:255', 'exists:branches,id'],
            'project_id' => ['nullable', 'string', 'max:255', 'exists:projects,id'],
            'country_id' => ['required', 'string', 'max:255', 'exists:countries,id'],
            'role_id' => ['required', 'string', 'max:255', 'exists:roles,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'employee_number' => ['required', 'string', 'max:255'],
            'employee_designation' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'integer', 'in:1,0'],
            'joining_date' => ['date', 'required', 'before_or_equal:now'],
            'password' => ['nullable', 'string', 'min:6'],
        ];
    }
}
