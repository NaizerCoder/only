<?php

namespace App\Http\Requests\Car;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'model'=>'required',
            'year'=>'required|numeric',
            'cat_comfort_id'=>'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'model.required' => 'обязательно для заполнения',
            'year.required' => 'обязательно для заполнения',
            'cat_comfort_id.required' => 'обязательно для заполнения',
        ];
    }
}
