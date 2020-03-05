<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            @if(auth()->check())
                <div class="profile-usertitle-name">{{ auth()->user()->name }}</div>
            @endif
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>
    <ul class="nav menu">
        <li><a href="{{ route('home.index')}}"><i class="fas fa-home">&nbsp;</i>Home</a></li>
        <li><a href="{{ route('person.index') }}"><i class="fas fa-users"></i> Persons</a></li>
        <li><a href="{{ route('faculty.index') }}"><i class="fas fa-school"></i> Faculties</a></li>
        <li><a href="{{ route('subject.index') }}"><em class="fa fa-calendar">&nbsp;</em> Subjects</a></li>
        <li><a href="{{ route('point.index') }}"><i class="fas fa-pencil-alt"></i> Points</a></li>
        <li><a href="{{ route('user.index') }}"><i class="fas fa-user"></i> Students</a></li>
        <li><a href="{{ url('/logout')}}"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
    </ul>
</div><!--/.sidebar-->
