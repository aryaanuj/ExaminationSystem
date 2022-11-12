<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    protected $fillable = ['title','course_img','description','status'];
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
            dd($e->getMessage());
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