<aside class="left-sidebar with-vertical">
    <!-- ---------------------------------- -->
    <!-- Start Vertical Layout Sidebar -->
    <!-- ---------------------------------- -->
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="/" class="text-nowrap logo-img">
        <img src="../assets/images/logos/logo-light.svg" class="dark-logo" alt="Logo-Dark" />
        <img src="../assets/images/logos/logo-dark.svg" class="light-logo" alt="Logo-light" />
      </a>
      <a href="javascript:void(0)" class="sidebartoggler ms-auto text-decoration-none fs-5 d-block d-xl-none">
        <i class="ti ti-x"></i>
      </a>
    </div>

    <div class="scroll-sidebar" data-simplebar>
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav">

        @include('layouts.flow.sidemenu')

      </nav>
      <!-- End Sidebar navigation -->
    </div>

    <div class="mx-3 mt-3 fixed-profile">
      <div class="mb-0 shadow-none card bg-primary-subtle">
        <div class="p-4 card-body">
          <div class="gap-3 d-flex align-items-center justify-content-between">
            <div class="gap-3 d-flex align-items-center">
              <img src="{{ Auth()->user()->profile_photo_path == '' ?  '../assets/images/profile/user-1.jpg' : asset('storage/' .Auth()->user()->profile_photo_path) }}" alt="user"class="img-fluid rounded-circle preview" width="45">

              <div>
                <h5 class="mb-1">{{ Auth()->user()->name }}</h5>
                <p class="mb-0">{{ Auth()->user()->role }}</p>
              </div>
            </div>

            <form method="POST" action="{{ route('logout') }}" x-data id="logoutForm">
                @csrf
                <a href="#" class="position-relative" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Logout" onclick="document.getElementById('logoutForm').submit(); return false;">
                    <iconify-icon icon="solar:logout-line-duotone" class="fs-8"></iconify-icon>
                </a>
            </form>


          </div>
        </div>
      </div>
    </div>

    <!-- ---------------------------------- -->
    <!-- Start Vertical Layout Sidebar -->
    <!-- ---------------------------------- -->
  </aside>
