<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>FaithFlow -- No.1 Church Managment Application</title>
    <meta name="description" content="FaithFlow is a comprehensive church management solution designed to simplify operations. Easily manage membership, track finances, coordinate events, and enhance communication—all in one intuitive platform. Empower your ministry and streamline your church’s day-to-day tasks with FaithFlow." />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />

    <!-- Place favicon.ico in the root directory -->

    <!-- ======== CSS here ======== -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/lineicons.css" />
    <link rel="stylesheet" href="assets/css/animate.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
  </head>
  <body>

    <!-- ======== preloader start ======== -->
    <div class="preloader">
      <div class="loader">
        <div class="spinner">
          <div class="spinner-container">
            <div class="spinner-rotator">
              <div class="spinner-left">
                <div class="spinner-circle"></div>
              </div>
              <div class="spinner-right">
                <div class="spinner-circle"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- preloader end -->

    <!-- ======== header start ======== -->
    <header class="header">
      <div class="navbar-area">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-12">
              <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="/">
                  <img src="assets/img/logo/logo.svg" alt="Logo" />
                </a>
                <button
                  class="navbar-toggler"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#navbarSupportedContent"
                  aria-controls="navbarSupportedContent"
                  aria-expanded="false"
                  aria-label="Toggle navigation"
                >
                  <span class="toggler-icon"></span>
                  <span class="toggler-icon"></span>
                  <span class="toggler-icon"></span>
                </button>

                <div
                  class="collapse navbar-collapse sub-menu-bar"
                  id="navbarSupportedContent"
                >
                  <ul id="nav" class="navbar-nav ms-auto">
                    <li class="nav-item">
                      <a class="page-scroll active" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="page-scroll" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                      <a class="page-scroll" href="#about">Why</a>
                    </li>

                    @auth
                    <li class="nav-item">
                    <a href="{{ url('/dashboard') }}">My Dashboard</a>
                    </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}">Log In</a>
                        </li>

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a href="{{ route('register') }}">Register</a>
                        </li>
                    @endif
                    @endauth
                  </ul>
                </div>
                <!-- navbar collapse -->
              </nav>
              <!-- navbar -->
            </div>
          </div>
          <!-- row -->
        </div>
        <!-- container -->
      </div>
      <!-- navbar area -->
    </header>
    <!-- ======== header end ======== -->

    <!-- ======== hero-section start ======== -->
    <section id="home" class="hero-section">
      <div class="container">
        <div class="row align-items-center position-relative">
          <div class="col-lg-6">
            <div class="hero-content">
              <h1 class="wow fadeInUp" data-wow-delay=".4s">
               Connect. Manage. Grow.
              </h1>
              <p class="wow fadeInUp" data-wow-delay=".6s">
                Your All-in-One Solution for Effortless Church Management
              </p>
              <a
                href="{{ route('register') }}"
                class="main-btn border-btn btn-hover wow fadeInUp"
                data-wow-delay=".6s"
                >Sign Up Now</a
              >
              <a href="#features" class="scroll-bottom">
                <i class="lni lni-arrow-down"></i
              ></a>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="hero-img wow fadeInUp" data-wow-delay=".5s">
              <img src="assets/img/hero/hero-img.png" alt="" />
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ======== hero-section end ======== -->

    <!-- ======== feature-section start ======== -->
    <section id="features" class="feature-section pt-120">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-8 col-sm-10">
            <div class="single-feature">
              <div class="icon">
                <i class="lni lni-user"></i>
              </div>
              <div class="content">
                <h3>Membership Management</h3>
                <p>
                    Effortlessly manage and update member details, track attendance, and stay connected with your congregation.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-8 col-sm-10">
            <div class="single-feature">
              <div class="icon">
                <i class="lni lni-layout"></i>
              </div>
              <div class="content">
                <h3>Financial Tracking</h3>
                <p>
                    Simplify financial management with easy tracking of donations, expenses, and transparent reporting.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-8 col-sm-10">
            <div class="single-feature">
              <div class="icon">
                <i class="lni lni-phone"></i>
              </div>
              <div class="content">
                <h3>Communication Tools</h3>
                <p>
                    Send announcements and updates via email or SMS to keep your members informed and engaged.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ======== feature-section end ======== -->

    <!-- ======== about-section start ======== -->
    {{-- <section id="about" class="about-section pt-150">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-xl-6 col-lg-6">
            <div class="about-img">
              <img src="assets/img/about/about-1.png" alt="" class="w-100" />
              <img
                src="assets/img/about/about-left-shape.svg"
                alt=""
                class="shape shape-1"
              />
              <img
                src="assets/img/about/left-dots.svg"
                alt=""
                class="shape shape-2"
              />
            </div>
          </div>
          <div class="col-xl-6 col-lg-6">
            <div class="about-content">
              <div class="section-title mb-30">
                <h2 class="mb-25 wow fadeInUp" data-wow-delay=".2s">
                  Perfect Solution Thriving Online Business
                </h2>
                <p class="wow fadeInUp" data-wow-delay=".4s">
                  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                  dinonumy eirmod tempor invidunt ut labore et dolore magna
                  aliquyam erat, sed diam voluptua. At vero eos et accusam et
                  justo duo dolores et ea rebum. Stet clita kasd gubergren, no
                  sea takimata sanctus est Lorem.Lorem ipsum dolor sit amet.
                </p>
              </div>
              <a
                href="javascript:void(0)"
                class="main-btn btn-hover border-btn wow fadeInUp"
                data-wow-delay=".6s"
                >Discover More</a
              >
            </div>
          </div>
        </div>
      </div>
    </section> --}}
    <!-- ======== about-section end ======== -->

    <!-- ======== about2-section start ======== -->
    <section id="about" class="about-section pt-150">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-xl-6 col-lg-6">
            <div class="about-content">
              <div class="section-title mb-30">
                <h2 class="mb-25 wow fadeInUp" data-wow-delay=".2s">
                    Effortless Administration with All-in-One Solutions
                </h2>
                <p class="wow fadeInUp" data-wow-delay=".4s">
                    FaithFlow simplifies church management by centralizing operations into one easy-to-use platform, letting you focus more on ministry and less on admin tasks.
                </p>
              </div>
              <ul>
                <li>Quick Access</li>
                <li>Easily to Manage</li>
                <li>24/7 Support</li>
              </ul>
              <a
                href="{{ route('register') }}"
                class="main-btn btn-hover border-btn wow fadeInUp"
                data-wow-delay=".6s"
                >Sign Up Today</a
              >
            </div>
          </div>
          <div class="order-first col-xl-6 col-lg-6 order-lg-last">
            <div class="about-img-2">
              <img src="assets/img/about/about-2.png" alt="" class="w-100" />
              <img
                src="assets/img/about/about-right-shape.svg"
                alt=""
                class="shape shape-1"
              />
              <img
                src="assets/img/about/right-dots.svg"
                alt=""
                class="shape shape-2"
              />
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ======== about2-section end ======== -->

    <!-- ======== feature-section start ======== -->
    {{-- <section id="why" class="feature-extended-section pt-100">
      <div class="feature-extended-wrapper">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xxl-5 col-xl-6 col-lg-8 col-md-9">
              <div class="text-center section-title mb-60">
                <h2 class="mb-25 wow fadeInUp" data-wow-delay=".2s">
                  Why Choose SaaSpal
                </h2>
                <p class="wow fadeInUp" data-wow-delay=".4s">
                  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                  diam nonumy eirmod tempor invidunt ut labore et dolore
                </p>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-4 col-md-6">
              <div class="single-feature-extended">
                <div class="icon">
                  <i class="lni lni-display"></i>
                </div>
                <div class="content">
                  <h3>SaaS Focused</h3>
                  <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    diam nonumy eirmod tempor invidunt ut labore
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="single-feature-extended">
                <div class="icon">
                  <i class="lni lni-leaf"></i>
                </div>
                <div class="content">
                  <h3>Awesome Design</h3>
                  <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    diam nonumy eirmod tempor invidunt ut labore
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="single-feature-extended">
                <div class="icon">
                  <i class="lni lni-grid-alt"></i>
                </div>
                <div class="content">
                  <h3>Ready to Use</h3>
                  <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    diam nonumy eirmod tempor invidunt ut labore
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="single-feature-extended">
                <div class="icon">
                  <i class="lni lni-javascript"></i>
                </div>
                <div class="content">
                  <h3>Vanilla JS</h3>
                  <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    diam nonumy eirmod tempor invidunt ut labore
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="single-feature-extended">
                <div class="icon">
                  <i class="lni lni-layers"></i>
                </div>
                <div class="content">
                  <h3>Essential Sections</h3>
                  <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    diam nonumy eirmod tempor invidunt ut labore
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="single-feature-extended">
                <div class="icon">
                  <i class="lni lni-rocket"></i>
                </div>
                <div class="content">
                  <h3>Highly Optimized</h3>
                  <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    diam nonumy eirmod tempor invidunt ut labore
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> --}}
    <!-- ======== feature-section end ======== -->

    <!-- ======== subscribe-section start ======== -->
    <section id="contact" class="subscribe-section pt-120">
      <div class="container">
        <div class="subscribe-wrapper img-bg">
          <div class="row align-items-center">
            <div class="col-xl-6 col-lg-7">
              <div class="section-title mb-15">
                <h2 class="text-white mb-25">Subscribe Our Newsletter</h2>
                <p class="pr-5 text-white">
                    Join our community today and be the first to know about everything happening at FaithFlow.
                </p>
              </div>
            </div>
            <div class="col-xl-6 col-lg-5">
              <form action="#" class="subscribe-form">
                <input
                  type="email"
                  name="subs-email"
                  id="subs-email"
                  placeholder="Your Email"
                />
                <button type="submit" class="main-btn btn-hover">
                  Subscribe
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ======== subscribe-section end ======== -->

    <!-- ======== footer start ======== -->
    <footer class="footer">
      <div class="container">
        <div class="widget-wrapper">
          <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-6">
              <div class="footer-widget">
                <div class="logo mb-30">
                  <a href="index.html">
                    <img src="assets/img/logo/logo.svg" alt="" />
                  </a>
                </div>
                <p class="text-white desc mb-30">
                    FaithFlow is a product of Yensoft. Yensoft specializes in producing cutting edge solutions for your business.
                </p>
                <ul class="socials">
                  <li>
                    <a href="https://web.facebook.com/yensoftgh/">
                      <i class="lni lni-facebook-filled"></i>
                    </a>
                  </li>


                  <li>
                    <a href="https://www.linkedin.com/company/yensoft/">
                      <i class="lni lni-linkedin-original"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-6">
              <div class="footer-widget">
                <h3>About Us</h3>
                <ul class="links">
                  <li><a href="#home">Home</a></li>
                  <li><a href="#features">Features</a></li>
                  <li><a href="#why">Why</a></li>
                  <li><a href="https://yensoftgh.com" target="_blank">Yensoft</a></li>
                </ul>
              </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6">
              <div class="footer-widget">
                <h3>Features</h3>
                <ul class="links">
                  <li><a href="javascript:void(0)">How it works</a></li>
                  <li><a href="https://yensoftgh.com/privacy_policy" target="_blank">Privacy policy</a></li>
                  <li><a href="https://yensoftgh.com/terms_of_use" target="_blank">Terms of Use</a></li>
                  <li><a href="https://yensoftgh.com/refund_policy" target="_blank">Refund policy</a></li>
                </ul>
              </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6">
              <div class="footer-widget">
                <h3>Other Solutions</h3>
                <ul class="links">
                    <li><a href="https://school.yensoftgh.com" target="_blank">School Software</a></li>
                    <li><a href="https://suresell.yensoftgh.com" target="_blank">POS Software</a></li>
                    <li><a href="jvascript:void(0)">Voting System</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- ======== footer end ======== -->

    <!-- ======== scroll-top ======== -->
    <a href="#" class="scroll-top btn-hover">
      <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ======== JS here ======== -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/main.js"></script>
  </body>
</html>
