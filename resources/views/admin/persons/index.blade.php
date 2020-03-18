@extends('layouts.admin.admin_design')
@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li><a href="{{ url('/dashboard')}}">Dashboard</a></li>
                <li class="active">@lang('index.Students')</li>
            </ol>
        </div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="login-panel panel panel-default"
                     style="height: 50px; padding-top: 10px; margin-bottom: 50px">
                    <div style="display: inline;">
                        <a style="font-size: 20px; margin-left: 20px;"
                           href="{{url('person/create')}}">@lang('index.Create')</a>
                    </div>
                    <div class="dropdown" style="float: right">
                        <button class="btn btn-secondary dropdown-toggle" style="margin-top: -10px" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                            @lang('index.Languages')
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ url('en/person') }}">English</a>
                            <a class="dropdown-item" href="{{ url('vi/person') }}">Viet Nam</a>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" style="margin-top: 9px">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    @if(Session::has('flash_message_info'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{!! session('flash_message_info') !!}</strong>
                        </div>
                    @endif
                </div>

                <div class="panel panel-container">
                    {{ Form::open(array('url'=>'person','method' => 'get')) }}
                    <div class="row" style="margin-left: 20px">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <h4 style="display:inline;">@lang('index.Age')</h4>
                            {!! Form::number('min_age', old('min_age') ,['class' => 'form-control','style' => 'width: 400px;margin-left: 135px;margin-top: -30px','placeholder' => "Age min"]) !!}
                            {!! Form::number('max_age',old('max_age'),['class' => 'form-control','style' => 'width: 400px;margin-top: -45px;margin-left: 565px','placeholder' => 'Age max']) !!}
                        </div>
                    </div><!--/.row-->
                    <div class="row" style="margin-left: 20px">
                        <div class="col-xs-12 col-md-12 col-lg-12" style="margin-top: 40px;margin-bottom: 40px">
                            <h4 style="display:inline;">@lang('index.Point')</h4>
                            {!! Form::number('min','',['class' => 'form-control','style' => 'width: 400px;margin-left: 135px;margin-top: -30px','placeholder' => 'Point min']) !!}
                            {!! Form::number('max','',['class' => 'form-control','style' => 'width: 400px;margin-top: -45px;margin-left: 565px','placeholder' => 'Point max']) !!}
                        </div>
                    </div><!--/.row-->
                    <div class="row" style="margin-left: 20px">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <h4 style="display:inline;">@lang('index.Students')</h4>
                            <select class="form-control"
                                    style="display: inline;width: 20%;margin-bottom: 25px;margin-left: 50px"
                                    name="student">
                                <option value="0" {{ old('student') == 0 ? 'selected' : '' }}>@lang('index.Student')</option>
                                <option value="1" {{ old('student') == 1 ? 'selected' : '' }}>@lang('index.Students learn all the subjects')</option>
                                <option value="2" {{ old('student') == 2 ? 'selected' : '' }}>@lang('index.Students did not attend both subjects')</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="margin-left: 20px">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <h4 style="display:inline;margin-bottom: 10px;">@lang('index.Phone')</h4>
                            {{ Form::checkbox('phones[]','(086|096|097|098|032|033|034|035|036|037|038|039)[0-9]{7}',false, ['style' => 'margin-left:70px']) }}
                            Viettel
                            {{ Form::checkbox('phones[]','(091|094|083|084|085|081|082)[0-9]{7}',false) }} Vinaphone
                            {{ Form::checkbox('phones[]','(090|093)[0-9]{7}',false) }} Mobiphone
                        </div>
                    </div>
                    <div class="row" style="margin-left: 20px;margin-top:20px">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <h4 style="display:inline;margin-bottom: 10px">@lang('index.Pagination')</h4>
                            <select class="form-control"
                                    style="display: inline;width: 20%;margin-bottom: 25px;margin-left: 20px"
                                    name="pagination" value="{{old('pagination')}}">
                                <option value="0" {{ old('pagination') == 0 ? 'selected' : '' }}>@lang('index.Pagination')</option>
                                <option value="1" {{ old('pagination') == 1 ? 'selected' : '' }}>100</option>
                                <option value="2" {{ old('pagination') == 2 ? 'selected' : '' }}>1000</option>
                                <option value="3" {{ old('pagination') == 3 ? 'selected' : '' }}>3000</option>
                            </select>
                        </div>
                    </div>
                    {!! Form::submit('Submit',['class' => 'btn btn-info','style' => 'margin: 30px 0 20px 40px']) !!}
                    {{ Form::close() }}
                </div>
                @if($students == '')
                    <h4>@lang('index.No persons')</h4>
                @else
                    <h4 style="display: inline">@lang('index.Students')<h5 style="display: inline">
                            @lang('index.from') </h5> {{$students->firstItem()}}
                        <h5 style="display: inline"> @lang('index.to')</h5> {{$students->lastItem()}}
                        // {{$students->total()}}</h4>
                    @if($students->total() > 0)
                        <table class="table">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>@lang('index.Name')</th>
                                <th>@lang('index.Image')</th>
                                <th>@lang('index.Email')</th>
                                <th>@lang('index.Faculty')</th>
                                <th>@lang('index.Address')</th>
                                <th>@lang('index.Phone')</th>
                                <th>@lang('index.Action')</th>
                                @if(auth()->user()->admin == 1)
                                    <a href="/test"
                                       style="display: inline-block;margin: -32px 0 15px 1050px;height: 40px"
                                       class="btn btn-info">@lang('index.Send Email')</a>
                                @endif
                            </tr>
                            </thead>
                            <tbody id="posts-crud">
                            @foreach($students as $key => $student)
                                <tr id="post_id_{{ $student->id }}">
                                    <td>{{ $key+1 }}</td>
                                    <td style="width: 100px;">{{$student->name}}</td>
                                    <td>
                                        <img src="{{asset($student->image)}}" style="width: 80px;height: 80px">
                                    </td>
                                    <td style="width: 100px">{{$student->email}}</td>
                                    @foreach($faculties as $faculty)
                                        @if($student->faculty_id == $faculty->id)
                                            <td style="width: 80px">{{$faculty->name}}</td>
                                        @endif
                                    @endforeach
                                    <td style="width: 100px">{{$student->address}}</td>
                                    <td style="width: 100px">{{$student->phone}}</td>
                                    <td>
                                        {!! Form::open(['route' => ['person.destroy',$student->id],'method' => 'POST']) !!}
                                        @if(app()->getLocale() == 'en')
                                            <a class="btn btn-success"
                                               href="{{ url('en/person',$student->slug) }}">@lang('index.Show')</a>
                                        @else
                                            <a class="btn btn-success"
                                               href="{{ url('vn/person',$student->slug) }}">@lang('index.Show')</a>
                                        @endif
                                        @if(auth()->user()->admin == 1)
                                            <a data-toggle="modal" data-target="#ajax-crud-modal" id="edit-post"
                                               data-id="{{ $student->id }}"
                                               class="btn btn-info">{{ __('Edit popup') }}</a>
                                            @csrf
                                            @method('DELETE')
                                            {!! Form::submit('Delete',['class' => 'btn btn-danger']) !!}
                                        @else
                                            @if(auth()->user()->email  ==$student->email)
                                                <a data-toggle="modal" data-target="#ajax-crud-modal" id="edit-post"
                                                   data-id="{{ $student->id }}"
                                                   class="btn btn-info">{{ __('Edit popup') }}</a>
                                            @endif
                                        @endif
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $students->render() !!}
                    @else
                        <div>{{ __('No students') }}.</div>
                    @endif
                @endif
            </div>
        </div>
        <div class="modal fade" id="ajax-crud-modal" tabindex="-1" role="dialog" aria-labelledby="ajax-crud-modal"
             aria-hidden="true">
            <div class="modal-dialog">
                <form id="editForm" enctype="multipart/form-data">
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="postCrudModal">Update student</h4>
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                                ×
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert" id="message" style="display: none">
                                <ul></ul>
                            </div>
                            <div class="form-group" style="margin-left: 20px;margin-top: 20px">
                                <input type="hidden" name="slug" id="slug">
                                <input type="hidden" name="id" id="id">
                                {!! Form::label('name','Name') !!}
                                <span class="required">*</span>
                                {!! Form::text('name','', ['class' => 'form-control','id' => 'name', 'placeholder' => 'Name', 'style' => 'margin-top:15px;'])  !!}
                            </div>
                            <div class="form-group" style="margin-left: 20px">
                                {!! Form::label('email','Email') !!}
                                <span class="required">*</span>
                                {!! Form::email('email','',['class' => 'form-control','id' => 'email','placeholder' => 'Email']) !!}
                            </div>
                            <div class="form-group" style="margin-left: 20px">
                                <div>
                                    {!! Form::label('gender','Gender') !!}
                                    <span class="required">*</span>
                                </div>
                                Male {!! Form::radio('gender','1',['class' => 'radio']) !!}
                                Female {!! Form::radio('gender','2',['class' => 'radio']) !!}
                            </div>
                            <div class="form-group" style="margin-left: 20px">
                                {!! Form::label('address','Address') !!}
                                <span class="required">*</span>
                                {!! Form::text('address','',['id' => 'address' ,'class'=>'form-control','placeholder'=>'Address']) !!}
                            </div>
                            <div class="form-group" style="margin-left: 20px">
                                {!! Form::label('phone','Phone') !!}
                                <span class="required">*</span>
                                <input class="form-control" type="text" value=""
                                       placeholder="Phone" name="phone" id="phone">
                            </div>
                            <div class="form-group" style="width: 50%; margin-left: 20px">
                                {!! Form::label('faculty_id','Faculty') !!}
                                <span class="required">*</span>
                                <select class="form-control" name="faculty_id" id="faculty_id">
                                    @foreach($faculties as $faculty)
                                        <option value="{{$faculty->id}}">{{$faculty->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" style="margin-left: 20px">
                                {!! Form::label('image','Image') !!}
                                <span class="required">*</span>
                                <img src="" id="file"
                                     style="width: 80px;height:80px;margin:0 0 20px 30px" name="file">
                                {!! Form::file('image') !!}
                            </div>
                            <div class="form-group" style="margin-left: 20px">
                                {!! Form::label('date','Date') !!}
                                <span class="required">*</span>
                                {{ Form::date('date', '', ['class' => 'form-control','id' => 'date']) }}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-info" id="btn-edit" type="submit" value="add">
                                Update student
                            </button>
                            <input class="btn btn-default" data-dismiss="modal" type="button" value="Cancel">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
