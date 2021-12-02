@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Branch</h2>
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


    <form action="{{ route('branches.update',$branch->id) }}" method="POST">
    	@csrf
        @method('PUT')


         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Branch Name:</strong>
		            <input type="text" name="branch_name" value="{{ $branch->branch_name }}" class="form-control" placeholder="Branch Name">
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Governorate:</strong>
		            <input type="text" name="region" value="{{ $branch->region }}" class="form-control" placeholder="Quantity">
		    </div>   
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Country:</strong>
		            <textarea class="form-control" style="height:150px" name="country" value="{{ $branch->country }}" placeholder="Country"></textarea>
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Street and city:</strong>
                    <input type="text" name="street" value="{{ $branch->street }}" class="form-control" placeholder="street">
                </div>    
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Select products::</strong>
                    @foreach ($products as $product)      
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="product_ids[]" value="{{ $product->id }}" id="defaultCheck1">
                      <label class="form-check-label" for="defaultCheck1">
                        {{ $product->name }}
                      </label>
                    </div>
                  @endforeach
                </div>    
            </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		      <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>


    </form>


