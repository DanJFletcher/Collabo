<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
<!--         <img src="{{ access()->user()->picture }}" class="img-circle" alt="User Image" />-->
                 <img src="{{ access()->user()->avatar}}" >
            </div><!--pull-left-->
            <div class="pull-left info">
                <p>{{ access()->user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('strings.backend.general.status.online') }}</a>
            </div><!--pull-left-->
        </div><!--user-panel-->

        <!-- search form (Optional) -->
        {{ Form::open(['route' => 'admin.search.index', 'method' => 'get', 'class' => 'sidebar-form']) }}
        <div class="input-group">
            {{ Form::text('q', Request::get('q'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => trans('strings.backend.general.search_placeholder')]) }}

            <span class="input-group-btn">
                    <button type='submit' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span><!--input-group-btn-->
        </div><!--input-group-->
    {{ Form::close() }}
    <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('menus.backend.sidebar.general') }}</li>

            <li class="{{ active_class(Active::checkUriPattern('admin/dashboard')) }}"> {{-- Set Active--}}
                <a href="{{ route('admin.dashboard') }}"> {{-- Route --}}
                    <i class="fa fa-dashboard"></i> {{-- Icon --}}
                    <span>{{ trans('menus.backend.sidebar.dashboard') }}</span> {{-- Name of link--}}
                </a>
            </li>
            
            <li class="{{ active_class(Active::checkUriPattern('admin/donations*')) }}"> {{-- Set Active--}}
                <a href="{{ route('admin.donations') }}"> {{-- Route --}}
                    <i class="fa fa-money"></i> {{-- Icon --}}
                    <span>Donations</span> {{-- Name of link--}}
                </a>
            </li>

            <li class="{{ active_class(Active::checkUriPattern('admin/teams*')) }}"> {{-- Set Active--}}
                <a href="{{route('teams.index')}}"> {{-- Route --}}
                    <i class="fa fa-users"></i> {{-- Icon --}}
                    <span>Teams</span> {{-- Name of link--}}
                </a>
            </li>
            
            <li class="{{ active_class(Active::checkUriPattern('admin/messaging*')) }}"> {{-- Set Active--}}
                <a href="{{route('messenger.index')}}"> {{-- Route --}}
                    <i class="fa fa-comments"></i> {{-- Icon --}}
                    <span>Messaging</span> {{-- Name of link--}}
                </a>
            </li>
            
            <li class="{{ active_class(Active::checkUriPattern('admin/members*')) }}"> {{-- Set Active--}}
                <a href="{{ route('admin.members.index') }}"> {{-- Route --}}
                    <i class="fa fa-user-circle-o"></i> {{-- Icon --}}
                    <span>Members</span> {{-- Name of link--}}
                </a>
            </li>




            @role(1)
            <li class="header">Admin</li>

            
            <li class="{{ active_class(Active::checkUriPattern('admin/access/*')) }} treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>{{ trans('menus.backend.access.title') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/access/*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/access/*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/access/user*')) }}">
                        <a href="{{ route('admin.access.user.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('labels.backend.access.users.management') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/access/role*')) }}">
                        <a href="{{ route('admin.access.role.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('labels.backend.access.roles.management') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            
             <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer*')) }} treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span>{{ trans('menus.backend.log-viewer.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer')) }}">
                        <a href="{{ route('log-viewer::dashboard') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.log-viewer.dashboard') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer/logs')) }}">
                        <a href="{{ route('log-viewer::logs.list') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.log-viewer.logs') }}</span>
                        </a>
                    </li>
                </ul>
            </li>



          <!--  Custom  -->

            <li class="{{ active_class(Active::checkUriPattern('admin/news*')) }}  treeview">
                <a href="#">
                    <i class="fa fa-newspaper-o"></i>
                    <span>News</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/news*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/news*'), 'display: block;') }}">
                    
                    <li class="{{ active_class(Active::checkUriPattern('admin/news')) }}">
                        <a href="{{route('admin.news.index')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>View</span>
                        </a>
                    </li>
                    <li class="{{ active_class(Active::checkUriPattern('admin/news/create')) }}">
                        <a href="{{ route('admin.news.create') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>Create</span>
                        </a>
                    </li>

                    
                </ul>
            </li>
            
       

            <li class="{{ active_class(Active::checkUriPattern('admin/events*')) }} treeview">
                <a href="#">
                    <i class="fa fa-calendar"></i>
                    <span>Events</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu treeview-menu {{ active_class(Active::checkUriPattern('admin/events*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/events*'), 'display: block;') }}">
                    
                    <li class="{{ active_class(Active::checkUriPattern('admin/events')) }}">
                        <a href="{{route('admin.events.index')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>View</span>
                        </a>
                    </li>
                    
                    
                    <li class="{{ active_class(Active::checkUriPattern('admin/events/create')) }}">
                        <a href="{{route('admin.events.create')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>Create</span>
                        </a>
                    </li>

                    
                </ul>
            </li>


             <li class="{{ active_class(Active::checkUriPattern('admin/reports*')) }} treeview">
                <a href="#">
                    <i class="fa fa-line-chart" aria-hidden="true"></i>
                    <span>Reports</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu treeview-menu {{ active_class(Active::checkUriPattern('admin/reports*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/reports*'), 'display: block;') }}">

                    <li class="{{ active_class(Active::checkUriPattern('admin/reports')) }}">
                        <a href="{{route('admin.reports.index')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>All Reports</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/reports/user')) }}">
                        <a href="{{route('admin.reports.user')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>User Reports</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/reports/donations')) }}">
                        <a href="{{route('admin.reports.donation')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>Donation Reports</span>
                        </a>
                    </li>
                    <li class="{{ active_class(Active::checkUriPattern('admin/reports/team')) }}">
                        <a href="{{route('admin.reports.team')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>Team Reports</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/reports/event')) }}">
                        <a href="{{route('admin.reports.event')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>Event Reports</span>
                        </a>
                    </li>




                </ul>
            </li>

            @endauth

           
        </ul><!-- /.sidebar-menu -->
    </section><!-- /.sidebar -->
</aside>
