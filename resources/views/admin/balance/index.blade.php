@extends('adminlte::page')

@section('title', 'Balances')

@section('content_header')    
    <nav>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('admin')}}">Dashboard</a>
            </li>
            <li class="active">Balance</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-lg-6 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                    <h3>{{ $amount }}<sup style="font-size: 20px">$</sup></h3>            
                        <p>My Balance</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">Historic info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                    <div class="btn-group" role="group">
                        <a href="{{ route('balance.deposit') }}" class="btn btn-primary">Add cash 
                            <i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="btn-group" role="group">
                        @if($amount > 0)
                            <a href="{{ route('balance.withdraw') }}" class="btn btn-danger">Cash out 
                                <i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i>
                            </a>
                        @endif
                    </div>
                    <div class="btn-group" role="group">
                        @if($amount > 0)
                            <a href="{{ route('balance.transfer') }}" class="btn btn-info">
                                Transfer 
                                <i class="fa fa-exchange" aria-hidden="true"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>      
@stop
