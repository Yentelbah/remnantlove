
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

  <li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg {{ request()->routeIs('finance.index', 'finance.entry') ? 'active' : '' }}" href="{{ route('finance.index') }}" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:file-text-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Financial Records</span>
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
    <a class="sidebar-link primary-hover-bg" href="{{ route('report.index') }}" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:chart-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Reports</span>
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

</ul>
