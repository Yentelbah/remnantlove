<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">

  <script src="../assets/js/jquery.min.js"></script>

  <!-- Favicon icon-->
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/libs/quill/dist/quill.snow.css" />

  @yield('head')

  <!-- Core Css -->
  <link rel="stylesheet" href="../assets/css/styles.css" />
  <link rel="stylesheet" href="../assets/css/flow.css" />

  @yield('title')


</head>

<body>
    @include('layouts.flow.toast')

  <!-- Preloader -->
  <div class="preloader">
    <img src="../assets/images/logos/favicon.png" alt="loader" class="lds-ripple img-fluid" />
  </div>

  <div id="main-wrapper">
    <!-- Sidebar Start -->
        @include('layouts.flow.side')
    <!--  Sidebar End -->
    <div class="page-wrapper">

      <aside class="left-sidebar with-horizontal">
        <!-- Sidebar scroll-->
        <div>
          <!-- Sidebar navigation-->
          <nav id="sidebarnavh" class="sidebar-nav scroll-sidebar container-fluid">
            @include('layouts.flow.sidemenu')
          </nav>
        </div>
      </aside>

      <div class="body-wrapper">
        <div class="container-fluid">
          <!--  Header Start -->
          <header class="topbar sticky-top">
            <div class="with-vertical"><!-- ---------------------------------- -->
              <!-- Start Vertical Layout Header -->
              <!-- ---------------------------------- -->
                @include('layouts.flow.nav')
              <!-- ---------------------------------- -->
              <!-- End Vertical Layout Header -->
              <!-- ---------------------------------- -->

              <!-- ------------------------------- -->
              <!-- apps Dropdown in Small screen -->
              <!-- ------------------------------- -->
              <!--  Mobilenavbar -->
                @include('layouts.flow.mobilenav')
            </div>
          </header>
          <!--  Header End -->

          @yield('content')

        </div>
      </div>

      <script>
        function handleColorTheme(e) {
          document.documentElement.setAttribute("data-color-theme", e);
        }
      </script>
    {{-- <button class="p-3 btn btn-primary rounded-circle d-flex align-items-center justify-content-center customizer-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
        <i class="icon ti ti-settings fs-7"></i>
    </button> --}}

      <div class="offcanvas customizer offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="p-3 d-flex align-items-center justify-content-between border-bottom">
          <h4 class="offcanvas-title fw-semibold" id="offcanvasExampleLabel">
            Settings
          </h4>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body h-n80" data-simplebar>
          <h6 class="mb-2 fw-semibold fs-4">Theme</h6>

          <div class="flex-row gap-3 d-flex customizer-box" role="group">
            <input type="radio" class="btn-check light-layout" name="theme-layout" id="light-layout" autocomplete="off" />
            <label class="btn p-9 btn-outline-primary" for="light-layout">
              <i class="icon ti ti-brightness-up fs-7 me-2"></i>Light
            </label>

            <input type="radio" class="btn-check dark-layout" name="theme-layout" id="dark-layout" autocomplete="off" />
            <label class="btn p-9 btn-outline-primary" for="dark-layout">
              <i class="icon ti ti-moon fs-7 me-2"></i>Dark
            </label>
          </div>

          <h6 class="mt-5 mb-2 fw-semibold fs-4">Theme Direction</h6>
          <div class="flex-row gap-3 d-flex customizer-box" role="group">
            <input type="radio" class="btn-check" name="direction-l" id="ltr-layout" autocomplete="off" />
            <label class="btn p-9 btn-outline-primary" for="ltr-layout">
              <i class="icon ti ti-text-direction-ltr fs-7 me-2"></i>LTR
            </label>

            <input type="radio" class="btn-check" name="direction-l" id="rtl-layout" autocomplete="off" />
            <label class="btn p-9 btn-outline-primary" for="rtl-layout">
              <i class="icon ti ti-text-direction-rtl fs-7 me-2"></i>RTL
            </label>
          </div>

          <h6 class="mt-5 mb-2 fw-semibold fs-4">Theme Colors</h6>

          <div class="flex-row flex-wrap gap-3 d-flex customizer-box color-pallete" role="group">
            <input type="radio" class="btn-check" name="color-theme-layout" id="Blue_Theme" autocomplete="off" />
            <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center" onclick="handleColorTheme('Blue_Theme')" for="Blue_Theme" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="BLUE_THEME">
              <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-1">
                <i class="text-white ti ti-check d-flex icon fs-5"></i>
              </div>
            </label>

            <input type="radio" class="btn-check" name="color-theme-layout" id="Aqua_Theme" autocomplete="off" />
            <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center" onclick="handleColorTheme('Aqua_Theme')" for="Aqua_Theme" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="AQUA_THEME">
              <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-2">
                <i class="text-white ti ti-check d-flex icon fs-5"></i>
              </div>
            </label>

            <input type="radio" class="btn-check" name="color-theme-layout" id="Purple_Theme" autocomplete="off" />
            <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center" onclick="handleColorTheme('Purple_Theme')" for="Purple_Theme" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="PURPLE_THEME">
              <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-3">
                <i class="text-white ti ti-check d-flex icon fs-5"></i>
              </div>
            </label>

            <input type="radio" class="btn-check" name="color-theme-layout" id="green-theme-layout" autocomplete="off" />
            <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center" onclick="handleColorTheme('Green_Theme')" for="green-theme-layout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="GREEN_THEME">
              <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-4">
                <i class="text-white ti ti-check d-flex icon fs-5"></i>
              </div>
            </label>

            <input type="radio" class="btn-check" name="color-theme-layout" id="cyan-theme-layout" autocomplete="off" />
            <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center" onclick="handleColorTheme('Cyan_Theme')" for="cyan-theme-layout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="CYAN_THEME">
              <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-5">
                <i class="text-white ti ti-check d-flex icon fs-5"></i>
              </div>
            </label>

            <input type="radio" class="btn-check" name="color-theme-layout" id="orange-theme-layout" autocomplete="off" />
            <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center" onclick="handleColorTheme('Orange_Theme')" for="orange-theme-layout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="ORANGE_THEME">
              <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-6">
                <i class="text-white ti ti-check d-flex icon fs-5"></i>
              </div>
            </label>
          </div>

          <h6 class="mt-5 mb-2 fw-semibold fs-4">Layout Type</h6>
          <div class="flex-row gap-3 d-flex customizer-box" role="group">
            <div>
              <input type="radio" class="btn-check" name="page-layout" id="vertical-layout" autocomplete="off" />
              <label class="btn p-9 btn-outline-primary" for="vertical-layout">
                <i class="icon ti ti-layout-sidebar-right fs-7 me-2"></i>Vertical
              </label>
            </div>
            <div>
              <input type="radio" class="btn-check" name="page-layout" id="horizontal-layout" autocomplete="off" />
              <label class="btn p-9 btn-outline-primary" for="horizontal-layout">
                <i class="icon ti ti-layout-navbar fs-7 me-2"></i>Horizontal
              </label>
            </div>
          </div>

          <h6 class="mt-5 mb-2 fw-semibold fs-4">Container Option</h6>

          <div class="flex-row gap-3 d-flex customizer-box" role="group">
            <input type="radio" class="btn-check" name="layout" id="boxed-layout" autocomplete="off" />
            <label class="btn p-9 btn-outline-primary" for="boxed-layout">
              <i class="icon ti ti-layout-distribute-vertical fs-7 me-2"></i>Boxed
            </label>

            <input type="radio" class="btn-check" name="layout" id="full-layout" autocomplete="off" />
            <label class="btn p-9 btn-outline-primary" for="full-layout">
              <i class="icon ti ti-layout-distribute-horizontal fs-7 me-2"></i>Full
            </label>
          </div>

          <h6 class="mt-5 mb-2 fw-semibold fs-4">Sidebar Type</h6>
          <div class="flex-row gap-3 d-flex customizer-box" role="group">
            <a href="javascript:void(0)" class="fullsidebar">
              <input type="radio" class="btn-check" name="sidebar-type" id="full-sidebar" autocomplete="off" />
              <label class="btn p-9 btn-outline-primary" for="full-sidebar">
                <i class="icon ti ti-layout-sidebar-right fs-7 me-2"></i>Full
              </label>
            </a>
            <div>
              <input type="radio" class="btn-check " name="sidebar-type" id="mini-sidebar" autocomplete="off" />
              <label class="btn p-9 btn-outline-primary" for="mini-sidebar">
                <i class="icon ti ti-layout-sidebar fs-7 me-2"></i>Collapse
              </label>
            </div>
          </div>

          <h6 class="mt-5 mb-2 fw-semibold fs-4">Card With</h6>

          <div class="flex-row gap-3 d-flex customizer-box" role="group">
            <input type="radio" class="btn-check" name="card-layout" id="card-with-border" autocomplete="off" />
            <label class="btn p-9 btn-outline-primary" for="card-with-border">
              <i class="icon ti ti-border-outer fs-7 me-2"></i>Border
            </label>

            <input type="radio" class="btn-check" name="card-layout" id="card-without-border" autocomplete="off" />
            <label class="btn p-9 btn-outline-primary" for="card-without-border">
              <i class="icon ti ti-border-none fs-7 me-2"></i>Shadow
            </label>
          </div>
        </div>
      </div>
    </div>
    <div class="dark-transparent sidebartoggler"></div>

  </div>

  <!-- Import Js Files -->
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.min.js"></script>
  <script src="../assets/js/theme/app.init.js"></script>
  <script src="../assets/js/theme/theme.js"></script>
  <script src="../assets/js/theme/app.min.js"></script>
  <script src="../assets/js/theme/sidebarmenu.js"></script>
  <script src="../assets/js/theme/feather.min.js"></script>

  <script src="../assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>


  <script src="{{ asset('ijaboCropTool/ijaboCropTool.min.js') }}"></script>

  <!-- solar icons -->
  <script src="../assets/js/iconify-icon.min.js"></script>

  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/js/dashboards/dashboard2.js"></script>

  <script>
    // Check if there is a success message in the session
    @if(session('success'))
        // Function to display a success toast message
        function showSuccessToast(message) {
            const toastContainer = document.getElementById('toast-top-right');
            const toast = document.createElement('div');
            toast.classList.add('flow-toastr','toast', 'text-bg-primary', 'align-items-center', );
            toast.setAttribute('role', 'alert');
            toast.setAttribute('aria-live', 'assertive');
            toast.setAttribute('aria-atomic', 'true');
            toast.innerHTML = `

                <div class="gap-6 hstack align-items-start justify-content-between">
                    <i class="mt-1 fas fa-check fs-7"></i>
                    <div>
                        <h5 class="mb-1 text-white fs-4">Success</h5>
                        <h6 class="mb-0 text-white fs-2">${message}</h6>
                    </div>
                    <button type="button" class="m-0 shadow-none btn-close btn-close-white fs-2 ms-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            `;
            toastContainer.appendChild(toast);


            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();

            // Remove the toast element after it's hidden
            bsToast.on('hidden.bs.toast', function () {
                toast.remove();
            });
        }

        // Show the success toast message
        showSuccessToast("{{ session('success') }}");

    @elseif(session('error'))
      <!-- Function to display an error toast message -->
      function showErrorToast(message) {
        const toastContainer = document.getElementById('toast-top-right');
            const toast = document.createElement('div');
            toast.classList.add('flow-toastr', 'toast', 'text-bg-danger', 'align-items-center');
            toast.setAttribute('role', 'alert');
            toast.setAttribute('aria-live', 'assertive');
            toast.setAttribute('aria-atomic', 'true');
            toast.innerHTML = `

            <div class="gap-6 hstack align-items-start">
                    <i class="ti ti-alert-circle fs-7"></i>
                    <div>
                        <h5 class="mb-1 text-white fs-3">Error</h5>
                        <h6 class="mb-0 text-white fs-2">${message}</h6>
                    </div>
                    <button type="button" class="m-0 shadow-none btn-close btn-close-white fs-2 ms-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            `;
            toastContainer.appendChild(toast);
          const bsToast = new bootstrap.Toast(toast);
          bsToast.show();

          // Remove the toast element after it's hidden
          bsToast.on('hidden.bs.toast', function () {
              toast.remove();
          });
      }

      <!-- Show the error toast message -->
      showErrorToast("{{ session('error') }}");

    @elseif(session('info'))
      <!-- Function to display an error toast message -->
      function showErrorToast(message) {
        const toastContainer = document.getElementById('toast-top-right');
            const toast = document.createElement('div');
            toast.classList.add('flow-toastr', 'toast', 'text-bg-info', 'align-items-center');
            toast.setAttribute('role', 'alert');
            toast.setAttribute('aria-live', 'assertive');
            toast.setAttribute('aria-atomic', 'true');
            toast.innerHTML = `

                <div class="gap-6 hstack align-items-start">
                    <i class="ti ti-info-circle fs-6"></i>
                    <div>
                        <h5 class="mb-1 text-white fs-3">Info</h5>
                        <h6 class="mb-0 text-white fs-2">${message}</h6>
                    </div>
                    <button type="button" class="m-0 shadow-none btn-close btn-close-white fs-2 ms-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            `;
            toastContainer.appendChild(toast);

          const bsToast = new bootstrap.Toast(toast);
          bsToast.show();

          // Remove the toast element after it's hidden
          bsToast.on('hidden.bs.toast', function () {
              toast.remove();
          });
      }

      <!-- Show the error toast message -->
      showErrorToast("{{ session('info') }}");

    @elseif(session('warning'))
      <!-- Function to display an error toast message -->
      function showErrorToast(message) {
        const toastContainer = document.getElementById('toast-top-right');
            const toast = document.createElement('div');
            toast.classList.add('flow-toastr','toast', 'text-bg-warning', 'align-items-center');
            toast.setAttribute('role', 'alert');
            toast.setAttribute('aria-live', 'assertive');
            toast.setAttribute('aria-atomic', 'true');
            toast.innerHTML = `

                <div class="gap-6 hstack align-items-start">
                    <i class="ti ti-warning-circle fs-6"></i>
                    <div>
                        <h5 class="mb-1 text-white fs-3">Warning</h5>
                        <h6 class="mb-0 text-white fs-2">${message}</h6>
                    </div>
                    <button type="button" class="m-0 shadow-none btn-close btn-close-white fs-2 ms-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            `;
            toastContainer.appendChild(toast);

          const bsToast = new bootstrap.Toast(toast);
          bsToast.show();

          // Remove the toast element after it's hidden
          bsToast.on('hidden.bs.toast', function () {
              toast.remove();
          });
      }

      <!-- Show the error toast message -->
      showErrorToast("{{ session('warning') }}");

    @endif
  </script>

  @yield('scripts')

</body>

</html>
