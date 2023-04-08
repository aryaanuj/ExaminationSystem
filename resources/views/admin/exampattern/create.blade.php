@extends('admin.layouts.master')
 
 @section('title')
 {{$page_title}}
 @endsection

 @section('content')

 <div class="card">
    <div class="card-body">
        <form>
            @csrf
            <div class="table-responsive">
                <table class="table table-bordered text-center w-100">
                    <tr>
                        <th>Category</th>
                        <th>Pattern</th>
                        <th>Is Compulsory</th>
                    </tr>
                    @foreach($course['category'] as $key=>$value)
                    <tr x-data="data()">
                        <td>{{$value}}</td>
                        <td>
                            <table class="table table-bordered">
                                <tr>
                                    <th colspan="7"><input type="number" class="form-control" placeholder="Total Questions"></th>
                                </tr>
                                <tr>
                                    <td>From</td>
                                    <td>To</td>
                                    <td>Correct Mark</td>
                                    <td>Negative Mark</td>
                                    <td>Total Ques</td>
                                    <td>Max Attempt</td>
                                    <td x-on:click="addNewRow()"><i class="fa fa-plus text-success" role="button"></i></td>
                                </tr>
                                <template x-for="(field, index) in fields" :key="index">
                                    <tr>
                                        <td><input type="number" class="form-control" name="from"></td>
                                        <td><input type="number" class="form-control" name="from"></td>
                                        <td><input type="number" class="form-control" name="from"></td>
                                        <td><input type="number" class="form-control" name="from"></td>
                                        <td><input type="number" class="form-control" name="from"></td>
                                        <td><input type="number" class="form-control" name="from"></td>
                                        <td x-on:click="removeRow(index)"><i class="fa fa-times" role="button"></i></td>
                                    </tr>
                                </template>
                            </table>
                        </td>
                        <td>
                            <select class="form-control">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </form>
    </div>
 </div>

@endsection

@section('page_script')
<script src="https://unpkg.com/alpinejs@3.12.0/dist/cdn.min.js" defer></script>
<script>
    document.addEventListener('alpine:init',()=>{});
    function data(){
        return {
            fields:[],
            addNewRow(){
                let newField = {from:'', to:'', correctMark:'', negativeMark:'', maxAttempt:''}
                this.fields.push(newField)
            },
            removeRow(index){
                this.fields.splice(index, 1)
            }
        }
    }
</script>
@endsection