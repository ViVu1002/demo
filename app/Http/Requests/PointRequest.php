<?php

namespace App\Http\Requests;

use App\Person;
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
        $data = collect(\request());
        if (count($data) == 2) {
            $rules['subject_id'] = 'required';
        }
        if (count($data) == 4) {
            $subjects = collect(\request('subject_id'));
            $point = collect(\request('point'));
            foreach ($point as $key => $item) {
                $combined = $subjects->combine($point);
            }
            $results = collect($combined->whereBetween('point', [1, 10]));
            $person = Person::find(\request('person_id'))->load('subjects');
            $person->subjects()->syncWithoutDetaching($results);
        }
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
        $data = collect(\request());
        if (count($data) == 2) {
            $messages['subject_id.required'] = 'No subjects';
        } else {
            $results = collect(Subject::whereIn('id', \request('subject_id'))->get());
            foreach ($results as $key => $item) {
                $messages['point.' . $key . '.point.required'] = '' . $item->name . ' field must not be blank';
                $messages['point.' . $key . '.point.numeric'] = '' . $item->name . ' required field is No';
                $messages['point.' . $key . '.point.min'] = '' . $item->name . ' is the smallest than 0 characters';
                $messages['point.' . $key . '.point.max'] = '' . $item->name . ' is not greater than 255 characters';
            }
        }
        return $messages;
    }
}
