<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ExamPatternController extends Controller
{
    public $data = [];

    public function create(Request $request,$courseid){
        $this->data['page_title'] = 'Exam Pattern';
        $this->data['course'] = CourseCategory::getCourseWithCategory($courseid,true)[0];
        return view('admin.exampattern.create', $this->data);
    }

    public function store(CreateCategoryRequest $request){
        $input = $request->validated();
        Category::store($input);
        return Redirect::route('category.index');
    }


}
