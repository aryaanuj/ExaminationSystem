<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public $data = [];

    public function __construct()
    {
        $this->middleware(function($request,$next){
            $this->data['breadcrumb'] = [
                ['title'=>'Dashboard','link'=>route('admin.dashboard')],
                ['title'=>'Category', 'link'=>route('category.index')]
            ];
            $this->data['page_title'] = 'Category Management';
            return $next($request);
        });
    }

    public function index(Request $request){
        $this->data['table_columns'] = ['name'=>'Name', 'slug'=>'Slug','description'=>'Description','status'=>'Status','actions'=>'Actions'];

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

            $data = Category::getData($offset,$limit,$sort_order,$sort_dir,$search);
            return response()->json($data);
        }

        foreach($this->data['table_columns'] as $key=>$value){
            $this->data['table_columns_json'][] = ['data'=>$key];
        }
        $this->data['menu'] = [
            ['title'=>'Add New', 'link'=>route('category.create')]
        ];
        // dd($this->data['menu']);
        $this->data['resource_url'] = route('category.index');
        return view('admin.category.list',$this->data);
    }
    public function create(Request $request){
        $formFields = Category::getFormFields();
        foreach($formFields as $key=>$value){
            $this->data[$key] = \App\Modules\Form::getForm($value);
        }
        $this->data['breadcrumb'][] = ['title'=>'Create'];
        $this->data['submit_url'] = route('category.store');
        return view('admin.category.create', $this->data);
    }

    public function store(CreateCategoryRequest $request){
        $input = $request->validated();
        Category::store($input);
        return Redirect::route('category.index');
    }

    public function edit(Request $request, Category $category){
        $formFields = Category::getFormFields($category);
        foreach($formFields as $key=>$value){
            $this->data[$key] = \App\Modules\Form::getForm($value);
        }
        $this->data['breadcrumb'][] = ['title'=>'Edit'];
        $this->data['submit_url'] = route('category.update',$category->id);
        return view('admin.category.edit', $this->data);
    }

    public function update(CreateCategoryRequest $request, Category $category){
        Category::modify($request->validated(),$category);
        return Redirect::route('category.index');
    }

    public function destroy(Request $request, Category $category){
        $category->delete();
        session()->flash('success','Category Deleted');
        return Redirect::route('category.index');
    }
}
