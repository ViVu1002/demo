<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            @if(auth()->check())
                <div class="profile-usertitle-name">{{ auth()->user()->name }}</div>
            @endif
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>@lang('index.Online')</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>
    <ul class="nav menu">
        <li><a href="{{ route('faculty.index') }}"><i class="fas fa-school"></i> @lang('index.Faculties')</a></li>
        <li><a href="{{ route('subject.index') }}"><em class="fa fa-calendar">&nbsp;</em> @lang('index.Subjects')</a></li>
        <li><a href="{{ url('en/person') }}"><i class="fas fa-users"></i> @lang('index.Students')</a></li>
    @if(auth()->user()->admin == 1)
            <li><a href="{{ route('user.index') }}"><i class="fas fa-user"></i> @lang('index.Users')</a></li>
        @endif
        <li><a href="{{ url('/logout')}}"><em class="fa fa-power-off">&nbsp;</em> @lang('index.Logout')</a></li>
    </ul>
</div><!--/.sidebar-->
