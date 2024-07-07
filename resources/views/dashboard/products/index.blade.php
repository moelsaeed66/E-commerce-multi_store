@extends('layouts.dashboardLayout')
@section('title','products')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">products</li>
@endsection
@section('content')
    <div class="mb-5">
        <a href="{{route('products.create')}}" class="btn btn-sm btn-outline-primary mr-3">Add product</a>
{{--        <a href="{{route('products.trash')}}" class="btn btn-sm btn-outline-dark">Trashed products</a>--}}

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
            <th>Category</th>
            <th>Store</th>
            <th>Status</th>
            <th>Created at</th>
            <th colspan="2"></th>

        </tr>
        </thead>
        <tbody>


        @forelse($products as $product)

            <tr>
                <td><img src="{{asset('storage/'.$product->image)}}" height="50"></td>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->category->name}}</td>
                <td>{{$product->store->name}}</td>
                <td>{{$product->status}}</td>
                <td>{{$product->created_at}}</td>
                <td></td>
                <td></td>


                <td>
                    <a href="{{route('products.edit',['product'=>$product->id])}}" class="btn btn-sm btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{route('products.destroy',['product'=>$product->id])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9">No products</td>
            </tr>
        @endforelse

        </tbody>
    </table>
    {{$products->withQueryString()->links()}}
{{--    {{$products->withQueryString()->links('pagination.customPagination')}}--}}



@endsection
