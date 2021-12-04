@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <strong> Our Brands </strong>
                @foreach ($brands as $brand) 
                <li><a href="{{ route('brand.show',$brand) }}">{{ $brand->name }}</a></li>
           @endforeach
            </div>
        </div>
    </div>


        @endsection
