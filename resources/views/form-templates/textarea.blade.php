<div class="form-group  {{$grid}}" @foreach ($parent_attributes as $k=>$v) {{$k}}="{{$v}}" @endforeach @if(isset($parent_id)) id="{{$parent_id}}" @endif>
	@if($label) <label>{{$label}}:<span class="text-danger text-center" style="font-size: 1.1rem">{{isset($required)&&$required ? '*' : ''}}</span></label> @if($info_text) <span data-toggle="tooltip" data-theme="dark" title="{{$info_text}}"><i class="fas fa-info-circle text-dark" style="font-size: 1.1rem"></i></span> @endif @endif
	@if(isset($landing_page_field))
	<div id="head_box_id">{{$landing_page_field != 'true' ? $landing_page_field->filters : ''}}</div>
	@endif
	
	   <textarea type="{{$type}}"
	   data-length="{{isset($character_count) ? $character_count :'255'}}"
	   class="form-control char-textarea {{$class}} @error($name) is-invalid @enderror"
	   name="{{$name}}{{$multiple ? '[]' : ''}}"
	   placeholder="{{$placeholder}}"
	   id="{{isset($id) ? $id : $name}}"
	   @foreach ($attributes as $k=>$v) {{$k}}="{{$v}}" @endforeach
	   {{$required ? 'required' : ''}}
	   {{$disabled ? 'disabled' : ''}}
	   {{$readonly ? 'readonly' : ''}}
	   autocomplete="off"
	   >{{ old($name, $value) }}</textarea>
	
	@error($name)
	<div class="invalid-feedback" role="alert">{{ $message }}</div>
	@enderror
	@if ($help_text)<span class="form-text text-muted">{!! $help_text !!}</span>@endif
	
 </div>