<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CourseCategory extends Model
{
    protected $table = 'course_category';
    protected $fillable = ['course_id','category_id'];

    public static function store($input){
        try{
            foreach($input['mapping'] as $key=>$value){
                foreach($value as $k=>$v){
                    self::create(['course_id'=>$key, 'category_id'=>$v]);
                }
            }
            session()->flash('success', 'Successfully Mapped');
        }catch(\Exception $ex){
            session()->flash('error', 'Something went wrong');
        }
    }
}