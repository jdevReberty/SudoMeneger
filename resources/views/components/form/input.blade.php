<div class="form-group {{ $contentClass ?? '' }}">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="{{$type ?? 'text'}}" class="form-control form-control-user"
        id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}" 
        value="{{ $value ?? old($name)}}" 
        {{ $required == "true" ? 'required' : '' }} 
        {{ $readonly == "true" ? 'readonly' : '' }}
        >
</div>