
 <ul id="sidebarnav" class="mb-0">

  <!-- ============================= -->
  <!-- Home -->
  <!-- ============================= -->
  <li class="nav-small-cap">
    <iconify-icon icon="solar:menu-dots-bold-duotone" class="nav-small-cap-icon fs-5"></iconify-icon>
    <span class="hide-menu">Home</span>
  </li>
  <li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg" href="{{ route('dashboard') }}" id="get-url" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:screencast-2-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Dashboard</span>
    </a>
  </li>


  <!-- ============================= -->
  <!-- Apps -->
  <!-- ============================= -->
  <li class="nav-small-cap">
    <iconify-icon icon="solar:menu-dots-bold-duotone" class="nav-small-cap-icon fs-5"></iconify-icon>
    <span class="hide-menu">Main</span>
  </li>

  {{-- <li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg  {{ request()->routeIs('branch.index', 'branch.create') ? 'active' : '' }}" href="{{ route('branch.index') }}" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:book-2-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Branches</span>
    </a>
  </li> --}}


  <li class="sidebar-item">
    <a class="sidebar-link has-arrow primary-hover-bg   {{ request()->routeIs('pastor.index', 'leader.index', 'pastor.new', 'leader.new', 'staff.create', 'staff.index', 'pastor.edit', 'leader.edit') ? 'active' : '' }}" href="javascript:void(0)" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:user-circle-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Members</span>
    </a>
    <ul aria-expanded="false" class="collapse first-level">
      <li class="sidebar-item">
        <a href="{{ route('member.index') }}" class="sidebar-link">
          <span class="sidebar-icon"></span>
          <span class="hide-menu">All Members</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="{{ route('pastor.index') }}" class="sidebar-link   {{ request()->routeIs('pastor.index', 'pastor.new', 'pastor.edit') ? 'active' : '' }}">
          <span class="sidebar-icon"></span>
          <span class="hide-menu">Pastors</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="{{ route('leader.index') }}" class="sidebar-link  {{ request()->routeIs('leader.index', 'leader.new', 'leader.edit') ? 'active' : '' }}">
          <span class="sidebar-icon"></span>
          <span class="hide-menu">Leaders</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="{{ route('staff.index') }}" class="sidebar-link   {{ request()->routeIs('staff.index', 'staff.create') ? 'active' : '' }}">
          <span class="sidebar-icon"></span>
          <span class="hide-menu">Staff</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="sidebar-item">
    <a class="sidebar-link has-arrow primary-hover-bg   {{ request()->routeIs('evangelism.index','converts.create') ? 'active' : '' }}" href="javascript:void(0)" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:user-hands-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Evangelism</span>
    </a>
    <ul aria-expanded="false" class="collapse first-level">
      <li class="sidebar-item">
        <a href="{{ route('evangelism.index') }}" class="sidebar-link">
          <span class="sidebar-icon"></span>
          <span class="hide-menu">Evangelism Events</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="{{ route('converts.index') }}" class="sidebar-link   {{ request()->routeIs('converts.index','converts.create') ? 'active' : '' }}">
          <span class="sidebar-icon"></span>
          <span class="hide-menu">Converts</span>
        </a>
      </li>

    </ul>
  </li>


  <li class="sidebar-item">
    <a class="sidebar-link has-arrow primary-hover-bg   {{ request()->routeIs('foundation-school.index', 'foundation-modules.index') ? 'active' : '' }}" href="javascript:void(0)" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:square-academic-cap-2-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Foundation School</span>
    </a>
    <ul aria-expanded="false" class="collapse first-level">
      <li class="sidebar-item">
        <a href="{{ route('foundation-school.index') }}" class="sidebar-link {{ request()->routeIs('foundation-school   .index') ? 'active' : '' }}">
          <span class="sidebar-icon"></span>
          <span class="hide-menu">Students</span>
        </a>
      </li>
      {{-- <li class="sidebar-item">
        <a href="{{ route('foundation-modules.index') }}" class="sidebar-link   {{ request()->routeIs('foundation-modules.index') ? 'active' : '' }}">
          <span class="sidebar-icon"></span>
          <span class="hide-menu">Modules</span>
        </a>
      </li> --}}

    </ul>
  </li>


  <li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg {{ request()->routeIs('group.index', 'group.members.list') ? 'active' : '' }}" href="{{ route('group.index') }}" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:users-group-two-rounded-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Groups</span>
    </a>
  </li>

  <li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg {{ request()->routeIs('family.index', 'family.members.list', 'family.list') ? 'active' : '' }}" href="{{ route('family.index') }}" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:book-2-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Families</span>
    </a>
  </li>

  <li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg {{ request()->routeIs('attendance.index', 'attendance.create') ? 'active' : '' }}" href="{{ route('attendance.index') }}" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:file-check-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Attendance</span>
    </a>
  </li>


  <li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg {{ request()->routeIs('visitors.index', 'visitors.create') ? 'active' : '' }}" href="{{ route('visitors.index') }}" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:user-hand-up-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Visitors</span>
    </a>
  </li>

  <li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg" href="{{ route('sms.index') }}" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:mailbox-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Messaging</span>
    </a>
  </li>
  <li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg" href="{{ route('calendar.index') }}" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:calendar-add-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Calendar</span>
    </a>
  </li>

  <li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg" href="{{ route('event.index') }}" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:notification-unread-lines-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Events</span>
    </a>
  </li>

  <li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg" href="{{ route('project.index') }}" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:document-text-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Projects</span>
    </a>
  </li>

  <li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg" href="{{ route('facility.index') }}" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:password-minimalistic-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Facility</span>
    </a>
  </li>

  <li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg" href="{{ route('equipment.index') }}" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:list-check-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Equipment</span>
    </a>
  </li>



  <li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg {{ request()->routeIs('finance.index', 'finance.entry') ? 'active' : '' }}" href="{{ route('finance.index') }}" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:file-text-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Financial Records</span>
    </a>
  </li>

  <!-- =================== -->
  <!-- Students -->
  <!-- =================== -->
  {{-- <li class="sidebar-item">
    <a class="sidebar-link has-arrow primary-hover-bg" href="javascript:void(0)" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:square-academic-cap-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Bible School</span>
    </a>
    <ul aria-expanded="false" class="collapse first-level">
      <li class="sidebar-item">
        <a href="../main/all-student.html" class="sidebar-link">
          <span class="sidebar-icon"></span>
          <span class="hide-menu">All Students</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="../main/student-details.html" class="sidebar-link">
          <span class="sidebar-icon"></span>
          <span class="hide-menu"> Students Details</span>
        </a>
      </li>
    </ul>
  </li> --}}

  <!-- =================== -->
  <!-- Cards -->
  <!-- =================== -->
        {{-- <li class="sidebar-item">
            <a class="sidebar-link has-arrow primary-hover-bg" href="javascript:void(0)" aria-expanded="false">
            <span class="p-2 aside-icon bg-primary-subtle rounded-1">
                <iconify-icon icon="solar:document-text-line-duotone" class="fs-6"></iconify-icon>
            </span>
            <span class="hide-menu ps-1">Projects</span>
            </a>
            <ul aria-expanded="false" class="collapse first-level">

            <li class="sidebar-item">
                <a href="../main/ui-card-draggable.html" class="sidebar-link">
                <span class="sidebar-icon"></span>
                <span class="hide-menu">Draggable Cards</span>
                </a>
            </li>
            </ul>
        </li> --}}


  <!-- ============================= -->
  <!-- Forms -->


  <!-- ============================= -->
  <!-- OTHER -->
  <!-- ============================= -->
  {{-- <li class="nav-small-cap">
    <iconify-icon icon="solar:menu-dots-bold-duotone" class="nav-small-cap-icon fs-5"></iconify-icon>
    <span class="hide-menu">Other</span>
  </li> --}}

  <li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg" href="{{ route('report.index') }}" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:chart-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Reports</span>
    </a>
  </li>

  {{-- <li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg" href="{{ route('document.index') }}" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:file-text-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Documents</span>
    </a>
  </li> --}}

  {{-- <li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg" href="{{ route('archive.index') }}" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:archive-broken" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Archieves</span>
    </a>
  </li> --}}

    <!-- ============================= -->
  <!-- Auth -->
  <!-- ============================= -->
  <li class="nav-small-cap">
    <iconify-icon icon="solar:menu-dots-bold-duotone" class="nav-small-cap-icon fs-5"></iconify-icon>
    <span class="hide-menu">Auth</span>
  </li>

  <li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg" href="{{ route('user.index') }}" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:user-plus-broken" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Users</span>
    </a>
  </li>

  <li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg" href="{{ route('preference.index') }}" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:settings-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Preferences</span>
    </a>
  </li>


  {{--
  <li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg justify-content-between" href="javascript:void(0)" aria-expanded="false">
      <div class="d-flex align-items-center">
        <span class="p-2 aside-icon bg-primary-subtle rounded-1">
          <iconify-icon icon="solar:shield-check-line-duotone" class="fs-6"></iconify-icon>
        </span>
        <span class="hide-menu ps-1">Subscription</span>
      </div>
      <div class="hide-menu">
      </div>
    </a>
  </li> --}}



</ul>
