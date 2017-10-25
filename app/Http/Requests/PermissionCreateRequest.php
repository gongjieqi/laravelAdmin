<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionCreateRequest extends FormRequest
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
            'name'=>'required|unique:admin_permissions|max:20',
            'display_name'=>'required',
            'fid'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '权限名称不能为空',
            'name.unique'  => '权限已经存在',
            'name.max'  => '权限名称最长为20个字符',
            'display_name.required'  => '权限显示名称不能为空',
            'fid.required'  => '分类不能为空',
        ];
    }
}
