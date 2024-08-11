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


    <li class="menu-item {{ request()->routeIs('sms.credits.request', 'sms.credits.balances') ? 'active open' : '' }} : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bxs-group"></i>
            <div data-i18n="Peopl">SMS Credits</div>
        </a>

        <ul class="menu-sub">

            <li class="menu-item {{ request()->routeIs('sms.credits.balances') ? 'active' : '' }}">
                <a href="{{ route('sms.credits.balances') }}" class="menu-link">
                <div data-i18n="Balances">Accounts</div>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('sms.credits.request', 'staff.show','staff.edit') ? 'active' : '' }}">
                <a href="{{ route('sms.credits.request') }}" class="menu-link">
                <div data-i18n="Staff">Requests</div>
                </a>
            </li>
        </ul>
    </li>

    <li class="menu-item {{ request()->routeIs('log.index', 'school.logs') ? 'active' : '' }}">
        <a href="{{ route('log.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-user"></i>
          <div data-i18n="Logs">Logs</div>
        </a>
    </li>

    <li class="menu-item {{ request()->routeIs('payments.index') ? 'active' : '' }}">
        <a href="{{ route('payments.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bxs-credit-card-front"></i>
          <div data-i18n="Logs">Payments</div>
        </a>
    </li>

    <li class="menu-item {{ request()->routeIs('reciepts.index') ? 'active' : '' }}">
        <a href="{{ route('reciepts.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-file"></i>
          <div data-i18n="Reciept">Reciept</div>
        </a>
    </li>
</ul>
