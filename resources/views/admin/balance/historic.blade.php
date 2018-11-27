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
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Historic</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box-tools">
                        <form action="{{route('historic.search')}}" method="POST" class="form-inline">
                            <div class="input-group input-group-sm">
                                <input type="number" name="id" class="form-control" placeholder="By id...">
                            </div>
                            <div class="input-group input-group-sm">
                                <input type="date" name="date" class="form-control">
                            </div>
                            <div class="input-group input-group-sm">
                                <select class="form-control" name="type">
                                    <option selected disabled>Type transaction</option>
                                    <option value="I">Deposit</option>
                                    <option value="O">withdraw</option>
                                    <option value="T">Transfer</option>
                                </select>                                   
                            </div>
                            <div class="btn-group btn-group-sm">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i> Filter
                                </button>
                            </div>
                            {{csrf_field()}}
                        </form>
                    </div>
                    <hr>
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
