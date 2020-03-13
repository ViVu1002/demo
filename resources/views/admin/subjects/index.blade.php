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
                        <a style="font-size: 20px; margin-left: 20px;" href="{{route('subject.create')}}">Create</a>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" style="margin-top: 8px">
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
                    <h4 style="display: inline; margin-left: 10px">Subjects
                        <h5 style="display: inline">
                            from </h5> {{$subjects->firstItem()}}
                        <h5 style="display: inline"> to</h5> {{$subjects->lastItem()}} // {{$subjects->total()}}
                    </h4>
                </div>

                <table class="table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Description</th>
                        @if(auth()->user()->admin == 1)
                            <th>Action</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subjects as $key => $subject)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{$subject->name}}</td>
                            <td>{{$subject->description}}</td>
                            <td>
                                @if(auth()->user()->admin == 1)
                                    <form action="{{ route('subject.destroy',$subject->id) }}" method="POST">
                                        <a class="btn btn-info" href="{{ route('subject.edit',$subject->id) }}">Edit</a>
                                        {{csrf_field()}}
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $subjects->links() !!}
            </div>
        </div>
    </div><!--/.row-->
@endsection
