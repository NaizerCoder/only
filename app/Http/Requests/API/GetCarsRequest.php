<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class GetCarsRequest extends FormRequest
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
            'employee_id'=>'required',
            'date_start'=>'required',
            'date_end'=>'required',
            'category_id'=>'nullable',
            'model'=>'nullable',

        ];
    }

//    public function messages()
//    {
////        return [
////            'surname.required' => 'обязательно для заполнения',
////            'surname.alpha' => 'разрешены только буквы',
////            'name.required' => 'обязательно для заполнения',
////            'name.alpha' => 'разрешены только буквы',
////            'patronymic.required' => 'обязательно для заполнения',
////            'patronymic.alpha' => 'разрешены только буквы',
////            'position_id.required' => 'обязательно для заполнения',
////        ];
//    }
}
