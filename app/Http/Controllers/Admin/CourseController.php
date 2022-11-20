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
        $this->data['table_columns'] = ['title'=>'Title', 'course_img'=>'Image','description'=>'Description','status'=>'Status'];

        if($request->ajax()){
            $offset = $request->get('start',0);
            $limit = $request->get('length',10);
            $columns = $request->get('columns');
            $order = $request->get('order');
            $sort_order = $sort_dir = '';
            if(isset($order[0]) && $columns[$order[0]['column']]['data']){
                $sort_order = $columns[$order[0]['column']]['data'];
                $sort_dir = $order[0]['dir'];
            }
            $search = $request->get('search');
            $search = isset($search['value'])?$search['value']:'';

            $data = Course::getData($offset,$limit,$sort_order,$sort_dir,$search);
            return response()->json($data);
        }

        foreach($this->data['table_columns'] as $key=>$value){
            $this->data['table_columns_json'][] = ['data'=>$key];
        }
        $this->data['resource_url'] = route('course.index');
        return view('admin.courses.list',$this->data);
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
