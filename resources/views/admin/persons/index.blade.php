@extends('layouts.admin.admin_design')
@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li><a href="{{ url('/dashboard')}}">Dashboard</a></li>
                <li class="active">Sinh viên</li>
            </ol>
        </div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="login-panel panel panel-default"
                     style="height: 50px; padding-top: 10px; margin-bottom: 50px">
                    <div style="display: inline;">
                        <a style="font-size: 20px; margin-left: 20px;" href="{{route('person.create')}}">Create</a>
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
                    {{ Form::open(array('route'=>'person.index','method' => 'get')) }}
                    <div class="row" style="margin-left: 20px">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <h4 style="display:inline;">Age</h4>
                            {!! Form::number('min_age', old('min_age') ,['class' => 'form-control','style' => 'width: 400px;margin-left: 135px;margin-top: -30px','placeholder' => 'Age min']) !!}
                            {!! Form::number('max_age',old('max_age'),['class' => 'form-control','style' => 'width: 400px;margin-top: -45px;margin-left: 565px','placeholder' => 'Age max']) !!}
                        </div>
                    </div><!--/.row-->
                    <div class="row" style="margin-left: 20px">
                        <div class="col-xs-12 col-md-12 col-lg-12" style="margin-top: 40px;margin-bottom: 40px">
                            <h4 style="display:inline;">Point</h4>
                            {!! Form::number('min','',['class' => 'form-control','style' => 'width: 400px;margin-left: 135px;margin-top: -30px','placeholder' => 'Point min']) !!}
                            {!! Form::number('max','',['class' => 'form-control','style' => 'width: 400px;margin-top: -45px;margin-left: 565px','placeholder' => 'Point max']) !!}
                        </div>
                    </div><!--/.row-->
                    <div class="row" style="margin-left: 20px">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <h4 style="display:inline;">Student</h4>
                            <select class="form-control"
                                    style="display: inline;width: 20%;margin-bottom: 25px;margin-left: 50px"
                                    name="student">
                                <option value="0">Student</option>
                                <option value="1">Students learn all the subjects</option>
                                <option value="2">Students did not attend both subjects</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="margin-left: 20px">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <h4 style="display:inline;margin-bottom: 10px;">Phone</h4>
                            {{ Form::checkbox('phones[]','(086|096|097|098|032|033|034|035|036|037|038|039)[0-9]{7}',false, ['style' => 'margin-left:60px']) }}
                            Viettel
                            {{ Form::checkbox('phones[]','(091|094|083|084|085|081|082)[0-9]{7}',false) }} Vinaphone
                            {{ Form::checkbox('phones[]','(090|093)[0-9]{7}',false) }} Mobiphone
                        </div>
                    </div>
                    <div class="row" style="margin-left: 20px;margin-top:20px">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <h4 style="display:inline;margin-bottom: 10px">Pagination</h4>
                            <select class="form-control"
                                    style="display: inline;width: 20%;margin-bottom: 25px;margin-left: 20px"
                                    name="pagination" value="{{old('pagination')}}">
                                <option value="0">Paginate</option>
                                <option value="1">100</option>
                                <option value="2">1000</option>
                                <option value="3">3000</option>
                            </select>
                        </div>
                    </div>
                    {!! Form::submit('Submit',['class' => 'btn btn-info','style' => 'margin: 30px 0 20px 40px']) !!}
                    {{ Form::close() }}
                </div>
                <h4 style="display: inline">Students <h5 style="display: inline">from </h5> {{$students->firstItem()}}
                    <h5 style="display: inline"> to</h5> {{$students->lastItem()}} // {{$students->total()}}</h4>
                @if($students->total() > 0)
                    <table class="table">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Email</th>
                            <th>Faculty</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Action</th>
                            @if(auth()->user()->admin == 1)
                                <a href="/test"
                                   style="background: #3e8f3e;display: inline-block;width: 70px;float: right;height: 43px;color: floralwhite">Send
                                    Email</a>
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
                                <td style="width: 80px">{{$student->faculty->name}}</td>
                                <td style="width: 100px">{{$student->address}}</td>
                                <td style="width: 100px">{{$student->phone}}</td>
                                <td>
                                    {!! Form::open(['route' => ['person.destroy',$student->id],'method' => 'POST']) !!}
                                    <a class="btn btn-success"
                                       href="{{ route('person.show',$student->slug) }}">Detail</a>
                                    <a class="btn btn-info" href="{{ route('person.edit',$student->id) }}">Edit</a>
                                    <a data-toggle="modal" data-target="#ajax-crud-modal" id="edit-post"
                                       data-id="{{ $student->id }}"
                                       class="btn btn-info">Edit popup</a>
                                    @csrf
                                    @method('DELETE')
                                    @if(auth()->user()->admin == 1)
                                        {!! Form::submit('Delete',['class' => 'btn btn-danger']) !!}
                                    @endif
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $students->render() !!}
                @else
                    <div>No students.</div>
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
                                @if($student->gender == 1)
                                    Male {!! Form::radio('gender','1', true) !!}
                                    Female {!! Form::radio('gender','2', false) !!}
                                @else
                                    Male {!! Form::radio('gender','1', false) !!}
                                    Female {!! Form::radio('gender','2', true) !!}
                                @endif
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
@section('script')
    <script>
        $(document).ready(function () {
            const URL = "http://127.0.0.1:8000";
            $('body').on('click', '#edit-post', function () {
                var id = $(this).data('id');
                $.get(URL + `/person/${id}` + `/edit`, function (data) {
                    $("#postCrudModal").html("Edit student");
                    $('#btn-save').val("edit-post");
                    $("#ajax-crud-modal").modal('show');
                    $("#id").val(data.id);
                    $("#name").val(data.name);
                    $("#email").val(data.email);
                    $("input[type='radio']:checked").val(data.gender);
                    $("#address").val(data.address);
                    $("#phone").val(data.phone);
                    $("#faculty_id").val(data.faculty_id);
                    $("#date").val(data.date);
                    $("#file").attr('src', data.image);
                });
            });

            $("#editForm").on('submit', function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    type: 'POST',
                    url: URL + `/person/` + $("#editForm input[name=id]").val(),
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if (data.errors) {
                            console.log(data);
                            $('#message').css('display', 'block');
                            $.each(data, function (key, value) {
                                $("#message").find("ul").append('<li>' + value + '</li>');
                            });
                            $('#message').html(data.message);
                            $('#message').addClass(data.class_name);
                        }
                        if (data.success) {
                            console.log(data);
                            alert('Update success');
                            $('#ajax-crud-modal').modal('hide');
                            location.reload();
                        }

                    },
                });
            });
        });
    </script>
@endsection
