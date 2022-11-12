<div class="form-group {{ isset($grid) ? $grid : '' }}"
    @foreach ($parent_attributes as $k => $v) {{ $k }}="{{ $v }}" @endforeach
    @if (isset($parent_id)) id="{{ $parent_id }}" @endif>
    @if (isset($type) && $type == 'password')
        <span toggle="#{{ isset($id) ? $id : $name }}" class="fa fa-fw fa-eye field-icon toggle-password"
            style="float: right; margin-left: -10%;padding-right:30px;margin-top: 10px;position: relative;z-index: 2;cursor:pointer">
        </span>
    @endif
    @if ($label) <label>{{ $label }}:<span
                class="text-danger text-center"
                style="font-size: 1.1rem">{{ isset($required) && $required ? '*' : '' }}</span></label>
        @if (isset($info_text))
            <span data-toggle="tooltip" data-theme="dark" title="{{ $info_text }}"><i
                    class="fas fa-info-circle text-dark" style="font-size: 1.1rem"></i></span>
        @endif
    @endif
    @if (isset($type) && $type == 'file')
        <div class="custom-file">
    @endif
    <input type="{{ isset($type) ? $type : 'text' }}"
        class="form-control {{ isset($type) && $type == 'file' ? 'custom-file-input' : '' }} {{ isset($class) ? $class : '' }} @error(isset($name) ? $name : '') is-invalid @enderror"
        name="{{ isset($name) ? $name : '' }}{{ isset($multiple) && $multiple ? '[]' : '' }}"
        id="{{ isset($id) ? $id : $name }}"
        value="{{ old(isset($name) ? $name : '', isset($value) ? $value : '') }}"
        placeholder="{{ isset($placeholder) ? $placeholder : '' }}"
        @if (isset($attributes)) @foreach ($attributes as $k => $v) {{ $k }}="{{ $v }}" @endforeach @endif
        {{ isset($required) && $required ? 'required' : '' }}
        {{ isset($disabled) && $disabled ? 'disabled' : '' }}
        {{ isset($readonly) && $readonly ? 'readonly' : '' }}
        @if (isset($max) && !empty($max)) max="{{ $max }}" @endif autocomplete="off" />
    @if (isset($type) && $type == 'file')
        <label class="custom-file-label" for="customFile">Choose file</label>
</div>
@endif
@error($name)
    <div class="text-danger" style="font-size:12px" role="alert">{{ $message }}</div>
@enderror
@if (isset($help_text))
    <small class="form-text text-primary">{!! $help_text !!}</small>
@endif
</div>
