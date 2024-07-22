@extends('layouts.dashboardLayout')
@section('title','Trashed Categories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
    <li class="breadcrumb-item active">Trashed Categories</li>

@endsection
@section('content')
    <div class="mb-5">
        <a href="{{route('categories.index')}}" class="btn btn-sm btn-outline-primary">Back</a>
    </div>
    <x-alert type="success"/>
{{--@if(session()->has('success'))--}}
{{--    <div class="alert alert-success">--}}
{{--        {{session('success')}}--}}
{{--    </div>--}}
{{--@endif--}}

    <form action="{{\Illuminate\Support\Facades\URL::current()}}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.input name="name" placeholder="Name" class="mb-4" value="{{request('name')}}"/>
        <select name="status" class="form-control" >
            <option value="">All</option>
            <option value="active" @selected(request('status')=='active')>Active</option>
            <option value="archived" @selected(request('status')=='archived')>Archived</option>
        </select>
        <button class="btn btn-dark">Search</button>

    </form>

    <table class="table">
        <thead>
        <tr>
            <th>Image</th>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th>Deleted at</th>
            <th colspan="2"></th>

        </tr>
        </thead>
        <tbody>
{{--        <?php--}}
{{--            dd($categories);--}}
{{--            ?>--}}

        @forelse($categories as $category)

            <tr>
                <td><img src="{{asset('storage/'.$category->image)}}" height="50"></td>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>

                <td>{{$category->status}}</td>
                <td>{{$category->deleted_at}}</td>
                <td></td>
                <td></td>


                <td>
                    <form action="{{route('categories.restore',['category'=>$category->id])}}" method="post">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Restore</button>
                    </form>

                </td>
                <td>
                    <form action="{{route('categories.soft-delete',['category'=>$category->id])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">SoftDelete</button>
                    </form>

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">No Categories</td>
            </tr>
        @endforelse






        </tbody>
    </table>
    {{$categories->withQueryString()->links()}}
{{--    {{$categories->withQueryString()->links('pagination.customPagination')}}--}}



@endsection
