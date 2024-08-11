<div class="offcanvas offcanvas-start dropdown-menu-nav-offcanvas" data-bs-scroll="true" tabindex="-1" id="mobilenavbar" aria-labelledby="offcanvasWithBothOptionsLabel">
    <nav class="sidebar-nav scroll-sidebar">
      <div class="offcanvas-header justify-content-between">
        <img src="../assets/images/logos/favicon.png" alt="spike-img" class="img-fluid" />
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body h-n80" data-simplebar>
        <ul id="sidebarnav">
          <li class="sidebar-item">
            <a class="gap-2 sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
              <iconify-icon icon="solar:list-bold-duotone" class="fs-7"></iconify-icon>
              <span class="hide-menu">Apps</span>
            </a>
            <ul aria-expanded="false" class="my-3 collapse first-level">
              <li class="py-2 sidebar-item">
                <a href="javascript:void(0)" class="d-flex align-items-center">
                    <div class="p-6 bg-light-subtle rounded-1 me-3 d-flex align-items-center justify-content-center">
                        <img src="../assets/images/svgs/icon-dd-chat.svg" alt="spike-img" class="img-fluid" width="24" height="24">
                      </div>
                      <div>
                        <h6 class="mb-1 bg-hover-primary">Messaging</h6>
                        <span class="fs-2 d-block text-dark">Send messages </span>
                      </div>
                </a>
              </li>
              <li class="py-2 sidebar-item">
                <a href="javascript:void(0)" class="d-flex align-items-center">
                    <div class="p-6 bg-light-subtle rounded-1 me-3 d-flex align-items-center justify-content-center">
                        <img src="../assets/images/svgs/icon-dd-invoice.svg" alt="spike-img" class="img-fluid" width="24" height="24">
                      </div>
                      <div>
                        <h6 class="mb-1 bg-hover-primary">Finance</h6>
                        <span class="fs-2 d-block text-dark">Record finances</span>
                      </div>
                </a>
              </li>
              <li class="py-2 sidebar-item">
                <a href="{{ route('event.index') }}" class="d-flex align-items-center">
                    <div class="p-6 bg-light-subtle rounded-1 me-3 d-flex align-items-center justify-content-center">
                        <img src="../assets/images/svgs/icon-dd-mobile.svg" alt="spike-img" class="img-fluid" width="24" height="24">
                      </div>
                      <div>
                        <h6 class="mb-1 bg-hover-primary">Events</h6>
                        <span class="fs-2 d-block text-dark">Keep all events</span>
                      </div>

                </a>
              </li>
              {{-- <li class="py-2 sidebar-item">
                <a href="javascript:void(0)" class="d-flex align-items-center">
                  <div class="p-6 text-bg-light rounded-1 me-3 d-flex align-items-center justify-content-center">
                    <img src="../assets/images/svgs/icon-dd-message-box.svg" alt="spike-img" class="img-fluid" width="24" height="24" />
                  </div>
                  <div>
                    <h6 class="mb-1 bg-hover-primary">Email App</h6>
                    <span class="fs-2 d-block fw-normal text-muted">Get new emails</span>
                  </div>
                </a>
              </li> --}}
              {{-- <li class="py-2 sidebar-item">
                <a href="javascript:void(0)" class="d-flex align-items-center">
                  <div class="p-6 text-bg-light rounded-1 me-3 d-flex align-items-center justify-content-center">
                    <img src="../assets/images/svgs/icon-dd-cart.svg" alt="spike-img" class="img-fluid" width="24" height="24" />
                  </div>
                  <div>
                    <h6 class="mb-1 bg-hover-primary">User Profile</h6>
                    <span class="fs-2 d-block fw-normal text-muted">learn more information</span>
                  </div>
                </a>
              </li> --}}
              <li class="py-2 sidebar-item">
                <a href="{{ route('calendar.index') }}" class="d-flex align-items-center">
                    <div class="p-6 bg-light-subtle rounded-1 me-3 d-flex align-items-center justify-content-center">
                        <img src="../assets/images/svgs/icon-dd-date.svg" alt="spike-img" class="img-fluid" width="24" height="24">
                      </div>
                      <div>
                        <h6 class="mb-1 bg-hover-primary">Calendar</h6>
                        <span class="fs-2 d-block text-dark">Get dates</span>
                      </div>

                </a>
              </li>
              <li class="py-2 sidebar-item">
                <a href="{{ route('member.index') }}" class="d-flex align-items-center">
                    <div class="p-6 bg-light-subtle rounded-1 me-3 d-flex align-items-center justify-content-center">
                        <img src="../assets/images/svgs/icon-dd-lifebuoy.svg" alt="spike-img" class="img-fluid" width="24" height="24">
                      </div>
                      <div>
                        <h6 class="mb-1 bg-hover-primary">Members</h6>
                        <span class="fs-2 d-block text-dark">Add new members</span>
                      </div>

                </a>
              </li>
              <li class="py-2 sidebar-item">
                <a href="{{ route('project.index') }}" class="d-flex align-items-center">
                    <div class="p-6 bg-light-subtle rounded-1 me-3 d-flex align-items-center justify-content-center">
                        <img src="../assets/images/svgs/icon-dd-application.svg" alt="spike-img" class="img-fluid" width="24" height="24">
                      </div>
                      <div>
                        <h6 class="mb-1 bg-hover-primary">Projects</h6>
                        <span class="fs-2 d-block text-dark">Major project tasks</span>
                      </div>
            </a>
              </li>
              <ul class="px-8 mt-6 mb-4">
                <li class="mb-3 sidebar-item">
                  <h5 class="fs-5 fw-semibold">Quick Links</h5>
                </li>
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
                    <a class="fw-semibold text-dark bg-hover-primary" href="../main/page-account-settings.html">Settings</a>
                  </li>
              </ul>
            </ul>
          </li>
          <li class="sidebar-item">
            <a class="gap-2 sidebar-link" href="{{ route('member.index') }}" aria-expanded="false">
              <iconify-icon icon="solar:user-circle-line-duotone" class="fs-6 text-dark"></iconify-icon>
              <span class="hide-menu">Members</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="gap-2 sidebar-link" href="{{ route('event.index') }}" aria-expanded="false">
              <iconify-icon icon="solar:notification-unread-lines-line-duotone" class="fs-6 text-dark"></iconify-icon>
              <span class="hide-menu">Events</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="gap-2 sidebar-link" href="{{ route('calendar.index') }}" aria-expanded="false">
              <iconify-icon icon="solar:calendar-add-line-duotone" class="fs-6 text-dark"></iconify-icon>
              <span class="hide-menu">Calendar</span>
            </a>
          </li>

        </ul>
      </div>
    </nav>
  </div>
