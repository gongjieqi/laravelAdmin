<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'password'=>'confirmed',
        ];
    }

    public function messages()
    {
        return [
            'password.confirmed'  => '密码输入不一致',
            'password.required'  => '新密码不能为空',
        ];
    }

    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();
        $validator->sometimes('password', 'required', function ($input) {
            return strlen($input->old_password) > 0;
        });

        return $validator;
    }
}
