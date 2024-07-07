@props(['label','options','name','value','selected'])

<label for="">{{$label}}</label>
<select name="{{$name}}" class="form-control form-select">
    @foreach($options as $value=>$text)
        <option value="{{$value}}" @selected($value == $selected )>{{$text}}</option>
    @endforeach
</select>

{{--<x-form.validation-feedback :name="$name"/>--}}
