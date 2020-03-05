<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lumino - Register</title>
    <link href="{{ asset('css/back/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/back/datepicker3.css')}}" rel="stylesheet">
    <link href="{{asset('css/back/styles.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="row">
    <div class="col-xs-12 col-xs-offset-1 col-sm-10 col-sm-offset-2 col-md-6 col-md-offset-3">
        @if(Session::has('flash_message_error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('flash_message_error') !!}</strong>
            </div>
        @endif
        @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('flash_message_success') !!}</strong>
            </div>
        @endif
        <div class="login-panel panel panel-default">
            <div class="panel-heading">Register</div>
            <div class="panel-body">
                {!! Form::open(['url' => ['user.store'],'enctype' => 'multipart/form-data','files'=>true]) !!}
                <div class="form-group">
                    <input class="form-control" placeholder="Name" name="name" type="text" value="">
                </div>
                @if($errors->has('name'))
                    <div class="error-text">
                        {{$errors->first('name')}}
                    </div>
                @endif
                <div class="form-group">
                    {!! Form::email('email','',['class' => 'form-control','placeholder' => 'Email']) !!}
                    @if($errors->has('email'))
                        <div class="error-text">
                            {{$errors->first('email')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                </div>
                @if($errors->has('password'))
                    <div class="error-text">
                        {{$errors->first('password')}}
                    </div>
                @endif
                <div class="form-group">
                    <input class="form-control" placeholder="Re-password" name="re-password" type="password" value="">
                </div>
                @if($errors->has('re-password'))
                    <div class="error-text">
                        {{$errors->first('re-password')}}
                    </div>
                @endif
                <div class="form-group">
                    <div>
                        {!! Form::label('gender','Gender') !!}
                    </div>
                    Male {!! Form::radio('gender','1',false) !!}
                    Female{!! Form::radio('gender','2',false) !!}
                    @if($errors->has('gender'))
                        <div class="error-text">
                            {{$errors->first('gender')}}
                        </div>
                    @endif
                </div>
                <div class="checkbox">
                    <label>
                        <input name="role" type="checkbox" value="1">Have you to be admin?
                    </label>
                </div>
                <input name="social_id" type="hidden" value="1">
                <input style="margin-left: 150px" type="submit" class="btn btn-success" value="Submit">
                <a href="{{ url('auth/redirect/google') }}" class="btn btn-info">Login google</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div><!-- /.col-->
</div><!-- /.row -->


<script src="{{ asset('js/back/jquery-1.11.1.min.js')}}"></script>
<script src="{{ asset('js/back/bootstrap.min.js')}}"></script>
</body>
</html>
