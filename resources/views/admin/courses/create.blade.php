@extends('admin.layouts.master')
 
 @section('title')
 Course Management
 @endsection

 @section('content')

 <div class="card">
    <div class="card-body">
        <form>
            @include('form-templates/'.$form_field_name['template'], $form_field_name)
            @include('form-templates/'.$form_field_image['template'], $form_field_image)
            @include('form-templates/'.$form_field_demo['template'], $form_field_demo)
        </form>
    </div>
 </div>

@endsection