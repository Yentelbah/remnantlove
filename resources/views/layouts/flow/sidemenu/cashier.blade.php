
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

  {{-- <li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg" href="{{ route('member.index') }}" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:user-circle-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Members</span>
    </a>
  </li> --}}

  <li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg {{ request()->routeIs('tasks.index', 'task.category.index', 'task.view') ? 'active' : '' }}" href="{{ route('tasks.index') }}" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:document-add-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Tasks</span>
    </a>
  </li>


  <li class="sidebar-item">
    <a class="sidebar-link has-arrow primary-hover-bg   {{ request()->routeIs('calendar.index', 'event.index') ? 'active' : '' }}" href="javascript:void(0)" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:calendar-add-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Events</span>
    </a>
    <ul aria-expanded="false" class="collapse first-level">
      <li class="sidebar-item">
        <a href="{{ route('event.index') }}" class="sidebar-link {{ request()->routeIs('event.index') ? 'active' : '' }}">
          <span class="sidebar-icon"></span>
          <span class="hide-menu">List</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="{{ route('calendar.index') }}" class="sidebar-link   {{ request()->routeIs('calendar.index') ? 'active' : '' }}">
          <span class="sidebar-icon"></span>
          <span class="hide-menu">Calendar</span>
        </a>
      </li>

    </ul>
  </li>

  <li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg" href="{{ route('project.index') }}" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:document-text-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Projects</span>
    </a>
  </li>


  {{-- <li class="sidebar-item">
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
  </li> --}}

</ul>
