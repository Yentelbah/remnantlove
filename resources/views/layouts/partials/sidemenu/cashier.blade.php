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


{{-- <a href="{{ route('profile.show') }}">Profile try</a> --}}
  <!-- People -->

  <li class="menu-item {{ request()->routeIs('staff.index', 'student.edit', 'staff.show','staff.edit','student.index','student.show', 'student.edit', 'guardian.index', 'guardian.show', 'user.index') ? 'active open' : '' }} : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bxs-group"></i>
          <div data-i18n="Peopl">People</div>
      </a>

      <ul class="menu-sub">

          <li class="menu-item {{ request()->routeIs('student.index', 'student.show', 'student.edit') ? 'active' : '' }}">
              <a href="{{ route('student.index') }}" class="menu-link">
              <div data-i18n="Students">Students</div>
              </a>
          </li>
          <li class="menu-item {{ request()->routeIs('guardian.index', 'guardian.show') ? 'active' : '' }}">
              <a href="{{ route('guardian.index') }}" class="menu-link">
              <div data-i18n="Parents">Parents</div>
              </a>
          </li>

      </ul>
  </li>


  <li class="menu-item {{ request()->routeIs('billing.index', 'billing.create', 'payments.index','expense.index', 'classDebtorList.generate', 'pay_receiptSearch', 'revenue.index','payments.show') ? 'active open' : '' }} : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bxs-credit-card-front"></i>
      <div data-i18n="Accounts">Accounts</div>
      </a>
      <ul class="menu-sub">
      <li class="menu-item {{ request()->routeIs( 'billing.index','billing.create', 'classDebtorList.generate' ) ? 'active' : '' }}">
          <a href="{{ route('billing.index') }}" class="menu-link">
          <div data-i18n="Account">Bills</div>
          </a>
      </li>

      <li class="menu-item {{ request()->routeIs( 'payments.index', 'pay_receiptSearch','payments.show') ? 'active' : '' }}">
          <a href="{{ route('payments.index') }}" class="menu-link">
          <div data-i18n="Paymnets">Payments</div>
          </a>
      </li>

      <li class="menu-item {{ request()->routeIs( 'revenue.index') ? 'active' : '' }}">
          <a href="{{ route('revenue.index') }}" class="menu-link">
          <div data-i18n="Connections">Add Revenue</div>
          </a>
      </li>

      <li class="menu-item {{ request()->routeIs( 'expense.index' ) ? 'active' : '' }}">
          <a href="{{ route('expense.index') }}" class="menu-link">
          <div data-i18n="Expenses">Expenses</div>
          </a>
      </li>

      </ul>
  </li>

  </ul>
