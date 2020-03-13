@extends('layouts.admin.admin_design')
@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                <li class="active">Students</li>
            </ol>
        </div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">Students</div>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>
                        @endforeach
                    @endif
                    {!! Form::open(['route' => ['user.update',$user->id],'method'=>'post','enctype' => 'multipart/form-data','files' => 'true']) !!}
                    @method('put')
                    <div class="form-group" style="margin : 20px 0 0 20px">
                        <input type="hidden" value="{{$user->id}}" name="id">
                        {!! Form::label('name','Name') !!}
                        <span class="required">*</span>
                        {!! Form::text('name',$user->name, ['class' => 'form-control', 'placeholder' => 'Name', 'style' => 'width:50%;margin-top:15px;'])  !!}
                        @if($errors->has('name'))
                            <div class="error-text">
                                {{$errors->first('name')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group" style="margin-left: 20px">
                        {!! Form::label('email','Email') !!}
                        <span class="required">*</span>
                        {!! Form::email('email',$user->email,['class' => 'form-control','placeholder' => 'Email', 'style' => 'width:50%']) !!}
                        @if($errors->has('email'))
                            <div class="error-text">
                                {{$errors->first('email')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group" style="margin-left: 20px">
                        {!! Form::label('phone','Phone') !!}
                        <span class="required">*</span>
                        {!! Form::text('phone',$user->phone,['class'=>'form-control','placeholder'=>'Phone','style'=>'width:50%']) !!}
                        @if($errors->has('phone'))
                            <div class="error-text">
                                {{$errors->first('phone')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group" style="margin-left: 20px">
                        {!! Form::label('image','Image') !!}
                        <span class="required">*</span>
                        <img src="{{asset($user->image)}}" style="width: 80px;height:80px;margin:0 0 20px 30px"
                             name="image">
                        {!! Form::file('image') !!}
                        @if($errors->has('image'))
                            <div class="error-text">
                                {{$errors->first('image')}}
                            </div>
                        @endif
                    </div>
                    <input type="hidden" name="admin" value="{{$user->admin}}">
                    <input type="hidden" value="{{$user->password}}" name="password">
                    <input type="hidden" name="re-password" value="1">
                    <input type="hidden" name="social_id" value="{{$user->social_id}}">
                    {!! Form::submit('Submit', ['style' => 'margin:0 0 20px 20px', 'class' => 'btn btn-success']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div><!--/.row-->
    </div>
@endsection