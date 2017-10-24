<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminCreateRequest extends FormRequest
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
            //
            'name'=>'required|unique:admins|max:20',
            'password'=>'required|confirmed',
            'password_confirmation'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '用户名不能为空',
            'name.unique'  => '用户名已经存在',
            'name.max'  => '用户名最长为20个字符',
            'password.required'  => '密码不能为空',
            'password.confirmed'  => '密码输入不一致',
            'password_confirmation.required'  => '验证密码不能为空',
        ];
    }
}
