<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthRequest extends FormRequest
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
            'access_token' => 'required|string',
            'id' => 'required|int',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'sig' => 'required|string',
        ];
    }

    /**
     * Displays error messages if finds any incorrect or missing data
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'access_token.required' => 'This field must be filled in',
            'access_token.string' => 'This field should be a string',
            'id.required' => 'This field must be filled in',
            'id.int' => 'This field should be an int',
            'first_name.required' => 'This field must be filled in',
            'first_name.string' => 'This field should be a string',
            'last_name.required' => 'This field must be filled in',
            'last_name.string' => 'This field should be a string',
            'country.required' => 'This field must be filled in',
            'country.string' => 'This field should be a string',
            'city.required' => 'This field must be filled in',
            'city.string' => 'This field should be a string',
            'sig.required' => 'This field must be filled in',
            'sig.string' => 'This field should be a string',
        ];
    }

    /**
     * Throw httpResponseException if request have validation errors
     * @param Validator $validator
     * @return mixed
     */
    public function failedValidation(Validator $validator): mixed
    {
        throw new HttpResponseException(response()->json([
            'message'   => 'Validation errors',
            'errors'      => $validator->errors()
        ])->setStatusCode(400));
    }
}
