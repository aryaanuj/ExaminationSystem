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
        renderAjaxDataTable('#datatable','{{$resource_url}}', {!! json_encode($table_columns_json) !!}, 
        [ {
            "targets": -1,
            "title":'Actions',
            "render": function ( data, type, row, meta ) {
                var actions = '';
                actions += `<div class="dropdown">
                                <button class="btn btn-pills-violet dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{$resource_url}}/${row.id}/edit">Edit</a>
                                    <a class="dropdown-item" style="cursor:pointer" onclick="confirmBox(
                                        'Are you sure?',
                                        'Do you want to delete this course',
                                        'Delete',
                                        'question',
                                        '{{$resource_url}}/${row.id}'
                                    )">Delete</a>
                                </div>
                            </div>`;
                return actions;
            }
          } ]
          );
    });
 </script>
@endsection