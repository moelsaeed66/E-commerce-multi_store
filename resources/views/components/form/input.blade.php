@props([
    'name','type'=>'text','value'=>'','label'=>false
])
@if($label)
    <label for="">{{$label}}</label>
@endif


<input type="{{$type ??'text'}}"
       name="{{$name}}"
       class="form-control @error('name')is-invalid @enderror"
       value="{{old($name,$value)}}"
       {{$attributes}}
>
@error($name)
<div class="text-danger">
    {{$message}}
</div>
@enderror
