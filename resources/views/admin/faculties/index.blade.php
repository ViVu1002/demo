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
                        <a style="font-size: 20px; margin-left: 20px;" href="{{route('faculty.create')}}">Create</a>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" style="margin-top: 8px">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($faculties as $key => $faculty)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{$faculty->name}}</td>
                            <td>{{$faculty->description}}</td>
                            <td>
                                {!! Form::open(['route' => ['faculty.destroy',$faculty->id], 'method' => 'POST']) !!}
                                    <a class="btn btn-info" href="{{ route('faculty.edit',$faculty->id) }}">Edit</a>
                                    @csrf
                                @if(auth()->user()->admin == 1)
                                    <input name="_method" type="hidden" value="DELETE">
                                    {!! Form::submit('Delete',['class' => 'btn btn-danger']) !!}
                                @endif
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $faculties->links() !!}
            </div>
        </div>
    </div><!--/.row-->
@endsection
