<div class="form-group {{ $grid }}" @foreach ($parent_attributes as $k => $v) {{ $k }}="{{ $v }}" @endforeach @if (isset($parent_id)) id="{{ $parent_id }}" @endif>
    @if ($label) <label>{{ $label }}:<span class="text-danger text-center" style="font-size: 1.1rem">{{ isset($required) && $required ? '*' : '' }}</span></label> @if ($info_text) <span class="text-success" style="font-size:12px">{!! $info_text !!}</span> @endif @endif
    <select
        class="form-control {{ $multiple ? 'select_box' : '' }} {{ $class }} @error($name) is-invalid @enderror"
        name="{{ $name }}{{ $multiple ? '[]' : '' }}" id="{{ isset($id) ? $id : $name }}"
        @foreach ($attributes as $k => $v) {{ $k }}="{{ $v }}" @endforeach {{ $required ? 'required' : '' }} {{ $disabled ? 'disabled' : '' }}
        {{ $readonly ? 'readonly' : '' }} {{ $multiple ? 'multiple' : '' }} autocomplete="off"
        data-parsley-errors-container="#dropdown-errors-{{ $name }}">

        @foreach ($options as $key => $val)
            <option value="{{ $key }}"
                {{ (is_array($value) ? in_array($key, $value) : $key == $value) ? 'selected' : '' }}>
                {{ $val }}
            </option>
        @endforeach

    </select>
    <span id="dropdown-errors-{{ $name }}"></span>
    @error($name)<div class="text-danger" style="font-size:12px" role="alert">{{ $message }}</div>@enderror
    @if ($help_text)<span class="form-text text-success" style="font-size:12px">{!! $help_text !!}</span>@endif
</div>

