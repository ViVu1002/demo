@extends('layouts.admin.admin_design')
@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li><a href="{{ url('/dashboard')}}">Dashboard</a></li>
                <li class="active">Khoa</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="login-panel panel panel-default"
                     style="height: 50px; padding-top: 10px; margin-bottom: 50px">
                    <div style="display: inline;">
                        <a style="font-size: 20px; margin-left: 20px;" href="{{route('point.create')}}">Create</a>
                        <form action="" class="form-group" style="margin-top: -50px">
                            <div style="display: inline; float: right;">
                                <input type="text" name="name" placeholder="Search" style="width: 400px;height: 40px;"
                                       value="{{ \Request::get('name') }}">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" style="margin-top: 59px">
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
                <table class="table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Person</th>
                        <th>Point</th>
                        <th>Subject</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($points as $key => $point)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{$point->person->name}}</td>
                            <td>{{$point->point}}</td>
                            <td>{{$point->subject->name}}</td>
                            <td>
                                {!! Form::open(['route' => ['point.destroy',$point->id],'method' => 'POST']) !!}
                                    <a class="btn btn-info" href="{{ route('point.edit',$point->id) }}">Edit</a>
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    {!! Form::submit('Delete',['class' => 'btn btn-danger'])!!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--/.row-->
@endsection
