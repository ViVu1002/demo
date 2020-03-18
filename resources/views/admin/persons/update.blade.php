@extends('layouts.admin.admin_design')
@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                <li class="active">Sinh viên</li>
            </ol>
        </div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">Sinh viên</div>
                    {!! Form::open(['url' => ['person-update',$person->id],'method'=>'post','enctype' => 'multipart/form-data','files' => 'true']) !!}
                    @method('post')
                    <div class="form-group" style="margin : 20px 0 0 20px">
                        <input type="hidden" value="{{$person->id}}" name="id">
                        {!! Form::label('name','Name') !!}
                        <span class="required">*</span>
                        {!! Form::text('name',$person->name, ['class' => 'form-control', 'placeholder' => 'Name', 'style' => 'width:50%;margin-top:15px;'])  !!}
                        @if($errors->has('name'))
                            <div class="error-text">
                                {{$errors->first('name')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group" style="margin-left: 20px">
                        {!! Form::label('email','Email') !!}
                        <span class="required">*</span>
                        {!! Form::email('email',$person->email,['class' => 'form-control','placeholder' => 'Email', 'style' => 'width:50%']) !!}
                        @if($errors->has('email'))
                            <div class="error-text">
                                {{$errors->first('email')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group" style="margin-left: 20px">
                        <div>
                            {!! Form::label('gender','Gender') !!}
                            <span class="required">*</span>
                        </div>
                        @if($person->gender == 1)
                            Male {!! Form::radio('gender','1', true) !!}
                            Female {!! Form::radio('gender','2', false) !!}
                        @else
                            Male {!! Form::radio('gender','1', false) !!}
                            Female {!! Form::radio('gender','2', true) !!}
                        @endif
                        @if($errors->has('gender'))
                            <div class="error-text">
                                {{$errors->first('gender')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group" style="margin-left: 20px">
                        {!! Form::label('address','Address') !!}
                        <span class="required">*</span>
                        {!! Form::text('address',$person->address,['class'=>'form-control','placeholder'=>'Address','style'=>'width:50%']) !!}
                        @if($errors->has('address'))
                            <div class="error-text">
                                {{$errors->first('address')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group" style="margin-left: 20px">
                        {!! Form::label('phone','Phone') !!}
                        <span class="required">*</span>
                        {!! Form::text('phone',$person->phone,['class'=>'form-control','placeholder'=>'Phone','style'=>'width:50%']) !!}
                        @if($errors->has('phone'))
                            <div class="error-text">
                                {{$errors->first('phone')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group" style="width: 50%; margin-left: 20px">
                        {!! Form::label('faculty_id','Faculty') !!}
                        <span class="required">*</span>
                        <select class="form-control" name="faculty_id">
                            @foreach($faculties as $faculty)
                                <option value="{{$faculty->id}}" @if(isset($person->faculty_id) == $faculty->id) {{'selected = selected'}} @endif>{{$faculty->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('faculty_id'))
                            <div class="error-text">
                                {{$errors->first('faculty_id')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group" style="margin-left: 20px">
                        {!! Form::label('image','Image') !!}
                        <span class="required">*</span>
                        <img src="{{asset($person->image)}}" style="width: 80px;height:80px;margin:0 0 20px 30px" name="image">
                        {!! Form::file('image') !!}
                        @if($errors->has('image'))
                            <div class="error-text">
                                {{$errors->first('image')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group" style="margin-left: 20px">
                        {!! Form::label('date','Date') !!}
                        <span class="required">*</span>
                        {{ Form::date('date', $person->date, ['class' => 'form-control','style' => 'width:50%']) }}
                        @if($errors->has('date'))
                            <div class="error-text">
                                {{$errors->first('date')}}
                            </div>
                        @endif
                    </div>
                    <input type="hidden" name="slug">
                    {!! Form::submit('Submit', ['style' => 'margin:0 0 20px 20px', 'class' => 'btn btn-success']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div><!--/.row-->
    </div>
@endsection
