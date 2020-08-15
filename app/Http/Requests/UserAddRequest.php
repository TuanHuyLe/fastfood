<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAddRequest extends FormRequest
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
            'name' => 'bail|required|max:50',
            'email' => 'required|unique:users',
            'password' => 'bail|required|min:5'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được phép để trống',
            'name.max' => 'Tên không được phép quá 50 kí tự',
            'password.required' => 'Password không được phép để trống',
            'email.required' => 'Email không được phép để trống',
            'email.unique' => 'Email không được phép trùng nhau',
            'password.min' => 'Password không được phép dưới 5 kí tự',
        ];
    }
}
