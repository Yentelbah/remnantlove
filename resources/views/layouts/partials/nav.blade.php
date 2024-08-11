<nav class="mb-4 navbar navbar-expand navbar-light bg-navbar topbar static-top">
    <button id="sidebarToggleTop" class="mr-3 btn btn-link rounded-circle">
      <i class="fa fa-bars"></i>
    </button>

    <ul class="ml-auto navbar-nav">
        {{-- search --}}
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-search fa-fw"></i>
        </a>

        <div class="p-3 shadow dropdown-menu dropdown-menu-right animated--grow-in"
          aria-labelledby="searchDropdown">
          <form class="navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-1 small" placeholder="What do you want to look for?"
                aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      {{-- end search --}}

      {{-- <li class="mx-1 nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <span class="badge badge-danger badge-counter">3+</span>
        </a>
        <div class="shadow dropdown-list dropdown-menu dropdown-menu-right animated--grow-in"
          aria-labelledby="alertsDropdown">
          <h6 class="dropdown-header">
            Alerts Center
          </h6>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="mr-3">
              <div class="icon-circle bg-primary">
                <i class="text-white fas fa-file-alt"></i>
              </div>
            </div>
            <div>
              <div class="text-gray-500 small">December 12, 2019</div>
              <span class="font-weight-bold">A new monthly report is ready to download!</span>
            </div>
          </a>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="mr-3">
              <div class="icon-circle bg-success">
                <i class="text-white fas fa-donate"></i>
              </div>
            </div>
            <div>
              <div class="text-gray-500 small">December 7, 2019</div>
              $290.29 has been deposited into your account!
            </div>
          </a>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="mr-3">
              <div class="icon-circle bg-warning">
                <i class="text-white fas fa-exclamation-triangle"></i>
              </div>
            </div>
            <div>
              <div class="text-gray-500 small">December 2, 2019</div>
              Spending Alert: We've noticed unusually high spending for your account.
            </div>
          </a>
          <a class="text-center text-gray-500 dropdown-item small" href="#">Show All Alerts</a>
        </div>
      </li>

      <li class="mx-1 nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"></i>
          <span class="badge badge-warning badge-counter">2</span>
        </a>
        <div class="shadow dropdown-list dropdown-menu dropdown-menu-right animated--grow-in"
          aria-labelledby="messagesDropdown">
          <h6 class="dropdown-header">
            Message Center
          </h6>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="mr-3 dropdown-list-image">
              <img class="rounded-circle" src="img/man.png" style="max-width: 60px" alt="">
              <div class="status-indicator bg-success"></div>
            </div>
            <div class="font-weight-bold">
              <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been
                having.</div>
              <div class="text-gray-500 small">Udin Cilok · 58m</div>
            </div>
          </a>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="mr-3 dropdown-list-image">
              <img class="rounded-circle" src="img/girl.png" style="max-width: 60px" alt="">
              <div class="status-indicator bg-default"></div>
            </div>
            <div>
              <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people
                say this to all dogs, even if they aren't good...</div>
              <div class="text-gray-500 small">Jaenab · 2w</div>
            </div>
          </a>
          <a class="text-center text-gray-500 dropdown-item small" href="#">Read More Messages</a>
        </div>
      </li>

      <li class="mx-1 nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-tasks fa-fw"></i>
          <span class="badge badge-success badge-counter">3</span>
        </a>
        <div class="shadow dropdown-list dropdown-menu dropdown-menu-right animated--grow-in"
          aria-labelledby="messagesDropdown">
          <h6 class="dropdown-header">
            Task
          </h6>
          <a class="dropdown-item align-items-center" href="#">
            <div class="mb-3">
              <div class="text-gray-500 small">Design Button
                <div class="float-right small"><b>50%</b></div>
              </div>
              <div class="progress" style="height: 12px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </a>
          <a class="dropdown-item align-items-center" href="#">
            <div class="mb-3">
              <div class="text-gray-500 small">Make Beautiful Transitions
                <div class="float-right small"><b>30%</b></div>
              </div>
              <div class="progress" style="height: 12px;">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </a>
          <a class="dropdown-item align-items-center" href="#">
            <div class="mb-3">
              <div class="text-gray-500 small">Create Pie Chart
                <div class="float-right small"><b>75%</b></div>
              </div>
              <div class="progress" style="height: 12px;">
                <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </a>
          <a class="text-center text-gray-500 dropdown-item small" href="#">View All Taks</a>
        </div>
      </li> --}}

      <div class="topbar-divider d-none d-sm-block"></div>
      {{-- User Profile --}}
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <img class="img-profile rounded-circle" src="{{ Auth::user()->profile_photo_url ? asset(Auth::user()->profile_photo_url) : asset('assets/img/boy.png') }}" alt="{{ Auth::user()->name }}" style="max-width: 60px">
          <span class="ml-2 text-white d-none d-lg-inline small">{{Auth()->user()->name}}</span>
        </a>
        <div class="shadow dropdown-menu dropdown-menu-right animated--grow-in" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="{{ route('profile.show') }}">
            <i class="mr-2 text-gray-400 fas fa-user fa-sm fa-fw"></i>
            Profile
          </a>
          <a class="dropdown-item" href="#">
            <i class="mr-2 text-gray-400 fas fa-cogs fa-sm fa-fw"></i>
            Settings
          </a>
          <a class="dropdown-item" href="#">
            <i class="mr-2 text-gray-400 fas fa-list fa-sm fa-fw"></i>
            Activity Log
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
            <i class="mr-2 text-gray-400 fas fa-sign-out-alt fa-sm fa-fw"></i>
            Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>