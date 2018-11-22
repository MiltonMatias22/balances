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
            <li class="active">Transfer</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4 col-lg-4 col-xs-12">
            
            @include('admin.includes.alerts')            
            
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Transfer</h3>
                </div>
                <form role="form" action="{{ route('confirm.transfer') }}" method="POST">
                    <div class="box-body">
                        <div class="form-group {{$errors->any() ? 'has-warning' : ''}}">
                            <label for="sender">send to:</label>
                            <input type="text" class="form-control" id="sender"
                            name="sender" placeholder="Name or E-mail" value="{{old('sender')}}">
                        </div>
                    </div>    
                    <div class="box-footer">
                        <button type="submit" class="btn btn-warning">Next  
                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                        </button>
                        {!! csrf_field() !!}
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
