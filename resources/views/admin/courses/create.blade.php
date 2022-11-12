@extends('admin.layouts.master')
 
 @section('title')
 Course Management
 @endsection

 @section('content')

 <div class="card">
    <div class="card-body">
        <form action="{{$submit_url}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
            @include('form-templates/'.$form_field_name['template'], $form_field_name)
            @include('form-templates/'.$form_field_image['template'], $form_field_image)
            @include('form-templates/'.$form_field_status['template'], $form_field_status)
            </div>
            <div class="row">
                @include('form-templates/'.$form_field_description['template'], $form_field_description)
            </div>
            <button type="submit" class="btn btn-success btn-sm">Submit</button>
        </form>
    </div>
 </div>

@endsection