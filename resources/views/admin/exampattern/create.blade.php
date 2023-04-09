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
                                    <th colspan="7"><input type="number" class="form-control" x-model="totalQuestions" placeholder="Total Questions"></th>
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
                                        <td><input type="number" class="form-control" :id="`from${index}`" name="from" x-model="field.from" readonly></td>
                                        <td><input type="number" class="form-control" :id="`to${index}`" name="to" x-model="field.to"></td>
                                        <td><input type="number" class="form-control" :id="`correctMark${index}`" name="correctMark" x-model="field.correctMark"></td>
                                        <td><input type="number" class="form-control" :id="`negativeMark${index}`" name="negativeMark" x-model="field.negativeMark"></td>
                                        <td><input type="number" class="form-control" name="totalQues" :value="field.to ? field.to - field.from + 1 : ''" readonly></td>
                                        <td><input type="number" class="form-control"  :id="`maxAttempt${index}`" name="maxAttempt" x-model="field.maxAttempt"></td>
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
            totalQuestions:'',
            addNewRow(){
                if(this.totalQuestions=='' || this.totalQuestions==0 || this.totalQuestions<0){
                    alert('TotalQuestions value can not be null or 0 or negative')
                    return
                }
                let newField = {from:'', to:'', correctMark:'', negativeMark:'', maxAttempt:''}
                if(this.fields.length==0){
                    newField.from = 1
                }
                let error = false
                this.fields.forEach((element,index) => {
                    if(element.to=='' || element.to==0 || element.to<0){
                        error = true
                        alert('"To" value can not be null or 0 or negative')
                        return
                    }else if(element.to > this.totalQuestions){
                        error = true
                        alert('"To" value can not be greater than total Questions')
                        return
                    }else if(element.to < this.from){
                        error = true
                        alert('"To" value can not be less than From value')
                        return
                    }else if(element.correctMark=='' || element.correctMark==0 || element.correctMark<0){
                        error = true
                        alert('"correctMark" value can not be null or 0 or negative')
                        return
                    }else if(element.negativeMark=='' || element.negativeMark<0){
                        error = true
                        alert('"negativeMark" value can not be null or negative')
                        return
                    }else if(element.negativeMark>element.correctMark){
                        error = true
                        alert('"negativeMark" value can not be greater than correct Mark')
                        return
                    }else if(element.maxAttempt=='' || element.maxAttempt==0 || element.maxAttempt<0){
                        error = true
                        alert('"maxAttempt" value can not be null or negative')
                        return
                    }else if(element.maxAttempt > (parseInt(element.to) - parseInt(element.from) + 1)){
                        error = true
                        alert('"maxAttempt" value can not be greater than totalQuestion range')
                        return
                    }else if(this.totalQuestions == element.to){
                        error = true
                        alert('Can not add more rows')
                        return
                    }

                    if(index == this.fields.length-1){
                        $('#to'+index).attr('readonly',true);
                        $('#maxAttempt'+index).attr('readonly',true);
                    }
                });

                if(!error){
                    if(this.fields.length>0){
                        newField.from =  parseInt(this.fields[this.fields.length-1].to) + 1;
                    }
                    this.fields.push(newField)
                }
            },
            removeRow(index){
                $('#to'+(index-1)).attr('readonly',false);
                $('#maxAttempt'+(index-1)).attr('readonly',false);
                this.fields.splice(index, 1)
            }
        }
    }
</script>
@endsection