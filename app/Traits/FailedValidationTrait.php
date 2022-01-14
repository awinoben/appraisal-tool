<?php


namespace App\Traits;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait FailedValidationTrait
{
    use NodeResponse;

    /**
     * Customize the errors to be more
     * readable
     * @param Validator $validator
     */
    public function failedValidation(Validator $validator)
    {
        $error_results = [];
        $errors = $validator->errors()->toArray();

        foreach ($errors as $key => $errors) {
            array_push(
                $error_results,
                [
                    'key' => $key,
                    'errors' => [...$errors]
                ]
            );
        }

        $response = $this->showErrors([
            "code" => 422,
            "errors" => $error_results
        ]);

        throw new HttpResponseException($response);
    }
}
