<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    protected $fillable = ['title','course_img','description','status'];


    public static function getData($offset=0,$limit=10,$sort_order='',$sort_dir='desc',$search=''){
        $query = $temp = self::select('title','course_img', 'description','status');

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

    public static function getFormFields(){
        $formFields = [
            'form_field_name' => [
                'name' => 'title'
            ],
            'form_field_image' => [
                'name' => 'image',
                'type' => 'file'
            ],
            'form_field_description' => [
                'name' => 'description',
                'template' => 'textarea',
                'grid' => 'col-md-12 col-12'
            ],
            'form_field_status' => [
                'name' => 'status',
                'template' => 'select',
                'options' => ['1'=>'Active', '0'=>'Inactive']
            ],
        ];

        return $formFields;
    }
}