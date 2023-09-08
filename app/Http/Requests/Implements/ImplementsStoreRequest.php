<?php
namespace App\Http\Requests\Implements;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ImplementsStoreRequest extends FormRequest
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
            'name' => 'required|max:225',
            'implement_category_id'=>'required|exists:implement_categories,id',
            'price_type' => 'required|max:225',
            'image' => 'nullable|image',
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(),422));
    }




}
