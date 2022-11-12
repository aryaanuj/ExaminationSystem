<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CourseController extends Controller
{
    public $data = [];
    public function index(Request $request){

    }
    public function create(Request $request){
        $formFields = Course::getFormFields();
        foreach($formFields as $key=>$value){
            $this->data[$key] = \App\Modules\Form::getForm($value);
        }
        $this->data['submit_url'] = route('course.store');
        return view('admin.courses.create', $this->data);
    }

    public function store(CreateCourseRequest $request){
        $input = $request->validated();
        $input['image'] = $request->file('image');
        Course::store($input);
        return Redirect::back();
    }
}
