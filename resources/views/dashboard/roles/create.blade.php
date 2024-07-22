
@extends('layouts.dashboardLayout')
@section('title','roles')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">roles</li>
@endsection
@section('content')
    <form action="{{route('roles.store')}}" method="post" enctype="multipart/form-data">
        @csrf
@include('dashboard.roles._form',['button_label'=>'Create'])
    </form>


@endsection
