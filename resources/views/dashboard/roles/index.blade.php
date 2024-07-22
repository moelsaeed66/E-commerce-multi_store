@php use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\URL; @endphp
@extends('layouts.dashboardLayout')
@section('title','Roles')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Roles</li>
@endsection
@section('content')
    <div class="mb-5">
            <a href="{{route('roles.create')}}" class="btn btn-sm btn-outline-primary mr-3">Add Role</a>

    </div>
    <x-alert type="success"/>
    {{--@if(session()->has('success'))--}}
    {{--    <div class="alert alert-success">--}}
    {{--        {{session('success')}}--}}
    {{--    </div>--}}
    {{--@endif--}}

{{--    <form action="{{URL::current()}}" method="get"--}}
{{--          class="d-flex justify-content-between mb-4">--}}
{{--        <x-form.input name="name" placeholder="Name" class="mb-4" value="{{request('name')}}"/>--}}
{{--        <select name="status" class="form-control">--}}
{{--            <option value="">All</option>--}}
{{--            <option value="active" @selected(request('status')=='active')>Active</option>--}}
{{--            <option value="archived" @selected(request('status')=='archived')>Archived</option>--}}
{{--        </select>--}}
{{--        <button class="btn btn-dark">Search</button>--}}

{{--    </form>--}}

    <table class="table">
        <thead>
        <tr>

            <th>ID</th>
            <th>Name</th>
            <th>Created at</th>
            <th colspan="2"></th>

        </tr>
        </thead>
        <tbody>
        {{--        <?php--}}
        {{--            dd($Roles);--}}
        {{--            ?>--}}

        @forelse($roles as $role)

            <tr>

                <td>{{$role->id}}</td>
                <td><a href="{{route('roles.show',$role->id)}}">{{$role->name}}</a></td>
                <td>{{$role->created_at}}</td>
                <td></td>
                <td></td>


                <td>
                    @can('Roles.update')
                        <a href="{{route('roles.edit',['role'=>$role->id])}}" class="btn btn-sm btn-primary">Edit</a>
                    @endcan
                </td>
                <td>
                    @can('Roles.delete')
                        <form action="{{route('roles.destroy',['role'=>$role->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    @endcan

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No Roles</td>
            </tr>
        @endforelse


        </tbody>
    </table>
    {{$roles->withQueryString()->links()}}
    {{--    {{$Roles->withQueryString()->links('pagination.customPagination')}}--}}

@endsection
