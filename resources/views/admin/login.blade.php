<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lumino - Login</title>
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
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        @if(Session::has('flash_message_error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('flash_message_error') !!}</strong>
            </div>
        @endif
        @if ($message = Session::get('success'))
            <div class="alert alert-success" style="margin-top: 10px">
                <p>{{ $message }}</p>
            </div>
        @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <div class="login-panel panel panel-default">
            <div class="panel-heading">Log in</div>
            <div class="panel-body">
                {!! Form::open(['url' => ['login/post/user'],'method' => 'post']) !!}
                @csrf
                <div class="form-group">
                    {!! Form::email('email','',['placeholder' => 'Email','class' => 'form-control']) !!}
                </div>
                @if($errors->has('email'))
                    <div class="error-text">
                        {{$errors->first('email')}}
                    </div>
                @endif
                <div class="form-group">
                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                </div>
                @if($errors->has('password'))
                    <div class="error-text">
                        {{$errors->first('password')}}
                    </div>
                @endif
                <input name="social_id" type="hidden" value="1">
                <input style="margin-left: 100px" type="submit" class="btn btn-success" value="Login">
                <a href="{{ url('auth/google') }}" style="margin-left: 80px" type="submit" class="btn btn-info">Login google</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div><!-- /.col-->
</div><!-- /.row -->


<script src="{{ asset('js/back/jquery-1.11.1.min.js')}}"></script>
<script src="{{ asset('js/back/bootstrap.min.js')}}"></script>
</body>
</html>
