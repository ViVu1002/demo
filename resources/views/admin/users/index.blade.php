@extends('layouts.admin.admin_design')
@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li><a href="{{ url('/dashboard')}}">Dashboard</a></li>
                <li class="active">Users</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="login-panel panel panel-default"
                     style="height: 50px; padding-top: 10px; margin-bottom: 70px">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" style="margin-top: 50px">
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
                <div style="margin-bottom: 20px">
                    <h4 style="display: inline; margin-left: 10px">Users
                        <h5 style="display: inline">
                            from </h5> {{$users->firstItem()}}
                        <h5 style="display: inline"> to</h5> {{$users->lastItem()}} // {{$users->total()}}
                    </h4>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $user)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <form action="{{ route('user.destroy',$user->id) }}" method="POST">
                                    <a class="btn btn-info" href="{{ route('user.edit',$user->id) }}">Edit students</a>
                                    <a class="btn btn-primary" href="{{url('change-update-password',$user->id)}}">Edit
                                        password</a>
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--/.row-->
@endsection
