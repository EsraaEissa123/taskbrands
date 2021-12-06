@extends('layouts.master')
@section('css')
    @toastr_css

@section('page-header')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Branch</h2>
            </div>
           
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Branch Name:</strong>
                {{ $branch->branch_name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Location:</strong>
                {{ $branch->street }},{{ $branch->region }},{{ $branch->country}}
            </div>
        </div>
       
         
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Products</h2>
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
                    {{-- <th>No</th> --}}
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Details</th>
                    <th>Price</th>
                    {{-- <th>Brand</th> --}}
                    {{-- <th width="30%">Image</th> --}}
                    <th width="280px">Action</th>
                </tr>
                @foreach ($branch->products as $product)
             
                
                <tr>
                    <td>{{ $product->name }}</td>
                <td>{{ $product->quantity }}</td>
                    <td>{{ $product->detail }}</td>
                    <td>{{ $product->price}}</td>
                    <td>{{ $product->brand_id}}</td>
                    {{-- <td><img src="{{$product->getFirstMediaUrl('avatar', 'thumb')}}" / width="120px"></td> --}}
                    
                    <td>
                        <form action="{{ route('products.destroy',$product->id) }}" method="POST"> 
                            <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
                            @can('product-edit')
                            <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                            @endcan
        
        
                            @csrf
                            @method('DELETE')
                            @can('product-delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                            @endcan
                        </form>
                    </td> 
                </tr>
                @endforeach
            </table>
        
        
    </div>
@endsection
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection