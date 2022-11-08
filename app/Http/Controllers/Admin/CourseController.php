<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

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
        // dd($this->data);
        return view('admin.courses.create', $this->data);
    }
}
