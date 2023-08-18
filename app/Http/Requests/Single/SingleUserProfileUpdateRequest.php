<?php
namespace App\Http\Requests\Single;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class SingleUserProfileUpdateRequest extends FormRequest
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
        $user = auth('users')->id();
        return [
            'name' => 'required|max:225',
            'province_id'=>'required|exists:provinces,id',
            'city_id'=>'required|exists:cities,id',
            'national_code' => [
                'required',
                'regex:/^[0-9]{10}$/',
                Rule::unique('users')->ignore($user),
            ],

        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(),422));
    }




}
