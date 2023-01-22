<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = ['name','slug','description','status'];


    public static function getData($offset=0,$limit=10,$sort_order='',$sort_dir='desc',$search=''){
        $query = $temp = self::select('id','name','slug', 'description','status');

        if(!empty($search)){
            $search = strtolower($search);
            $query = $query->whereRaw("LOWER(name) LIKE '%".$search."%'");
        }
        if(!empty($sort_order)){
            $query = $query->orderBy($sort_order,$sort_dir);
        }

        $data['iTotalDisplayRecords'] = $query->count();

        if(!empty($search)){
            $data['iTotalRecords'] = $temp->count();
        }else{
            $data['iTotalRecords']  = $data['iTotalDisplayRecords'];
        }
        $result = $query->skip($offset)->take($limit)->get();
        foreach($result as $row){
            $row->status = $row->status?'<span class="badge badge-success">Active</span>':'<span class="badge badge-danger">Inactive</span>';
            $row->actions = '';
        }

        $data['aaData'] = $result;

        return $data;
    }

    public static function store($input){
        try{
            $course = self::firstOrNew(['name'=>$input['name']]);
            $course->slug = Str::slug($input['name']);
            $course->status = $input['status'];
            $course->description = $input['description'];
            $course->save();
            session()->flash('success','Category Added');
        }catch(\Exception $e){
            // dd($e->getMessage());
            session()->flash('error','Something went wrong');
        }
    }

    public static function modify($input, $category){
        try{
            $category->name = $input['name'];
            $category->slug = Str::slug($input['name']);
            $category->status = $input['status'];
            $category->description = $input['description'];
            $category->save();
            session()->flash('success','Category Updated');
        }catch(\Exception $e){
            // dd($e->getMessage());
            session()->flash('error','Something went wrong');
        }
    }

    public static function getFormFields($category=NULL){
        $formFields = [
            'form_field_name' => [
                'name' => 'name',
                'value' => isset($category)?old('name',$category->name):'',
                'grid' => 'col-md-6 col-12',
            ],
            'form_field_description' => [
                'name' => 'description',
                'template' => 'textarea',
                'grid' => 'col-md-12 col-12',
                'value' => isset($category)?old('description',$category->description):''
            ],
            'form_field_status' => [
                'name' => 'status',
                'template' => 'select',
                'options' => ['1'=>'Active', '0'=>'Inactive'],
                'value' => isset($category)?old('status',$category->status):'',
                'grid' => 'col-md-6 col-12',
            ],
        ];

        return $formFields;
    }

    public static function getCategoryList(){
        $category = self::select('id','name')->get();
        $arr = array();
        foreach($category as $key=>$value){
            $arr[$value->id] = $value['name'];
        }
        return $arr;
    }
}