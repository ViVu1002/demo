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
        @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('flash_message_success') !!}</strong>
            </div>
        @endif
        <div class="login-panel panel panel-default">
            <div class="panel-heading">Register</div>
            <div class="panel-body">
                {!! Form::open(['route' => ['user.store'],'enctype' => 'multipart/form-data','files'=>true]) !!}
                <div class="form-group">
                    {!! Form::label('name','Name') !!}
                    <span class="required">*</span>
                    <input class="form-control" name="name" type="text" value="{{old('name')}}">
                </div>
                @if($errors->has('name'))
                    <div class="error-text">
                        {{$errors->first('name')}}
                    </div>
                @endif
                <div class="form-group">
                    {!! Form::label('email','Email') !!}
                    <span class="required">*</span>
                    {!! Form::email('email','',['class' => 'form-control','old' => 'email','placeholder' => 'Email']) !!}
                    @if($errors->has('email'))
                        <div class="error-text">
                            {{$errors->first('email')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    {!! Form::label('phone','Phone') !!}
                    <span class="required">*</span>
                    <input class="form-control" style="width: 50%" type="text" placeholder="Phone" name="phone" value="{{old('phone')}}">
                    @if($errors->has('phone'))
                        <div class="error-text">
                            {{$errors->first('phone')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    {!! Form::label('image','Image') !!}
                    <span class="required">*</span>
                    {{ Form::file('image')}}
                    @if($errors->has('image'))
                        <div class="error-text">
                            {{$errors->first('image')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    {!! Form::label('password','Password') !!}
                    <span class="required">*</span>
                    <input class="form-control" placeholder="Password" name="password" type="password" value="{{old('password')}}">
                </div>
                @if($errors->has('password'))
                    <div class="error-text">
                        {{$errors->first('password')}}
                    </div>
                @endif
                <div class="form-group">
                    {!! Form::label('re-password','Re-password') !!}
                    <span class="required">*</span>
                    <input class="form-control" placeholder="Re-password" name="re-password" type="password" value="{{old('re-password')}}">
                </div>
                @if($errors->has('re-password'))
                    <div class="error-text">
                        {{$errors->first('re-password')}}
                    </div>
                @endif
                <div class="checkbox">
                    <label>
                        <input name="admin" type="hidden" value="0">
                        <input name="admin" type="checkbox" value="1">Have you to be admin?
                    </label>
                </div>
                <input name="social_id" type="hidden" value="1">
                <input style="margin-left: 150px" type="submit" class="btn btn-success" value="Submit">
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
