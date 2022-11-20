<table id="datatable" class="table table-bordered" style="width:100%">
    <thead>
        <tr>
            @foreach($table_columns as $columns)
                <th>{{$columns}}</th>
            @endforeach
        </tr>
    </thead>
    {{-- <tbody>
        @foreach($courses as $value)
            <tr>
                <td>{{$value->title}}</td>
                <td>{{$value->course_img}}</td>
                <td>{{$value->description}}</td>
                <td>{{$value->status}}</td>
            </tr>
        @endforeach
    </tbody> --}}
</table>