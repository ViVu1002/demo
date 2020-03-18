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
            <li class="active">{{ __('Students') }}</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <div class="login-panel panel panel-default"
                 style="height: 50px; padding-top: 10px">
                <div style="display: inline;">
                    <a style="font-size: 20px" href="{{url('person')}}">@lang('index.Students')</a>
                </div>
                <div class="dropdown" style="float: right">
                    <button class="btn btn-secondary dropdown-toggle" style="margin-top: -10px" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @lang('index.Languages')
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ url('en/person',$person->slug) }}">@lang('index.English')</a>
                        <a class="dropdown-item" href="{{ url('vi/person',$person->slug) }}">@lang('index.Viet Nam')</a>
                    </div>
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
                    <h5>@lang('index.Email') : {{$person->email}}</h5>
                    <h5>@lang('index.Faculty') : {{$person->faculty->name}}</h5>
                    @if($person->gender == 1)
                        <h5> @lang('index.Gender') : @lang('index.Male')</h5>
                    @else
                        <h5>@lang('index.Gender') : @lang('index.Female')</h5>
                    @endif
                    <h5>@lang('index.Address') : {{$person->address}}</h5>
                    <h5>@lang('index.Date') : {{$person->date}}</h5>
                    <h5>@lang('index.Phone') : {{$person->phone}}</h5>
                    <a href="{{ url('person-update',$person->id) }}" class="btn btn-info">@lang('index.Update student')</a>
                </div>
            </div>
        </div>
        <div class="col-lg-7" style="margin-top: 10px">
            <h3>@lang('index.Subject')</h3>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>@lang('index.Subject')</th>
                            <th>@lang('index.Point')</th>
                            @if(auth()->user()->admin == 1)
                                <th>@lang('index.Action')</th>
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
    <h3>@lang('index.Update subject')</h3>
    @if(auth()->user()->admin == 0)
        <div class="row">
            <div class="col-lg-6">
                {!! Form::open(array('url' => ['person/point',$person->id],'method' => 'post','class'=> 'formPoint')) !!}
                @csrf
                <input type="hidden" name="person_id" value="{{$person->id}}">
                <div class="field_wrapper" style="margin-top: 20px">
                    <h4 style="display: inline;">@lang('index.Create point')</h4>
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
                    <h4 style="display: inline;">@lang('index.Create point')</h4>
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
<script src="{{ asset('js/back/updateJquery.js') }}"></script>
<script>
    //add point
    $(document).ready(function () {
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
