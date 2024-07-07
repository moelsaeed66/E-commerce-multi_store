
@extends('layouts.dashboardLayout')
@section('title','Edit categories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit Categories</li>

@endsection
@section('content')
{{--    {{dd($category)}}--}}
    <form action="{{route('categories.update',['category'=>$categories->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
      @include('dashboard.categories._form',['button_label'=>'update'])
    </form>


@endsection

