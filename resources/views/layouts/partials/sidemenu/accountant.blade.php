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
          <li class="menu-item {{ request()->routeIs('staff.index', 'staff.show','staff.edit') ? 'active' : '' }}">
              <a href="{{ route('staff.index') }}" class="menu-link">
              <div data-i18n="Staff">Staff</div>
              </a>
          </li>
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
          {{-- <li class="menu-item {{ request()->routeIs('user.index') ? 'active' : '' }}">
              <a href="{{ route('user.index') }}" class="menu-link">
              <div data-i18n="Users">Users</div>
              </a>
          </li> --}}

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

      {{-- <li class="menu-item">
          <a href="pages-account-settings-connections.html" class="menu-link">
          <div data-i18n="Connections">Salary</div>
          </a>
      </li> --}}
      </ul>
  </li>


  <li class="menu-item {{ request()->routeIs('notice.index', 'sms.index') ? 'active open': '' }} : '' }}">
    <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bxs-chat"></i>
        <div data-i18n="Communication">Communication</div>
    </a>
    <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('sms.index') ? 'active' : '' }}">
        <a href="{{ route('sms.index') }}" class="menu-link">
            <div data-i18n="Graduates">Messaging</div>
        </a>
        </li>
    </ul>

    <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('notice.index') ? 'active' : '' }}">
        <a href="{{ route('notice.index') }}" class="menu-link">
            <div data-i18n="Withdrawn">Notices</div>
        </a>
        </li>
    </ul>

</li>



  <li class="menu-item {{ request()->routeIs('archive.withrawn', 'archive.graduates') ? 'active open': '' }} : '' }}">
    <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bxs-archive"></i>
        <div data-i18n="Archives">Archives</div>
    </a>
    <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('archive.graduates') ? 'active' : '' }}">
        <a href="{{ route('archive.graduates') }}" class="menu-link">
            <div data-i18n="Graduates">Graduates</div>
        </a>
        </li>
    </ul>

    <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('archive.withrawn') ? 'active' : '' }}">
        <a href="{{ route('archive.withrawn') }}" class="menu-link">
            <div data-i18n="Withdrawn">Withdrawn</div>
        </a>
        </li>
    </ul>

</li>

<li class="menu-item {{ request()->routeIs('report.index','generate.financial.statement','generate.student.attendance', 'generate.staff.attendance', 'generate.report.card') ? 'active': '' }}">
    <a href="{{ route('report.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-report"></i>
        <div data-i18n="Attendance">Reports</div>
    </a>
</li>

</ul>
