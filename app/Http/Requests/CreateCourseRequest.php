<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCourseRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules =  [
            'title' => 'required|regex:/[a-zA-Z ]/|unique:courses,title',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'status' => 'required',
            'description' => 'required'
        ];

        if($this->getMethod()=='PUT'){
            $rules['title'] = 'required|regex:/[a-zA-Z ]/|unique:courses,title,'.$this->route('course')->id;
            $rules['image'] = 'nullable|image|mimes:png,jpg,jpeg|max:2048';
        }

        return $rules;
    }
}
