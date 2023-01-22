<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    protected $fillable = ['title','course_img','description','status'];


    public static function getData($offset=0,$limit=10,$sort_order='',$sort_dir='desc',$search=''){
        $query = $temp = self::select('id','title','course_img', 'description','status');

        if(!empty($search)){
            $search = strtolower($search);
            $query = $query->whereRaw("LOWER(title) LIKE '%".$search."%'");
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
            $row->course_img = '<img src="'.$row->course_img.'" class="img-fluid w-25">';
            $row->status = $row->status?'<span class="badge badge-success">Active</span>':'<span class="badge badge-danger">Inactive</span>';
            $row->actions = '';
        }

        $data['aaData'] = $result;

        return $data;
    }

    public static function store($input){
        try{
            $filePath = \App\Modules\Utility::uploadFile($input['image'], 'Courses');
            $course = self::firstOrNew(['title'=>$input['title']]);
            $course->course_img = $filePath;
            $course->slug = Str::slug($input['title']);
            $course->status = $input['status'];
            $course->description = $input['description'];
            $course->save();
            session()->flash('success','Course Added');
        }catch(\Exception $e){
            // dd($e->getMessage());
            session()->flash('error','Something went wrong');
        }
    }

    public static function modify($input, $course){
        try{
            $old_img_url = $course->course_img;
            if(isset($input['image'])){
                \App\Modules\Utility::deleteFile($old_img_url);
                $input['image'] = \App\Modules\Utility::uploadFile($input['image'], 'Courses');
            }else{
                $input['image'] = $old_img_url;
            }

            $course->title = $input['title'];
            $course->course_img = $input['image'];
            $course->slug = Str::slug($input['title']);
            $course->status = $input['status'];
            $course->description = $input['description'];
            $course->save();
            session()->flash('success','Course Updated');
        }catch(\Exception $e){
            // dd($e->getMessage());
            session()->flash('error','Something went wrong');
        }
    }

    public static function getFormFields($course=NULL){
        $formFields = [
            'form_field_name' => [
                'name' => 'title',
                'value' => isset($course)?old('title',$course->title):''
            ],
            'form_field_image' => [
                'name' => 'image',
                'type' => 'file',
                'value' => isset($course)?old('image',$course->course_img):'',
                'grid' => isset($course)?'col-md-3 col-12':'col-md-4 col-12',
                'required' => isset($course)?false:true
            ],
            'form_field_description' => [
                'name' => 'description',
                'template' => 'textarea',
                'grid' => 'col-md-12 col-12',
                'value' => isset($course)?old('description',$course->description):''
            ],
            'form_field_status' => [
                'name' => 'status',
                'template' => 'select',
                'options' => ['1'=>'Active', '0'=>'Inactive'],
                'value' => isset($course)?old('status',$course->status):''
            ],
        ];

        return $formFields;
    }

    public static function getCourseList(){
        $courses = self::select('id','title')->get();
        $arr = array();
        foreach($courses as $key=>$value){
            $arr[$value->id] = $value['title'];
        }
        return $arr;
    }
}