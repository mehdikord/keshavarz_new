<?php
namespace App\Http\Requests\Users;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UsersMemberUpdateRequest extends FormRequest
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
            'name' => 'required',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'phone' => [
                'nullable',
                Rule::unique('users')->ignore($this->user->id),
            ],
            'national_code' => [
                'nullable',
                'required',
                Rule::unique('users')->ignore($this->user->id),
            ],
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(),422));
    }




}
