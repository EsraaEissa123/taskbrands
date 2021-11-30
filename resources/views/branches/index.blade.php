@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>branches</h2>
            </div>
            {{-- <div class="pull-right">
                @can('branch-create')
                <a class="btn btn-success" href="{{ route('branches.create') }}"> Create New Branch</a>
                @endcan
            </div> --}}
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
            <th>Branch Name</th>
            <th>Location</th>
            <th>Brand</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($branches as $branch)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $branch->branch_name }}</td>
	        <td>{{ $branch->street }},{{ $branch->region }},{{ $branch->country}}</td>
            <td>{{ $branch->brand_id}}</td>
            
	        <td>
                <form action="{{ route('branches.destroy',$branch->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('branches.show',$branch->id) }}">Show</a>
                    @can('branch-edit')
                    <a class="btn btn-primary" href="{{ route('branches.edit',$branch->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('branch-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>

    {!! $branches->links() !!}

    

