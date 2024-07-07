@props([
    'name','value'=>'','label'=>false
])
@if($label)
    <label for="">{{$label}}</label>
@endif


<textarea
       name="{{$name}}"
       class="form-control @error($name)is-invalid @enderror"
       {{$attributes}}
>
{{old($name,$value)}}</textarea>
@error($name)
<div class="text-danger">
    {{$message}}
</div>
@enderror
