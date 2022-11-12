<div class="form-group {{$grid}}" @foreach ($parent_attributes as $k=>$v) {{$k}}="{{$v}}" @endforeach @if(isset($parent_id)) id="{{$parent_id}}" @endif>
	<div class="custom-control custom-checkbox">
		<input type="checkbox"
		class="{{$class}} @error($name) is-invalid @enderror custom-control-input"
		name="{{$name}}{{$multiple ? '[]' : ''}}"
		id="{{isset($id) ? $id : $name}}"
		value="{{ old($name, $value) }}"
		@foreach ($attributes as $k=>$v) {{$k}}="{{$v}}" @endforeach
		{{$required ? 'required' : ''}}
		{{$disabled ? 'disabled' : ''}}
		{{$readonly ? 'readonly' : ''}} /> 
		<span></span>
		<label class="custom-control-label" for="{{isset($id) ? $id : $name}}">{{$label}}<span class="text-danger text-center" style="font-size: 1.1rem">{{isset($required)&&$required ? '*' : ''}}</span></label>
	</div>
	@error($name)<div class="text-danger" style="font-size:12px" role="alert">{{ $message }}</div>@enderror
	@if ($help_text)<span class="form-text text-muted">{!! $help_text !!}</span>@endif
</div>
