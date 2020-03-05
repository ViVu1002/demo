<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestPerson extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|unique:persons',
            'address' => 'required|max:255',
            'phone' => 'required|regex:/(0)[0-9]{9}/',
            'faculty_id' => 'required',
            'date' => 'required|before:today',
            'gender' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ];
        if (!empty($this->id)) {
            $validation['email'] = 'email|unique:persons,id,' . $this->id;
            $validation['image'] = 'mimes:jpg,jpeg,png,gif,svg|max:2048';
        }
        return $validation;
    }

    public function messages()
    {
        return [
            'name.required' => 'This field must not be blank',
            'name.max' => 'This field is not greater than 255 characters',
            'email.required' => 'This field must not be blank',
            'address.required' => 'This field must not be blank',
            'address.max' => 'This field is not greater than 255 characters',
            'phone.required' => 'This field must not be blank',
            'phone.regex' => 'This field starting at 0 and 10 characters',
            'faculty_id.required' => 'This field must not be blank',
            'date.required' => 'This field must not be blank',
            'image.required' => 'This field must not be blank',
            'gender.required' => 'This field must not be blank',
            'date.before' => 'This field is not greater than today'
        ];
    }
}
