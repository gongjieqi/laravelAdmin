<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionEditRequest extends FormRequest
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

    public function rules()
    {
        return [
            //
            'display_name'=>'required',
            'fid'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'display_name.required'  => '权限显示名称不能为空',
            'fid.required'  => '分类不能为空',
        ];
    }
}
