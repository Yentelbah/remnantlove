<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard')}}">
<div class="sidebar-brand-icon">
    <img src="{{asset('assets/img/logo/logo2.png')}}">
</div>
<div class="mx-3 sidebar-brand-text">FaithFlow</div>
</a>

<hr class="my-0 sidebar-divider">

<li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
<a class="nav-link " href="{{ route('dashboard') }}" : active="request()->routeIs('dashboard')">
    <i class="fas fa-fw fa-solid fa-house"></i>
    <span>Dashboard</span></a>
</li>
<hr class="sidebar-divider">

<li class="nav-item {{ request()->routeIs('member.index') ? 'active' : '' }}">
    <a class="nav-link " href="{{ route('member.index') }}" : active="request()->routeIs('member.index')">
    <i class="fas fa-fw fa-solid fa-users"></i>
    <span>People</span></a>
</li>

<li class="nav-item  {{ request()->routeIs('group.index') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('group.index') }}" : active="request()->routeIs('group.index')">
        <i class="fas fa-fw fa-people-group"></i>
        <span>Groups</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAccounts"
    aria-expanded="true" aria-controls="collapseAccounts">
    <i class="far fa-fw fa-window-maximize"></i>
    <span>Accounts</span>
    </a>
    <div id="collapseAccounts" class="collapse" aria-labelledby="headingAccounts" data-parent="#accordionSidebar">
    <div class="py-2 bg-white rounded collapse-inner">
        <h6 class="collapse-header">Accounts</h6>
        <a class="collapse-item" href="alerts.html">Thites</a>
        <a class="collapse-item" href="alerts.html">Offering</a>
        <a class="collapse-item" href="buttons.html">Expenses</a>
    </div>
    </div>
</li>


<li class="nav-item {{ request()->routeIs('project.index') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('project.index') }}": active="request()->routeIs('project.index')">
    <i class="fas fa-fw fa-briefcase"></i>
    <span>Projects</span>
    </a>
</li>

<li class="nav-item {{ request()->routeIs('event.index', 'calendar.index') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('event.index') }}" : active="request()->routeIs('event.index','calendar.index')">
    <i class="fas fa-fw fa-calendar-day"></i>
    <span>Events</span>
    </a>
</li>

{{-- <li class="nav-item">
        <a class="nav-link" href="ui-colors.html">
            <i class="fas fa-fw fa-solid fa-calendar-day"></i>
            <span>Bookings</span>
        </a>
    </li>
 --}}
<li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
    <a class="nav-link" href="ui-colors.html": active="request()->routeIs('member.index')">
    <i class="fas fa-fw fa-bullhorn"></i>
    <span>Communication</span>
    </a>
</li>


<li class="nav-item {{ request()->routeIs('equipment.index') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('equipment.index') }}": active="request()->routeIs('equipment.index')">
    <i class="fas fa-fw fa-toolbox"></i>
    <span>Equipment</span>
    </a>
</li>

<li class="nav-item {{ request()->routeIs('facility.index') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('facility.index') }}": active="request()->routeIs('facility.index')">
    <i class="fas fa-fw fa-door-open"></i>
    <span>Facilities</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true"
        aria-controls="collapseForm">
        <i class="fas fa-fw fa-solid fa-file-lines"></i>
        <span>Reports</span>
    </a>
    <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="py-2 bg-white rounded collapse-inner">
        <h6 class="collapse-header">Reports</h6>
        <a class="collapse-item" href="form_basics.html">Form Basics</a>
        <a class="collapse-item" href="form_advanceds.html">Form Advanceds</a>
        </div>
    </div>
</li>


<li class="nav-item">
    <a class="nav-link" href="charts.html">
        <i class="fas fa-fw fa-gears"></i>
        <span>Settings</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="charts.html">
        <i class="fas fa-fw fa-headset"></i>
        <span>Help & Support</span>
    </a>
</li>

<hr class="sidebar-divider">
<div class="version" id="version-ruangadmin"></div>





{{-- MENU ITEM WITH SUB MENU --}}
{{-- <li class="nav-item {{ request()->routeIs('dashboard', '') ? 'active' : '' }}">
<a class="nav-link " href="#" data-toggle="collapse" data-target="#collapseBootstrap"
    aria-expanded="{{ request()->routeIs('dashboard') ? 'false' : '' }}" aria-controls="collapseBootstrap">
    <i class="fas fa-fw fa-solid fa-users"></i>
    <span>People</span>
</a>
    <div id="collapseBootstrap" class="collapse {{ request()->routeIs('dashboard', 'member.index') ? 'show' : '' }}" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
        <div class="py-2 bg-white rounded collapse-inner">
        <h6 class="collapse-header">People</h6>

        <a class="collapse-item {{ request()->routeIs('member.index') ? 'active' : '' }}" href="{{ route('member.index') }}">Members</a>

        <a class="collapse-item" href="buttons.html">Staff</a>

        </div>
    </div>
</li> --}}
