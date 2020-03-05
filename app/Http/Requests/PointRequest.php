<?php

namespace App\Http\Requests;

use App\Subject;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use function foo\func;

class PointRequest extends FormRequest
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
        $rules = [];
        if (!empty(\request('point'))) {
            foreach (\request('point') as $key => $value) {
                $rules['point.' . $key . '.point'] = 'required|numeric|distinct|min:0|max:10';
            };
        }
        return $rules;
    }

    public function messages()
    {
        $messages = [];
        $results = collect(Subject::whereIn('id', \request('subject_id'))->get());
        foreach ($results as $key => $item) {
            $messages['point.' . $key . '.point.required'] = '' . $item->name . ' field must not be blank';
            $messages['point.' . $key . '.point.numeric'] = '' . $item->name . ' required field is No';
            $messages['point.' . $key . '.point.min'] = '' . $item->name . ' is the smallest than 0 characters';
            $messages['point.' . $key . '.point.max'] = '' . $item->name . ' is not greater than 255 characters';
        }
        return $messages;
    }
}
