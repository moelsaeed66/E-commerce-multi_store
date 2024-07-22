
@extends('layouts.dashboardLayout')
@section('title','Edit Roles')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit Roles</li>

@endsection
@section('content')
{{--    {{dd($role)}}--}}
    <form action="{{route('roles.update',['role'=>$role->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
      @include('dashboard.roles._form',['button_label'=>'update'])
    </form>


@endsection

