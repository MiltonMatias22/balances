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
            <li class="active">Deposit</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4 col-lg-4 col-xs-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Deposit</h3>
                </div>
                <form role="form" action="{{ route('deposit.store') }}" method="POST">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="value">Value:</label>
                            <input type="number" class="form-control" id="value"
                                name="value" placeholder="$000.00">
                        </div>
                    </div>    
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">Add 
                            <i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i>
                        </button>
                        {!! csrf_field() !!}
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
