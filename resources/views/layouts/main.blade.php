<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="Yensoft" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link href="{{ asset('assets/img/logo/logo.png') }}" rel="icon" type="image/x-icon">
  @yield('title')

  @yield('head')
  <link href="{{ asset('assets/vendor/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets/css/ruang-admin.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.css') }}" rel="stylesheet">
  <script src="{{ asset('assets/vendor/fullcalendar/dist/index.global.min.js') }}"></script>

</head>

<body id="page-top">
  <div id="wrapper">

    <!-- Sidebar -->
        @include('layouts.partials.sidemenu')
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">

        <!-- TopBar -->
        @include('layouts.partials.nav')
        @include('layouts.partials.toast')

        <!-- Topbar -->
        <!-- Container Fluid-->

        @yield('content')

        <!---Container Fluid-->
        </div>
      <!-- Footer -->
      @include('layouts.partials.footer')
      <!-- Footer -->
  </div>
  </div>
  <!-- Scroll to top -->
  <a class="rounded scroll-to-top" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('assets/js/ruang-admin.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script>
  {{-- <script>
    // Check if there is a success message in the session
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


  </script> --}}


  <script>
    var toastElList = [].slice.call(document.querySelectorAll('.toast'))
    var toastList = toastElList.map(function (toastEl) {
        return new bootstrap.Toast(toastEl)
    });
    toastList.forEach(toast => toast.show());
</script>

  @yield('scripts')
</body>

</html>
