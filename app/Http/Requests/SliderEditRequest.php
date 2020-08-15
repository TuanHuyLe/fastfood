<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'bail|required|max:255|min:10',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được phép để trống',
            'name.max' => 'Tên không được phép quá 255 kí tự',
            'name.min' => 'Tên không được phép dưới 10 kí tự',
            'description.required' => 'Mô tả không được phép để trống'
        ];
    }
}
