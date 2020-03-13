<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lumino - Dashboard</title>
    <link href="{{ asset('css/back/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/back/datepicker3.css')}}" rel="stylesheet">
    <link href="{{ asset('css/back/styles.css')}}" rel="stylesheet">

    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i"
          rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{ asset('css/back/html5shiv.js')}}"></script>
    <script src="{{ asset('css/back/respond.min.js')}}"></script>
    <![endif]-->
</head>
<body>

@include('layouts.admin.admin_header')

@include('layouts.admin.admin_nav')

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
                 style="height: 50px; padding-top: 10px">
                <div style="display: inline;">
                    <a style="font-size: 20px" href="{{route('person.index')}}">Person</a>
                </div>
            </div>
        </div>
    </div>
    @if ($message = Session::get('info'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-5">
            <div class="row">
                <div class="col-lg-3">
                    <img style="width: 90px; height:90px;margin:40px 0 0 20px;border-radius: 50px"
                         src="{{asset($person->image)}}">
                </div>
                <div class="col-lg-9" style="margin-top: 10px">
                    <h2>{{$person->name}}</h2>
                    <h5>Email : {{$person->email}}</h5>
                    <h5>Faculty : {{$person->faculty->name}}</h5>
                    @if($person->gender == 1)
                        <h5> Gender : Male</h5>
                    @else
                        <h5>Gender : Female</h5>
                    @endif
                    <h5>Address : {{$person->address}}</h5>
                    <h5>Date : {{$person->date}}</h5>
                    <h5>Phone : {{$person->phone}}</h5>
                    <a data-toggle="modal" data-target="#ajax-crud-modal" id="edit-post"
                       data-id="{{ $person->id }}"
                       class="btn btn-info">Edit popup</a>
                </div>
            </div>
        </div>
        <div class="col-lg-7" style="margin-top: 10px">
            <h3>Subject</h3>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Subject</th>
                            <th>Point</th>
                            @if(auth()->user()->admin == 1)
                                <th>Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($person->subjects as $key => $subject)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$subject->name}}</td>
                                <td>{{$subject->pivot->point}}</td>
                                <td>
                                    @if(auth()->user()->admin == 1)
                                        {!! Form::open(['url' => ['person/delete',$person->id,$subject->id],'method' => 'delete']) !!}
                                        @csrf
                                        @method('DELETE')
                                        {!! Form::submit('Delete',['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success" style="margin-top: 10px">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger" style="margin-top: 10px">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger" style="margin-top: 30px">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h3>Update subject</h3>
    @if(auth()->user()->admin == 0)
        <div class="row">
            <div class="col-lg-6">
                {!! Form::open(array('url' => ['person/point',$person->id],'method' => 'post','class'=> 'formPoint')) !!}
                @csrf
                <input type="hidden" name="person_id" value="{{$person->id}}">
                <div class="field_wrapper" style="margin-top: 20px">
                    <h4 style="display: inline;">Create point</h4>
                    <a href="javascript:void(0);" class="add_button" style="display: inline;"
                       title="Add field">
                        <i class="fas fa-plus-circle"></i>
                    </a>
                </div>
                <div id="container">
                    @if ($errors->any())
                        <?php
                        if (old('subject_id') == '' && old('point') == '') {
                            $a = 'No subject';
                        } else {
                            $subjects = collect(old('subject_id'));
                            $point = collect(old('point'));
                            foreach ($point as $key => $item) {
                                $combined = $subjects->combine($point);
                            }
                            $results = collect($combined->whereNotBetween('point', [1, 10]));
                            foreach ($results as $key => $result) {
                                $value[] = $key;
                            }
                            $subject_points = \App\Subject::all(['name', 'id'])->whereIn('id', $value);
                            $points = $results->implode('point', ',');
                            $convert = explode(',', $points);
                            foreach ($subject_points as $subject_point) {
                                $subs[] = $subject_point;
                            }
                            foreach ($subs as $key => $sub) {
                                foreach ($convert as $index => $con) {
                                    if ($key == $index) {
                                        $sub->point = $con;
                                    }
                                }
                            }
                            $subs = collect($subs);
                            $sus = $subs->whereNotBetween('point', [0, 10]);
                        }
                        ?>
                        @if(!empty($subs))
                            @foreach($subs as $sub)
                                <select name="subject_id[]" class="form-control" id="convert"
                                        style="width:35%;display: inline;height:45px;">
                                    <option value="{{$sub->id}}">{{$sub->name}}</option>
                                    <input type="number" class="form-control" id="convert_input"
                                           style="width: 35%;display: inline;margin-top: 20px;margin-left: 5px;"
                                           placeholder="Point"
                                           name="point[][point]' + x + '" value="{{$sub->point}}"/>
                                </select>
                            @endforeach
                        @endif
                    @endif
                </div>
                {!! Form::submit('Create point',array('class' => 'btn btn-info submit','style' => 'margin-top:20px')) !!}
                {!! Form::close() !!}
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-lg-6">
                {!! Form::open(array('url' => ['person/point',$person->id],'method' => 'post','class'=> 'formPoint')) !!}
                @csrf
                <input type="hidden" name="person_id" value="{{$person->id}}">
                @foreach($datas as $data)
                    <select name="subject_id[]" class="form-control"
                            style="width:35%;display: inline;height:45px;">
                        <option value="{{$data->id}}">{{$data->name}}</option>
                        <input type="number" class="form-control"
                               style="width: 35%;display: inline;margin-top: 20px;margin-left: 5px;" placeholder="Point"
                               name="point[][point]' + x + '" value="{{$data->pivot->point}}"/>
                    </select>
                @endforeach
                <div class="field_wrapper" style="margin-top: 20px">
                    <h4 style="display: inline;">Create point</h4>
                    <a href="javascript:void(0);" class="add_button" style="display: inline;"
                       title="Add field">
                        <i class="fas fa-plus-circle"></i>
                    </a>
                </div>
                <div id="container">
                    @if ($errors->any())
                        <?php
                        if (old('subject_id') == '' && old('point') == '') {
                            $a = 'No subject';
                        } else {
                            $subject_id = collect(old('subject_id'));
                            $point = collect(old('point'));
                            foreach ($point as $key => $value) {
                                $combined = $subject_id->combine($point);
                            }
                            $results = $combined->whereNotBetween('point', [1, 10]);
                            foreach ($results as $key => $result) {
                                $value[] = $key;
                            }
                            $subject_points = \App\Subject::all(['name', 'id'])->whereIn('id', $value);
                            $points = $results->implode('point', ',');
                            $convert = explode(',', $points);
                            foreach ($subject_points as $subject_point) {
                                $subs[] = $subject_point;
                            }
                            foreach ($subs as $key => $sub) {
                                foreach ($convert as $index => $con) {
                                    if ($key == $index) {
                                        $sub->point = $con;
                                    }
                                }
                            }
                            $subs = collect($subs);
                            $sus = $subs->whereNotBetween('point', [1, 10]);
                        }
                        ?>
                        @if(!empty($sus))
                            @foreach ($sus as $sub)
                                <select name="subject_id[]" class="form-control"
                                        style="width:35%;display: inline;height:45px;">
                                    <option value="{{$sub->id}}">{{$sub->name}}</option>
                                    <input type="number" class="form-control"
                                           style="width: 35%;display: inline;margin-top: 20px;margin-left: 5px;"
                                           placeholder="Point"
                                           name="point[][point]' + x + '" value="{{$sub->point}}"/>
                                </select>
                            @endforeach
                        @endif
                    @endif
                </div>
                {!! Form::submit('Create point',array('class' => 'btn btn-info submit','style' => 'margin-top:20px')) !!}
                {!! Form::close() !!}
            </div>
        </div>
    @endif

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
                            {!! Form::text('name','',['class' => 'form-control','id' => 'name', 'placeholder' => 'Name', 'style' => 'margin-top:15px;'])  !!}
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
</div><!--/.row-->
<script src="{{ asset('js/back/jquery-1.11.1.min.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('js/back/bootstrap.min.js')}}"></script>
<script src="{{ asset('js/back/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('js/back/custom.js')}}"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<script src="demoValidation.js" type="text/javascript"></script>
<script>
    //add point
    $(document).ready(function () {
        //edit
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
                $(".radio:checked").val(data.gender);
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
        //point
        var subject_points = $(@json($subject_points));
        var maxField = subject_points.length;
        var addButton = $('.add_button');
        var wrapper = $('.field_wrapper');
        var x = 1;
        $(addButton).click(function (event) {
            if (x <= maxField) {
                $(wrapper).append($('<div><select name="subject_id[]" class="form-control subjects" id="subjects' + x + '" style="width:35%;display: inline;height:45px " >\n' +
                    '                                    @if(auth()->user()->admin == 0) @foreach($subject_points as $item) <option value="{{$item->id}}">{{$item->name}}</option> @endforeach @else @foreach($subjects as $subject)\n' +
                    '                                 <option value="{{$subject->id}}">{{$subject->name}}</option>\n' +
                    '                                    @endforeach @endif\n' +
                    '                                </select><input type="number" id="point' + x + '" class="form-control point" style="width: 35%;display: inline;margin-top: 20px;margin-left: 5px;" placeholder="Point" name="point[][point]' + x + '" value="{{old('point+x+')}}"/>' +
                    '<a href="javascript:void(0);" class="remove_button" title="Remove field">Remove</a></div>'));
                x++;
            } else {
                var array = [];
                if (array.length >= 0) {
                    array.pop();
                }
                array.unshift("No subject");
                $("#container").html(array);
            }
        });
        $(wrapper).on('click', '.remove_button', function (e) {
            e.preventDefault();
            $(this).parent('div').remove();
            $("#container").remove();
            x--;
        });
        $(wrapper).on('click', '.add_button', function (evt) {
            $('select').each(function () {
                $('select').not(this).find('option[value="' + this.value + '"]').remove();
            });
        });

        $(wrapper).on('click', 'option', function (evt) {
            $('select').each(function () {
                $('select').not(this).find('option[value="' + this.value + '"]').remove();
            });
        });
        $(wrapper).on('click', '.remove_button', function (event) {
            var arr = [];
            var results = [];
            $('.subjects option').each(function (index, value) {
                var name = $(value).text();
                var id = $(value).val();
                results.push({id, name});
            });
            $.each(subject_points, function (index, value) {
                var id = value.id;
                var name = value.name;
                arr.push({id, name});
            });
            var res = arr.filter(item1 => !results.some(item2 => (item2.id == item1.id && item2.name == item1.name)));
            $.each(res, function (index, value) {
                $('.subjects').append($('<option>', {
                    value: value.id,
                    text: value.name
                }));
            });
        });
    });
    //https://stackoverflow.com/questions/17632180/jquery-validate-array-input-element-which-is-created-dynamically
    //https://stackoverflow.com/questions/37048950/validate-array-of-inputs-using-validate-plugin-jquery-show-errors-for-each-inp
    //https://stackoverflow.com/questions/51227594/jquery-disable-multiple-option-on-multiple-select-based-on-array-of-select
</script>
</body>
</html>
