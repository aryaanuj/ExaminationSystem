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
                @foreach($courses as $key=>$course)
                <tr>
                    <td>{{$course['title']}}</td>
                    <td class="w-100">
                        <select name="mapping[{{$course['id']}}][]" class="select2 form-control" multiple>
                            @foreach($categories as $id=>$category)
                                <option value="{{$id}}" @if(count($course['category'])>0 && in_array($id,$course['category']))  selected @endif>{{$category}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                @endforeach
            </table>
            <button type="submit" class="btn btn-success btn-sm">Submit</button>
        </form>
    </div>
 </div>

@endsection