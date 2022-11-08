<div class="form-group {{$grid??''}}">
    <label for="exampleInputEmail1">{{$label}}</label>
    <input type="{{$type}}" class="form-control {{$class}}" id="{{$id}}" aria-describedby="emailHelp" placeholder="{{$placeholder}}" @if($required) required @endif>
    @if(!empty($help_text))
    <small id="emailHelp" class="form-text text-muted">{{$help_text}}</small>
    @endif
</div>