@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Branch</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('branches.index') }}"> Back</a>
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
         <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="title">Select Branches:</label> 
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
          
        
        
        
        
           
               