<nav class="p-0 navbar navbar-expand-lg">
    <ul class="navbar-nav">
      <li class="nav-item nav-icon-hover-bg rounded-circle">
        <a class="nav-link sidebartoggler" id="headerCollapse" href="javascript:void(0)">
          <iconify-icon icon="solar:list-bold-duotone" class="fs-7"></iconify-icon>
        </a>
      </li>
    </ul>

    <ul class="navbar-nav quick-links d-none d-lg-flex align-items-center">
      <!-- ------------------------------- -->
      <!-- start apps Dropdown -->
      <!-- ------------------------------- -->
      <li class="nav-item dropdown hover-dd d-none d-lg-block me-2">
        <a class="nav-link" href="javascript:void(0)">
          Apps<span class="mt-1">
            <i class="ti ti-chevron-down fs-3"></i>
          </span>
        </a>
        <div class="py-0 dropdown-menu dropdown-menu-nav dropdown-menu-animate-up">
          <div class="row">
            <div class="col-8">
              <div class=" ps-7 pt-7">
                <div class="border-bottom">
                  <div class="row">
                    <div class="col-6">
                      <div class="position-relative">
                        <a href="../main/app-chat.html" class="d-flex align-items-center pb-9 position-relative">
                          <div class="p-6 bg-light-subtle rounded-1 me-3 d-flex align-items-center justify-content-center">
                            <img src="../assets/images/svgs/icon-dd-chat.svg" alt="spike-img" class="img-fluid" width="24" height="24">
                          </div>
                          <div>
                            <h6 class="mb-1 bg-hover-primary">Messaging</h6>
                            <span class="fs-2 d-block text-dark">Send messages </span>
                          </div>
                        </a>
                        <a href="../main/app-invoice.html" class="d-flex align-items-center pb-9 position-relative">
                          <div class="p-6 bg-light-subtle rounded-1 me-3 d-flex align-items-center justify-content-center">
                            <img src="../assets/images/svgs/icon-dd-invoice.svg" alt="spike-img" class="img-fluid" width="24" height="24">
                          </div>
                          <div>
                            <h6 class="mb-1 bg-hover-primary">Finance</h6>
                            <span class="fs-2 d-block text-dark">Record finances</span>
                          </div>
                        </a>
                        <a href="{{ route('event.index') }}" class="d-flex align-items-center pb-9 position-relative">
                          <div class="p-6 bg-light-subtle rounded-1 me-3 d-flex align-items-center justify-content-center">
                            <img src="../assets/images/svgs/icon-dd-mobile.svg" alt="spike-img" class="img-fluid" width="24" height="24">
                          </div>
                          <div>
                            <h6 class="mb-1 bg-hover-primary">Events</h6>
                            <span class="fs-2 d-block text-dark">Keep all events</span>
                          </div>
                        </a>
                        {{-- <a href="../main/app-email.html" class="d-flex align-items-center pb-9 position-relative">
                          <div class="p-6 bg-light-subtle rounded-1 me-3 d-flex align-items-center justify-content-center">
                            <img src="../assets/images/svgs/icon-dd-message-box.svg" alt="spike-img" class="img-fluid" width="24" height="24">
                          </div>
                          <div>
                            <h6 class="mb-1 bg-hover-primary">Email App</h6>
                            <span class="fs-2 d-block text-dark">Get new emails</span>
                          </div>
                        </a> --}}
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="position-relative">
                        {{-- <a href="../main/page-user-profile.html" class="d-flex align-items-center pb-9 position-relative">
                          <div class="p-6 bg-light-subtle rounded-1 me-3 d-flex align-items-center justify-content-center">
                            <img src="../assets/images/svgs/icon-dd-cart.svg" alt="spike-img" class="img-fluid" width="24" height="24">
                          </div>
                          <div>
                            <h6 class="mb-1 bg-hover-primary">User Profile</h6>
                            <span class="fs-2 d-block text-dark">learn more information</span>
                          </div>
                        </a> --}}
                        <a href="{{ route('calendar.index') }}" class="d-flex align-items-center pb-9 position-relative">
                          <div class="p-6 bg-light-subtle rounded-1 me-3 d-flex align-items-center justify-content-center">
                            <img src="../assets/images/svgs/icon-dd-date.svg" alt="spike-img" class="img-fluid" width="24" height="24">
                          </div>
                          <div>
                            <h6 class="mb-1 bg-hover-primary">Calendar</h6>
                            <span class="fs-2 d-block text-dark">Get dates</span>
                          </div>
                        </a>
                        <a href="{{ route('member.index') }}" class="d-flex align-items-center pb-9 position-relative">
                          <div class="p-6 bg-light-subtle rounded-1 me-3 d-flex align-items-center justify-content-center">
                            <img src="../assets/images/svgs/icon-dd-lifebuoy.svg" alt="spike-img" class="img-fluid" width="24" height="24">
                          </div>
                          <div>
                            <h6 class="mb-1 bg-hover-primary">Members</h6>
                            <span class="fs-2 d-block text-dark">Add new members</span>
                          </div>
                        </a>
                        <a href="{{ route('project.index') }}" class="d-flex align-items-center pb-9 position-relative">
                          <div class="p-6 bg-light-subtle rounded-1 me-3 d-flex align-items-center justify-content-center">
                            <img src="../assets/images/svgs/icon-dd-application.svg" alt="spike-img" class="img-fluid" width="24" height="24">
                          </div>
                          <div>
                            <h6 class="mb-1 bg-hover-primary">Projects</h6>
                            <span class="fs-2 d-block text-dark">Major project tasks</span>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- <div class="py-3 row align-items-center">
                  <div class="col-8">
                    <a class="fw-semibold text-dark d-flex align-items-center lh-1 bg-hover-primary" href="javascript:void(0)"><iconify-icon icon="solar:question-circle-line-duotone" class="fs-6 me-2"></iconify-icon>Frequently Asked Questions</a>
                  </div>
                  <div class="col-4">
                    <div class="d-flex justify-content-end pe-4">
                      <button class="btn btn-primary">Check</button>
                    </div>
                  </div>
                </div> --}}
              </div>
            </div>
            <div class="col-4 ms-n4">
              <div class="p-6 position-relative border-start h-100">
                <h5 class="fs-5 mb-9 fw-semibold">Quick Links</h5>
                <ul class="">

                  <li class="mb-3">
                    <a class="fw-semibold text-dark bg-hover-primary" href="{{ route('pastor.new') }}">Add Pastor</a>
                  </li>
                  <li class="mb-3">
                    <a class="fw-semibold text-dark bg-hover-primary" href="{{ route('equipment.index') }}">Equipment</a>
                  </li>
                  <li class="mb-3">
                    <a class="fw-semibold text-dark bg-hover-primary" href="#">User Profile</a>
                  </li>
                  <li class="mb-3">
                    <a class="fw-semibold text-dark bg-hover-primary" href="{{ route('preference.index') }}">Preferences</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- ------------------------------- -->
      <!-- end apps Dropdown -->
      <!-- ------------------------------- -->
      <li class="nav-item dropdown-hover d-none d-lg-block me-2">
        <a class="nav-link" href="{{ route('member.index') }}">Members</a>
      </li>
      <li class="nav-item dropdown-hover d-none d-lg-block me-2">
        <a class="nav-link" href="{{ route('event.index') }}">Events</a>
      </li>
      <li class="nav-item dropdown-hover d-none d-lg-block">
        <a class="nav-link" href="{{ route('calendar.index') }}">Calendar</a>
      </li>
    </ul>

    <div class="py-3 d-block d-lg-none">
      <img src="../assets/images/logos/logo-light.svg" class="dark-logo" alt="Logo-Dark" />
      <img src="../assets/images/logos/logo-dark.svg" class="light-logo" alt="Logo-light" />
    </div>


    <a class="p-0 border-0 navbar-toggler" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="p-2">
        <i class="ti ti-dots fs-7"></i>
      </span>
    </a>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <div class="d-flex align-items-center justify-content-between">
        <a href="javascript:void(0)" class="nav-link d-flex d-lg-none align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar" aria-controls="offcanvasWithBothOptions">
          <div class="nav-icon-hover-bg rounded-circle ">
            <i class="ti ti-align-justified fs-7"></i>
          </div>
        </a>
        <ul class="flex-row navbar-nav ms-auto align-items-center justify-content-center">

            {{-- MODEs DARK AND LIGHT --}}
          <li class="nav-item nav-icon-hover-bg rounded-circle">
            <a class="nav-link moon dark-layout" href="javascript:void(0)">
              <iconify-icon icon="solar:moon-line-duotone" class="moon fs-6"></iconify-icon>
            </a>
            <a class="nav-link sun light-layout" href="javascript:void(0)">
              <iconify-icon icon="solar:sun-2-line-duotone" class="sun fs-6"></iconify-icon>
            </a>
          </li>

          <!-- ------------------------------- -->
          <!-- start Notifications cart Dropdown -->
          <!-- ------------------------------- -->
          {{-- <li class="nav-item dropdown nav-icon-hover-bg rounded-circle">
            <a class="nav-link position-relative" href="javascript:void(0)" id="drop3" aria-expanded="false">
              <iconify-icon icon="solar:chat-dots-line-duotone" class="fs-6"></iconify-icon>
              <div class="pulse">
                <span class="heartbit border-warning"></span>
                <span class="point text-bg-warning"></span>
              </div>
            </a>
            <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop3">
              <!--  Messages -->
              <div class="py-3 d-flex align-items-center px-7">
                <h3 class="mb-0 fs-5">Notifications</h3>
                <span class="badge bg-info ms-3">5 new</span>
              </div>

              <div class="message-body" data-simplebar>
                <a href="javascript:void(0)" class="py-6 dropdown-item px-7 d-flex align-items-center">
                  <span class="flex-shrink-0">
                    <img src="../assets/images/profile/user-5.jpg" alt="user" width="45" class="rounded-circle" />
                  </span>
                  <div class="w-100 ps-3">
                    <div class="d-flex align-items-center justify-content-between">
                      <h5 class="mb-0 fs-3 fw-normal">
                        New message received
                      </h5>
                      <span class="fs-2 text-nowrap d-block text-muted">9:08 AM</span>
                    </div>
                    <span class="mt-1 fs-2 d-block text-muted">Salma sent you new
                      message</span>
                  </div>
                </a>

                <a href="javascript:void(0)" class="py-6 dropdown-item px-7 d-flex align-items-center">
                  <span class="flex-shrink-0">
                    <img src="../assets/images/profile/user-6.jpg" alt="user" width="45" class="rounded-circle" />
                  </span>
                  <div class="w-100 ps-3">
                    <div class="d-flex align-items-center justify-content-between">
                      <h5 class="mb-0 fs-3 fw-normal">
                        Roman Joined the Team!
                      </h5>
                      <span class="fs-2 text-nowrap d-block text-muted">9:08 AM</span>
                    </div>
                    <span class="mt-1 fs-2 d-block text-muted">Congratulate him</span>
                  </div>
                </a>
              </div>

              <div class="py-6 mb-1 px-7">
                <button class="btn btn-primary w-100">
                  See All Notifications
                </button>
              </div>
            </div>
          </li> --}}
          <!-- ------------------------------- -->
          <!-- end Notifications cart Dropdown -->
          <!-- ------------------------------- -->

          <!-- ------------------------------- -->
          <!-- start shortcut Dropdown -->
          <!-- ------------------------------- -->
          <li class="nav-item dropdown nav-icon-hover-bg rounded-circle">
            <a class="nav-link position-relative" href="javascript:void(0)" id="drop2" aria-expanded="false">
              <iconify-icon icon="solar:widget-add-line-duotone" class="fs-6"></iconify-icon>
            </a>
            <div class="pb-0 overflow-hidden dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
              <!--  Shortcuts -->
              <div class="gap-6 py-3 d-flex align-items-center px-7">
                <h3 class="mb-0 fs-5">Shortcuts</h3>
              </div>

              <div class="row gx-0">
                <div class="col-6">
                <a href="{{ route('member.index') }}" class="gap-2 py-6 text-center dropdown-item px-7 border-top border-bottom border-end d-flex flex-column justify-content-center">
                    <div class="m-auto bg-secondary-subtle rounded-3 round d-flex align-items-center justify-content-center">
                      <iconify-icon icon="solar:checklist-minimalistic-bold-duotone" class="fs-7 text-secondary"></iconify-icon>
                    </div>

                    <h6 class="mb-0 fs-4">Members</h6>
                    <span class="d-block text-body-color fs-3">View members</span>
                  </a>
                </div>
                <div class="col-6">
                  <a href="{{ route('sms.index') }}" class="gap-2 py-6 text-center dropdown-item px-7 border-top border-bottom d-flex flex-column justify-content-center">
                    <div class="m-auto bg-primary-subtle rounded-3 round d-flex align-items-center justify-content-center">
                      <iconify-icon icon="solar:chat-square-call-bold-duotone" class="fs-7 text-primary"></iconify-icon>
                    </div>
                    <h6 class="mb-0 fs-4">Messaging</h6>
                    <span class="d-block text-body-color fs-3">Send messages</span>
                  </a>
                </div>

                <div class="col-6">
                  <a href="{{ route('profile.show') }}" class="gap-2 py-6 text-center dropdown-item px-7 border-end d-flex flex-column justify-content-center">
                    <div class="m-auto bg-warning-subtle rounded-3 round d-flex align-items-center justify-content-center">
                      <iconify-icon icon="solar:shield-user-bold-duotone" class="fs-7 text-warning"></iconify-icon>
                    </div>
                    <h6 class="mb-0 fs-4">Profile</h6>
                    <span class="d-block text-body-color fs-3">More information</span>
                  </a>
                </div>
                <div class="col-6">
                  <a href="{{ route('calendar.index') }}" class="gap-2 py-6 text-center dropdown-item px-7 d-flex flex-column justify-content-center">
                    <div class="m-auto bg-info-subtle rounded-3 round d-flex align-items-center justify-content-center">
                      <iconify-icon icon="solar:calendar-mark-bold-duotone" class="fs-7 text-warning"></iconify-icon>
                    </div>
                    <h6 class="mb-0 fs-4">Calendar</h6>
                    <span class="d-block text-body-color fs-3">Get dates</span>
                  </a>
                </div>
              </div>
            </div>
          </li>
          <!-- ------------------------------- -->
          <!-- end shortcut Dropdown -->
          <!-- ------------------------------- -->

          <!-- ------------------------------- -->
          <!-- start profile Dropdown -->
          <!-- ------------------------------- -->
          <li class="nav-item dropdown">
            <a class="nav-link position-relative ms-6" href="javascript:void(0)" id="drop1" aria-expanded="false">
              <div class="flex-shrink-0 d-flex align-items-center">
                <div class="user-profile me-sm-3 me-2">
                  <img src="../assets/images/profile/user-1.jpg" width="40" class="rounded-circle" alt="spike-img">
                </div>
                <span class="d-sm-none d-block"><iconify-icon icon="solar:alt-arrow-down-line-duotone"></iconify-icon></span>

                <div class="d-none d-sm-block">
                  <h6 class="mb-1 fs-4 profile-name">
                    {{ Auth()->user()->name }}
                  </h6>
                  {{-- <p class="mb-0 fs-3 lh-base profile-subtext">
                    Admin
                  </p> --}}
                </div>
              </div>
            </a>
            <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
              <div class="profile-dropdown position-relative" data-simplebar>
                <div class="pt-3 d-flex align-items-center justify-content-between px-7">
                  <h3 class="mb-0 fs-5">User Profile</h3>

                </div>

                <div class="d-flex align-items-center mx-7 py-9 border-bottom">
                  <img src="../assets/images/profile/user-1.jpg" alt="user" width="90" class="rounded-circle" />
                  <div class="ms-4">
                    <h4 class="mb-0 fs-5 fw-normal">{{ Auth()->user()->name }}</h4>
                    <span class="text-muted">{{ Auth()->user()->churchRole->name ?? '' }}</span>
                    <p class="mt-1 mb-0 text-muted d-flex align-items-center">
                      <iconify-icon icon="solar:mailbox-line-duotone" class="fs-4 me-1"></iconify-icon>
                      {{ Auth()->user()->email }}
                    </p>
                  </div>
                </div>

                <div class="message-body">
                  <a href="{{ route('profile.show') }}" class="py-6 dropdown-item px-7 d-flex align-items-center">
                    <span class="px-3 py-2 shadow-none btn bg-warning-subtle rounded-1 text-warning">
                      <iconify-icon icon="solar:shield-user-bold-duotone" class="fs-7"></iconify-icon>
                    </span>
                    <div class="w-100 ps-3 ms-1">
                      <h5 class="mt-1 mb-0 fs-4 fw-normal">
                        My Profile
                      </h5>
                      <span class="mt-1 fs-3 d-block text-muted">Account Settings</span>
                    </div>
                  </a>
                </div>

                <div class="py-6 mb-1 px-7">
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <button type="submit" class="btn btn-primary w-100">Log Out</button>
                    </form>
                </div>
              </div>
            </div>
          </li>
          <!-- ------------------------------- -->
          <!-- end profile Dropdown -->
          <!-- ------------------------------- -->
        </ul>
      </div>
    </div>
  </nav>
