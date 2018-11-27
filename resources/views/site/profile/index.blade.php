
@extends('site.layouts.app')

@section('title', 'My Profile')

@section('content')
    <div class="card mt-5">            
        <div class="card-body">
            <div class="row mt-4">
                <div class="col-md-4">
                    <img class="mx-auto d-block rounded-circle img-thumbnail shadow-sm mt-3" style="width: 10rem;"
                        src="https://via.placeholder.com/150" alt="Card image cap">
                    <div class="text-center mt-3">
                        <h6>{{auth()->user()->name}}</h6>
                        <p><small>E-mail: {{auth()->user()->email}}</small></p>
                        <a href="{{route('admin')}}" class="btn btn-success btn-sm mt-2">Go balance 
                            <i class="fa fa-usd" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-8">

                    @include('admin.includes.alerts')
                    
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Update</h4>
                            <form class="form-row" id="update" action="{{route('update.profile')}}" method="POST">
                                <div class="form-group col-5">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        aria-describedby="helpId" placeholder="your name..."
                                        value="{{auth()->user()->name}}">
                                    <small id="helpId" class="form-text text-muted"></small>
                                </div>
                                    <div class="form-group col-4">
                                    <label for="email">E-mail:</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        aria-describedby="helpId" placeholder="your@email.com"
                                        value="{{auth()->user()->email}}">
                                    <small id="helpId" class="form-text text-muted"></small>
                                </div>                                    
                                <div class="form-group col-3">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        aria-describedby="helpId" placeholder="your password">
                                    <small id="helpId" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="img">Image profile:</label>
                                    <input type="file" class="form-control-file" name="img_path" id="img"
                                        aria-describedby="fileHelpId">
                                    <small id="fileHelpId" class="form-text text-muted"></small>
                                </div>
                                @csrf
                            </form>
                            <hr>                            
                            <button type="submit" form="update" class="btn btn-primary">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update
                            </button>
                        </div>
                    </div>
                </div><!-- /.col-8 -->
            </div><!-- /.row -->
        </div> <!-- /.card-body -->
    </div><!-- /.card -->
@stop
