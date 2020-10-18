<div class="main-header">
    <div class="logo">
        <img src="{{asset('images/logo.png')}}" alt="">
    </div>
    <div class="menu-toggle">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class="d-flex align-items-center">
        <!-- Mega menu -->
        <div class="dropdown mega-menu d-none d-md-block">
            <a href="#" class="btn text-muted dropdown-toggle mr-3" id="dropdownMegaMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu</a>
            <div class="dropdown-menu text-left" aria-labelledby="dropdownMenuButton">
                <div class="row m-0">
                    <div class="col-md-4 p-4 bg-img">
                        <h2 class="title">Hype IMS<br> </h2>
                        <p>Access all your internal management system functions from here
                        </p>
                        <p class="mb-4">Click on any icon on the left for quick create</p>
                    </div>
                    <div class="col-md-4 p-4">
                        <p class="text-primary text--cap border-bottom-primary d-inline-block">Quick Create</p>
                        <div class="menu-icon-grid w-auto p-0">
                            <a href="{{route('appointments.create')}}"><i class="fa fa-calendar"></i> Event</a>
                            <a href="{{route('invoices.create')}}"><i class="fa fa-money"></i> Income</a>
                            <a href=""><i class="fa fa-users"></i> User</a>
                            <a href="{{route('topics.create')}}"><i class="fa fa-comment"></i> Chat</a>
                            <a href="{{route('projects.create')}}"><i class="fa fa-hands-helping"></i> Volunteer</a>
                            <a href="{{url('help')}}"><i class="fa fa-support"></i> Support</a>
                        </div>
                    </div>
                    <div class="col-md-4 p-4">
                        <p class="text-primary text--cap border-bottom-primary d-inline-block">Features</p>
                        <ul class="links">
                            <li><a href="{{route('appointments.index')}}">Calendar</a></li>
                            <li><a href="{{route('accounts.index')}}">Finance Accounts</a></li>
                            <li><a href="{{route('invoices.index')}}">Invoices</a></li>
                            <li><a href="{{route('expenses.index')}}">Expenses</a></li>
                            <li><a href="{{route('topics.index')}}">Communications</a></li>
                            <li><a href="{{route('projects.index')}}">Calendar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Mega menu -->
        <div class="search-bar">
            <input type="text" placeholder="Search">
            <i class="search-icon text-muted i-Magnifi-Glass1"></i>
        </div>
    </div>
    <div style="margin: auto"></div>
    <div class="header-part-right">
        <!-- Full screen toggle -->
        <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen></i>
        
        <!-- Notificaiton -->
        <div class="dropdown">
            <div class="badge-top-container" role="button" id="dropdownNotification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="badge badge-primary">{{Auth::user()->unreadNotifications->count()}}</span>
                <i class="i-Bell text-muted header-icon"></i>
            </div>
            <!-- Notification dropdown -->
            <div class="dropdown-menu dropdown-menu-right notification-dropdown rtl-ps-none" aria-labelledby="dropdownNotification" data-perfect-scrollbar data-suppress-scroll-x="true">
                @forelse(Auth::user()->unreadNotifications as $notification)
                    <div class="dropdown-item d-flex">
                        <div class="notification-icon">
                            <i class="i-Speach-Bubble-6 text-primary mr-1"></i>
                        </div>
                        <div class="notification-details flex-grow-1">
                            <p class="m-0 d-flex align-items-center">
                                <span>{{$notification->type}}</span>
                                <span class="badge badge-pill badge-primary ml-1 mr-1">new</span>
                                <span class="flex-grow-1"></span>
                                <span class="text-small text-muted ml-auto">{{$notification->created_at->shortAbsoluteDiffForHumans(_)}}</span>
                            </p>
                            <p class="text-small text-muted m-0"></p>
                        </div>
                    </div>
                @empty
                @endforelse
                
            </div>
        </div>
        <!-- Notificaiton End -->
        <!-- User avatar dropdown -->
        <div class="dropdown">
            <div class="user col align-self-end">
                <img src="{{asset(Auth::user()->getProfilePhotoUrlAttribute())}}" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <div class="dropdown-header">
                        <i class="i-Lock-User mr-1"></i> {{Auth::user()->fname}} {{Auth::user()->lname}}
                    </div>
                    <a class="dropdown-item" href="{{url('user/profile')}}">User Profile</a>
                    <a class="dropdown-item"><small>Manage Team</small></a>
                    <a class="dropdown-item" href="{{url('teams', Auth::user()->currentTeam->id)}}">Team Settings</a>
                    <a class="dropdown-item" href="{{url('teams/create')}}">Create New Team</a>
                    <a class="dropdown-item"><small>Switch Teams</small></a>
                    @forelse(Auth::user()->allTeams() as $team)
                        @if(Auth::user()->currentTeam->id  == $team->id)
                            <a class="dropdown-item" href="{{url('teams/switch', $team->id)}}"><i class="text-success fa fa-check-circle"></i> {{$team->name}}</a>
                        @else
                            <a class="dropdown-item" href="{{url('teams/switch', $team->id)}}">{{$team->name}}</a>
                        @endif
                    @empty
                    @endforelse
                    <a class="dropdown-item" href="{{url('logout')}}">Sign out</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============ Body content start ============= -->