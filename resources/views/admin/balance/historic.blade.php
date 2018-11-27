@extends('adminlte::page')

@section('title', 'Historic')

@section('content_header')    
    <nav>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('admin')}}">Dashboard</a>
            </li>
            <li class="active">Historic</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">My Historic</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>amount</th>
                                <th>Before</th>
                                <th>After</th>
                                <th>Date</th>
                                <th>Transaction</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($historic as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->type}}</td>
                                    <td>$ {{$item->amount}}</td>
                                    <td>$ {{$item->total_before}}</td>
                                    <td>$ {{$item->total_after}}</td>
                                    <td>{{$item->date}}</td>
                                    <td>
                                        @if ($item->user_id_transaction)
                                            {{$item->userSender->name}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            @if(!$historic)                            
                                <tr>
                                    <h4>No Historic!</h4>
                                </tr>
                            @endif
                            
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    <!-- paginate -->
                    {{$historic}}
                </div>              
            </div>
            <!-- /.box -->
          </div>
    </div>
@stop
