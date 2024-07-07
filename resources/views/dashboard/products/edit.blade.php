
@extends('layouts.dashboardLayout')
@section('title','Edit Product')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit Profile</li>

@endsection
@section('content')

    {{--        {{dd($countries)}}--}}
    <form action="{{route('products.update',$product->id)}}" method="post" enctype="multipart/form-data">
        @csrf

        @include('dashboard.products._form')
{{--        @method('PATCH')--}}
{{--        <div class="form-group">--}}
{{--                <x-form.input name="name" label="Product Name" class="form-control-lg" role="input" :value="$product->name"/>--}}
{{--        </div>--}}
{{--        <div class="form-group">--}}
{{--            <label>Categories</label>--}}
{{--                <select>--}}
{{--                    <option value="">Primary Category</option>--}}
{{--                    @foreach(\App\Models\Category::all() as $category)--}}
{{--                        <option value="{{$product->id}}" @selected(old('category_id',$product->category_id)==  $category->id)>{{$category->name}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        <div class="form-group">--}}
{{--            <label>Description</label>--}}
{{--                <x-form.textarea name="description" :value="$product->description"/>--}}
{{--        </div>--}}

{{--        <div class="form-group">--}}
{{--            <label>Image</label>--}}
{{--                <x-form.input name="image" type="file" accept="image/*"/>--}}
{{--            @if($product->image)--}}
{{--                <img src="{{asset('storage/'.$product->image)}}" alt="" height="60">--}}
{{--            @endif--}}
{{--        </div>--}}
{{--        <div class="form-group">--}}
{{--            <label>Price</label>--}}
{{--            <x-form.input name="price" type="text" :value="$product->price"/>--}}
{{--        </div>--}}

{{--        <div class="form-group">--}}
{{--            <label>Compare Price</label>--}}
{{--            <x-form.input name="compare_price" type="text" :value="$product->compare_price"/>--}}
{{--        </div>--}}

{{--        <div class="form-group">--}}
{{--            <label>Tags</label>--}}
{{--            <x-form.input name="tag" type="text" :value="$tags"/>--}}
{{--        </div>--}}

{{--        <div class="form-group">--}}
{{--                <label for="">Status</label>--}}
{{--            <x-form.radio name="status" :checked="$category->status" :options="['active'=>'Active','draft'=>'Draft','archived'=>'Archived']" />--}}

{{--        </div>--}}

{{--        <button type="submit" class="btn btn-primary">Save</button>--}}

    </form>

@stack('styles')
    @stack('scripts')


@endsection
