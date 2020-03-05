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
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">Điểm</div>
                    {!! Form::open(['route' => ['point.store'],'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group">
                        {!! Form::number('point','0', ['class' => 'form-control', 'placeholder' => 'Point', 'style' => 'width:50%;margin-top:15px;',])  !!}
                        @if($errors->has('point'))
                            <div class="error-text">
                                {{$errors->first('point')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        {!! Form::label('person_id','Person') !!}
                        <select style="width: 50%" class="form-control" name="person_id">
                            <option>Select option</option>
                            @foreach($persons as $person)
                                <option value="{{$person->id}}">{{$person->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('person_id'))
                            <div class="error-text">
                                {{$errors->first('person_id')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        {!! Form::label('subject_id','Subject') !!}
                        <select class="form-control" style="width: 50%" name="subject_id">
                            <option>Select option</option>
                            @foreach($subjects as $subject)
                                <option value="{{$subject->id}}">{{$subject->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('subject_id'))
                            <div class="error-text">
                                {{$errors->first('subject_id')}}
                            </div>
                        @endif
                    </div>
                    {!! Form::submit('Submit', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div><!--/.row-->
    </div>
@endsection
