<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CourseCategoryController extends Controller
{
    public $data = [];

    public function __construct()
    {
        $this->middleware(function($request,$next){
            $this->data['breadcrumb'] = [
                ['title'=>'Dashboard','link'=>route('admin.dashboard')],
                ['title'=>'Category', 'link'=>route('category.index')]
            ];
            $this->data['page_title'] = 'Course-Category Management';
            return $next($request);
        });
    }

   
    public function create(Request $request){
        $this->data['breadcrumb'][] = ['title'=>'Mapping'];
        $this->data['courses'] = Course::getCourseList();
        $this->data['categories'] = Category::getCategoryList();
        // dd($this->data['categories']);
        $this->data['submit_url'] = route('course.category.store');
        return view('admin.category.course_category_mapping', $this->data);
    }

    public function store(Request $request){
        $input = $request->all();
        CourseCategory::store($input);
        return Redirect::route('category.index');
    }

  
}
