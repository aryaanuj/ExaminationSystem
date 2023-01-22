@extends('admin.layouts.master')
 
 @section('title')
 {{$page_title}}
 @endsection

 @section('content')

 <div class="card">
    <div class="card-body">
        <form action="{{$submit_url}}" method="POST">
            @csrf
            <table class="table table-bordered">
                <tr>
                    <th>Courses</th>
                    <th>Categories</th>
                </tr>
                @foreach($courses as $key=>$value)
                <tr>
                    <th>{{$value}}</th>
                    <th class="w-100">
                        <select name="mapping[{{$key}}][]" class="form-control select2" multiple>
                            @foreach($categories as $k=>$v)
                                <option value="{{$k}}">{{$v}}</option>
                            @endforeach
                        </select>
                    </th>
                </tr>
                @endforeach
            </table>
            <button type="submit" class="btn btn-success btn-sm">Submit</button>
        </form>
    </div>
 </div>

@endsection