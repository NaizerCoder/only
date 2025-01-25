<?php

namespace App\Http\Requests\CategoryComfort;

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
            'title'=>'required|'.Rule::unique('categories_position', 'title'),
            'description' =>'string|nullable',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'обязательно для заполнения',
            'title.unique' => 'такая категория уже существует',
        ];
    }
}
