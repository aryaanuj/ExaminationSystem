@extends('admin.layouts.master')
 
 @section('title')
 Course Management
 @endsection

 @section('content')

 <div class="card">
    <div class="card-body">
        @include('admin/datatable/datatable')
    </div>
 </div>

@endsection

@section('page_script')
 <script src="{{asset('dist/js/common.js')}}"></script>
 <script>
    $(document).ready(function(){
        renderAjaxDataTable('#datatable','{{$resource_url}}', {!! json_encode($table_columns_json) !!});
    });
 </script>
@endsection