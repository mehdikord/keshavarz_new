<?php
namespace App\Http\Requests\Implements;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ImplementsFormsUpdateRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'name' => [
                'nullable',
                Rule::unique('forms')->ignore($this->form->id),
            ],
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(),422));
    }




}
