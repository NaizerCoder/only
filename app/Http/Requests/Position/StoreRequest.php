<?php

namespace App\Http\Requests\Position;

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
            'title'=>'required|'.Rule::unique('positions', 'title'),
            'cat_position_id'=>'required',
            'cat_comfort_ids'=>'nullable',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'обязательно для заполнения',
            'title.unique' => 'такая должность уже существует',
            'cat_position_id.required' => 'обязательно для заполнения',
        ];
    }
}
