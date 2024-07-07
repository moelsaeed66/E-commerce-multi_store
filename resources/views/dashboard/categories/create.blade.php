
@extends('layouts.dashboardLayout')
@section('title','categories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection
@section('content')
    <form action="{{route('categories.store')}}" method="post" enctype="multipart/form-data">
        @csrf
@include('dashboard.categories._form',['button_label'=>'Create'])
    </form>


@endsection
