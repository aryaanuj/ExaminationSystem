<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\ExamPatternController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'admin', 'middleware'=>['auth','admin_auth']], function (){
    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::resource('course', CourseController::class);
    Route::resource('category', CategoryController::class);
    Route::get('course-category-mapping', [\App\Http\Controllers\Admin\CourseCategoryController::class,'create'])->name('course.category.create');
    Route::post('course-category-mapping/store', [\App\Http\Controllers\Admin\CourseCategoryController::class,'store'])->name('course.category.store');
    Route::resource('course/{course_id}/exam-pattern', ExamPatternController::class);
});





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
