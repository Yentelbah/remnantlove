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

  <li class="menu-item {{ request()->routeIs('list.students','student.show') ? 'active' : '' }}">
      <a href="{{ route('list.students') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bxs-group"></i>
          <div data-i18n="Peopl">Students</div>
      </a>

  </li>

  <li class="menu-item {{ request()->routeIs('teacher.exam.index', 'exam_score.manage', 'teacher.exam_scores.create', 'teacher.exercises.index', 'teacher.exercises.create', 'exercises.generate', 'teacher.comment.index', 'comment.manage', 'teacher.comment.create', 'exercises.extract') ? 'active open': '' }} : '' }}">
      <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bxs-book-bookmark"></i>
          <div data-i18n="Assessment">Assessment</div>
      </a>
      <ul class="menu-sub">
          <li class="menu-item {{ request()->routeIs('teacher.exam.index', 'exam_score.manage', 'teacher.exam_scores.create') ? 'active' : '' }}">
          <a href="{{ route('teacher.exam.index') }}" class="menu-link">
              <div data-i18n="Examination">Examination</div>
          </a>
          </li>
      </ul>

      <ul class="menu-sub">
          <li class="menu-item {{ request()->routeIs('teacher.exercises.index', 'teacher.exercises.create', 'exercises.generate', 'exercises.extract') ? 'active' : '' }}">
          <a href="{{ route('teacher.exercises.index') }}" class="menu-link">
              <div data-i18n="Exercise">Exercise</div>
          </a>
          </li>
      </ul>
      <ul class="menu-sub">
          <li class="menu-item {{ request()->routeIs('teacher.comment.index', 'teacher.comment.create', 'comment.manage') ? 'active' : '' }}">
          <a href="{{ route('teacher.comment.index') }}" class="menu-link">
              <div data-i18n="Report Comments">Comments</div>
          </a>
          </li>
      </ul>
  </li>

  <li class="menu-item {{ request()->routeIs('teacher.attendance.index','extract.attendance.daily', 'attend.get' ) ? 'active': '' }} : '' }}">
      <a href="{{ route('teacher.attendance.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bxs-copy-alt"></i>
          <div data-i18n="Attendance">Attendance</div>
      </a>
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


  </ul>
