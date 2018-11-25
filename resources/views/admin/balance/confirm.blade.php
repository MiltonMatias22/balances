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
            </li>
            <li>
                <a href="{{ route('balance.transfer') }}">Transfer</a>
            </li>
            <li class="active">Confirm</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4 col-lg-4 col-xs-12">
            
            @include('admin.includes.alerts')            
            

            <div class="box box-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-aqua-active">
                        <div class="widget-user-image">
                            <img class="img-circle" src="https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png" alt="User Avatar">
                        </div>
                        <!-- /.widget-user-image -->
                        <p class="widget-user-desc">Transfer to:</p>
                        <h3 class="widget-user-username">{{$sender->name}}</h3>
                        <h5 class="widget-user-desc">{{$sender->email}}</h5>
                    </div>
              </div> 

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Transfer</h3>
                    <h5>My current Balance: {{$my_current_balance}}</h5>
                </div>
                <form role="form" action="{{ route('transfer.store') }}" method="POST">
                    <div class="box-body">
                        <div class="form-group {{$errors->any() ? 'has-warning' : ''}}">
                            <input type="hidden" name="sender_id" value="{{$sender->id}}">
                            <label for="value">Value:</label>
                            <input type="number" class="form-control" id="value"
                            name="value" placeholder="$000.00" value="{{old('value')}}">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info">Confirm  
                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                        </button>
                        {!! csrf_field() !!}
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
