<?php

namespace App\Http\Requests;

use App\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed ratings
 */
class RatingRequest extends FormRequest
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
            'ratings' => ['required', 'array'],
//            'ratings.*.self_remarks' => ['required', 'string'],
//            'ratings.*.self_rating' => ['required', 'numeric', 'min:1', 'max:5'],
//            'ratings.*.appraiser_remarks' => ['nullable', 'string'],
//            'ratings.*.appraiser_rating' => ['nullable', 'numeric', 'min:1', 'max:5']
        ];
    }
}
