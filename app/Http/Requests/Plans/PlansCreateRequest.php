<?php

namespace App\Http\Requests\Plans;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PlansCreateRequest extends FormRequest
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
            'title'=>'required|max:225',
            'image' => 'nullable|image',
            'price' => 'nullable|numeric|required_if:is_free,0',
            'sale' => 'nullable|numeric',
            'access' => 'required|numeric|min:1',
            'is_free' => 'required|boolean'
            ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(),422));
    }
}
