@extends('layouts.admin.admin_design')
@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Dashboard</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">Change the password</div>

                    @if(Session::has('flash_message_error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{!! session('flash_message_error') !!}</strong>
                        </div>
                    @endif
                    @if(Session::has('flash_message_success'))

                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{!! session('flash_message_success') !!}</strong>
                        </div>
                    @endif
                    <div class="panel-body" style="margin:0 500px 0 500px">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                        <form role="form" method="post" action="{{url('admin/update-pwd')}}" id="password_validate">
                            {{ csrf_field() }}
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Current password" name="current_pwd"
                                           type="password" value="" id="currentpassword">
                                    <span id="chkPwd"></span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" id="
								" name="new_pwd" type="password" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Repassword" id="comfirm_pwd" name="re_pwd"
                                           type="password" autofocus="">
                                </div>
                                <input type="submit" class="btn btn-success" value="Submit">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>    <!--/.main-->
@endsection
