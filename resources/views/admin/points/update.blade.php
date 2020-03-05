@extends('layouts.admin.admin_design')
@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                <li class="active">Điểm</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">Điểm</div>
                    {!! Form::open(['route' => ['point.update',$point->id],'method' => 'put','enctype' => 'multipart/form-data']) !!}
                    <div class="form-group" style="margin-left: 20px">
                        {!! Form::label('point','Point',['style' => 'margin-top:20px']) !!}
                        {!! Form::number('point',$point->point, ['class' => 'form-control', 'placeholder' => 'Point', 'style' => 'width:25%;margin-top:15px;'])  !!}
                        @if($errors->has('point'))
                            <div class="error-text">
                                {{$errors->first('point')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group" style="margin-left: 390px;margin-top:-86px">
                        {!! Form::label('person_id','Person') !!}
                        {!! Form::number('person_id',$point->person_id,['class' => 'form-control','style'=>'width:35%']) !!}
                        @if($errors->has('person_id'))
                            <div class="error-text">
                                {{$errors->first('person_id')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group" style="margin-top:-86px;margin-left: 715px">
                        {!! Form::label('subject_id','Subject') !!}
                        {!! Form::number('subject_id',$point->subject_id,['class' => 'form-control','style' => 'width:55%']) !!}
                        @if($errors->has('subject_id'))
                            <div class="error-text">
                                {{$errors->first('subject_id')}}
                            </div>
                        @endif
                    </div>
                    {!! Form::submit('Submit', ['style' => 'margin: 0 0 20px 20px','class' => 'btn btn-success']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div><!--/.row-->
    </div>
@endsection
