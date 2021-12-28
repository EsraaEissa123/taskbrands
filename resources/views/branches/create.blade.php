@extends('layouts.master')
@section('css')
    @toastr_css

@section('page-header')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Branch</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('branches.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('branches.store') }}" method="POST">
    	@csrf


         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Branch Name:</strong>
		            <input type="text" name="branch_name" class="form-control" placeholder="Name">
		    </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Governorate:</strong>
		            <input type="text" name="region" class="form-control" placeholder="governorate">
		    </div>   
		   
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Country:</strong>
                    <input type="text" name="country" class="form-control" placeholder="Country">
                    
                </div>    
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Street and city:</strong>
                    <input type="text" name="street" class="form-control" placeholder="street">
                </div>    
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">

                               <input name="brand_id" type="hidden" value={{request('id')}} class="form-control">

                </div>    
            </div>
            
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="title">Select products:</label> 
                    @foreach ($products as $product)      
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="product_ids[]" value="{{ $product->id }}" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                          {{ $product->name }}
                        </label>
                      </div>
                    @endforeach
                </div>    
           
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>


    </form>


    @endsection
    @section('js')
    @toastr_js
    @toastr_render
    @endsection