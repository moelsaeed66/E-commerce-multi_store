

@if($errors->any())
    <div class="alert alert-danger">
        <h3>Errors Occured!</h3>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach

            </ul>

    </div>
@endif

<div class="form-group">
{{--            <label for="">Category Name</label>--}}
    <x-form.input label="categories" type="text" name="name" value="{{$categories->name}}"/>
{{--            <input type="text" name="name" class="form-control @error('name')is-invalid @enderror" value="{{old('name',$categories->name)}}">--}}
{{--    @error('name')--}}
{{--        <div class="text-danger">--}}
{{--            {{$message}}--}}
{{--        </div>--}}
{{--    @enderror--}}
        </div>
        <div class="form-group">
            <label for="">Category Parent</label>
            <select name="parent_id" class="form-control form-select">
                <option value="">Primary Category</option>
@foreach($parents as $parent)
    <option value="{{$parent->id}}" @selected(old('parent_id',$parent->parent_id)== $parent->id) >{{$parent->name}}</option>
    @endforeach
    </select>
    </div>
    <div class="form-group">
{{--        <label for="">Category Description</label>--}}
{{--        <textarea name="description" class="form-control" >{{old('description',$categories->description)}}</textarea>--}}
        <x-form.textarea name="description" class="form-control" :value="$categories->name" label="Category Description" />
    </div>
    <div class="form-group">
{{--        <label for="">Image</label>--}}
{{--        <input type="file" name="image" class="form-control" value="{{$categories->image}}">--}}
        <x-form.input type="file" name="image" class="form-control" :value="$categories->image"/>
        @if($categories->image)
            <img src="{{asset('storage/'.$categories->image)}}" height="50">
        @endif
    </div>
    <div class="form-group">
        <label for="">Status</label>
        <div>
            <x-form.radio name="status" :checked="$categories->status" :options="['active'=>'Active','archived'=>'Archived']" />
{{--            <div class="form-check">--}}
{{--                <input class="form-check-input" type="radio" name="status" value="active" @checked(old('status',$categories->status) =='active')>--}}
{{--                <label class="form-check-label" for="flexRadioDefault1">--}}
{{--                    Active--}}
{{--                </label>--}}
{{--            </div>--}}
{{--            <div class="form-check">--}}
{{--                <input class="form-check-input" type="radio" name="status"  value="archived" @checked(old('status',$categories->status) =='archived')>--}}
{{--                <label class="form-check-label" for="flexRadioDefault2">--}}
{{--                    Archived--}}
{{--                </label>--}}
{{--            </div>--}}
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{$button_label}}</button>
    </div>
