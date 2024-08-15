
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
    <a class="sidebar-link primary-hover-bg  {{ request()->routeIs('client.index') ? 'active' : '' }}" href="{{ route('client.index') }}" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:book-2-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">Organisations</span>
    </a>
  </li>

  <li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg  {{ request()->routeIs('client.index') ? 'active' : '' }}" href="{{ route('client.index') }}" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:book-2-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">SMS Credits</span>
    </a>
  </li>

  <li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg  {{ request()->routeIs('client.index') ? 'active' : '' }}" href="{{ route('client.index') }}" aria-expanded="false">
      <span class="p-2 aside-icon bg-primary-subtle rounded-1">
        <iconify-icon icon="solar:book-2-line-duotone" class="fs-6"></iconify-icon>
      </span>
      <span class="hide-menu ps-1">System Models</span>
    </a>
  </li>



</ul>
