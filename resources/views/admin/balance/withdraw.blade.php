@extends('adminlte::page')

@section('title', 'Balances')

@section('content_header')    
    <nav>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('admin')}}">Dashboard</a>
            </li>
            <li>
                <a href="{{route('balance')}}">Balance</a>
            </li>
            <li class="active">Cash out</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4 col-lg-4 col-xs-12">
            
            @include('admin.includes.alerts')            
            
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Cash Out</h3>
                </div>
                <form role="form" action="{{ route('withdraw.store') }}" method="POST">
                    <div class="box-body">
                        <div class="form-group {{$errors->any() ? 'has-warning' : ''}}">
                            <label for="value">Value:</label>
                            <input type="number" class="form-control" id="value"
                            name="value" placeholder="$000.00" value="{{old('value')}}">
                        </div>
                    </div>    
                    <div class="box-footer">
                        <button type="submit" class="btn btn-danger">Cash out 
                            <i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i>
                        </button>
                        {!! csrf_field() !!}
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
