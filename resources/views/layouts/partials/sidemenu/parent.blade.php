<div class="app-brand demo">
    <a href="#" class="app-brand-link" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBoth" aria-controls="offcanvasBoth">

      <span class="app-brand-logo demo">
        <img src="{{ asset('backend/assets/img/logo.png') }}"
        width="25"
        viewBox="0 0 25 42">
    </span> &nbsp;
    <span style="text-decoration: none; font-size: 20px;" class="app-brand-text fw-bolder">SchoolDB</span>
  </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="align-middle bx bx-chevron-left bx-sm"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="py-1 menu-inner">
    <!-- Dashboard -->

    <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
      <a href="{{ route('dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-dashboard"></i>
        <div data-i18n="Analytics">Dashboard</div>
      </a>
    </li>


  <li class="menu-item {{ request()->routeIs('staff.index', 'student.edit', 'staff.show','staff.edit','student.index','student.show', 'student.edit', 'guardian.index', 'guardian.show', 'user.index') ? 'active open' : '' }} : '' }}">
      <a href="{{ route('student.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bxs-group"></i>
          <div data-i18n="Peopl">Wards</div>
      </a>
  </li>


  <li class="menu-item {{ request()->routeIs('parent.report.index') ? 'active' : '' }} ">
      <a href="{{ route('parent.report.index') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bxs-credit-card-front"></i>
      <div data-i18n="Accounts">Reports</div>
      </a>

  </li>


  </ul>
