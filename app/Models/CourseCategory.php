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
                CourseCategory::where(['course_id'=>$key])->delete();
                foreach($value as $k=>$v){
                    self::create(['course_id'=>$key, 'category_id'=>$v]);
                }
            }
            session()->flash('success', 'Successfully Mapped');
        }catch(\Exception $ex){
            session()->flash('error', 'Something went wrong');
        }
    }

    public static function getCourseWithCategory($courseid=null, $getCategoryTitle=false){
        $courses = Course::select('id','title');
        if(!is_null($courseid)){
            $courses = $courses->where('id',$courseid);
        }
        $courses = $courses->with('category:id,name')->get();
        return $courses->map(function($course) use ($getCategoryTitle){
                return [
                    'id'=>$course->id,
                    'title'=>$course->title,
                    'category'=> ! $getCategoryTitle ? $course->category->pluck('id')->toArray():$course->category->pluck('name','id')->toArray()
                ];
        })->toArray();
    }
}