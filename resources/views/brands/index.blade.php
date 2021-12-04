@extends('layouts.master')
@section('css')
    @toastr_css

@section('page-header')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Brands</h2>
            </div>
            <div class="pull-right">
                @can('brand-create')
                <a class="btn btn-success" href="{{ route('brands.create') }}"> Create New Brand</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($brands as $brand)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $brand->name }}</td>
	        <td>{{ $brand->detail }}</td>
	        <td>
                <form action="{{ route('brands.destroy',$brand->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('brands.show',$brand->id) }}">Show</a>
                    @can('brand-edit')
                    <a class="btn btn-primary" href="{{ route('brands.edit',$brand->id) }}">Edit</a>
                    @endcan
                    @can('branch-management')
                    
                    <a class="btn btn-primary" href="{{ route('branches.create',$brand->id) }}">Branches</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('brand-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


    {!! $brands->links() !!}

    @endsection
    @section('js')
    @toastr_js
    @toastr_render
    @endsection
