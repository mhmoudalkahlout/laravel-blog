@extends('main')
@section('title', '| Login')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                {!! Form::open(['class' => 'form-horizontal']) !!}
                        
                        <div class="form-group">
                            {{ Form::label('email', 'Email:', ['class' => 'col-md-2 control-label']) }}
                            <div class="col-md-10">
                                {{ Form::email('email', null, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        
                        <div class="form-group">
                            {{ Form::label('password', 'Password:', ['class' => 'col-md-2 control-label']) }}
                            <div class="col-md-10">
                                {{ Form::password('password', ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <div class="checkbox">
                                    <label>
                                        {{ Form::checkbox('remember') }} Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>
                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                            </div>
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
