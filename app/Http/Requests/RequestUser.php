<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestUser extends FormRequest
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
        $validation = [
            'name' => 'required',
            'email' => 'required|email|unique:persons',
            'phone' => 'required|regex:/(0)[0-9]{9}/',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'admin' => 'required',
            'password' => 'required|min:5',
            're-password' => 'required'
        ];
        if (!empty($this->id)) {
            $validation['email'] = 'required|email|unique:users,id' . $this->id;
            $validation['image'] = 'mimes:jpg,jpeg,png,gif,svg|max:2048';
        }
        return $validation;
    }

    public function messages()
    {
        return [
            'name.required' => 'Trường này không được bỏ trống',
            'email.required' => 'Trường này không được bỏ trống',
            'address.required' => 'Trường này không được bỏ trống',
            'phone.required' => 'Trường này không được bỏ trống',
            'phone.regex' => 'Trường này bắt đầu từ 0 và có  10 kí tự',
            'image.required' => 'Trường này không được bỏ trống',
            'password.required' => 'Trường này không được bỏ trống',
            'password.min' => 'Trường này có ít nhất 5 kí tự',
            're-password' => 'Trường này không được bỏ trống',
        ];
    }
}
