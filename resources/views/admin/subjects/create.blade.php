@extends('layouts.admin.admin_design')
@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                <li class="active">Môn học</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">Môn học</div>
                    {!! Form::open(['route' => ['subject.store'],'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group" style="margin-left: 20px">
                        {!! Form::label('name','Name') !!}
                        <span class="required">*</span>
                        {!! Form::text('name','', ['class' => 'form-control', 'placeholder' => 'Name', 'style' => 'width:50%;margin-top:15px;'])  !!}
                        @if($errors->has('name'))
                            <div class="error-text">
                                {{$errors->first('name')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group" style="margin-left: 20px">
                        {!! Form::label('description','Description') !!}
                        <span class="required">*</span>
                        {!! Form::text('description','',['class'=>'form-control','placeholder'=>'Description','style'=>'width:50%']) !!}
                        @if($errors->has('description'))
                            <div class="error-text">
                                {{$errors->first('description')}}
                            </div>
                        @endif
                    </div>
                    {!! Form::submit('Submit', ['class' => 'btn btn-success','style' => 'margin:0 0 20px 20px']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div><!--/.row-->
    </div>
@endsection

