<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Favicon icon-->
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />

  <!-- Core Css -->
  <link rel="stylesheet" href="../assets/css/styles.css" />

  <title>Attendance Form</title>
</head>

<body>
  <!-- Preloader -->
  <div class="preloader">
    <img src="../assets/images/logos/favicon.png" alt="loader" class="lds-ripple img-fluid" />
  </div>

  <div id="main-wrapper" class="p-0 bg-white auth-customizer-none">
    <div class="overflow-hidden auth-login position-relative d-flex align-items-center justify-content-center px-7 px-xxl-0 rounded-3 h-n20">
      <div class="auth-login-shape position-relative w-100">
        <div class="container mb-0 auth-login-wrapper card position-relative z-1 h-100 mh-n100" data-simplebar>
          <div class="card-body">
            <a href="/" class="">
              <img src="../assets/images/logos/logo-dark.svg" class="light-logo" alt="Logo-Dark" />
              <img src="../assets/images/logos/logo-light.svg" class="dark-logo" alt="Logo-light" />
            </a>
            <div class="pt-6 pb-5 row align-items-center justify-content-around">
              <div class="col-lg-6 col-xl-5 d-none d-lg-block">
                <div class="text-center text-lg-start">
                  <img src="../assets/images/backgrounds/attendance.png" alt="spike-img" class="img-fluid" width="100%">
                </div>
              </div>

              <div class="col-lg-6 col-xl-5">
                  <h2 class="mb-6 fs-8 fw-bolder">Register Attendance</h2>

                  @if (session('status'))
                    <div class="mb-4 text-sm font-medium text-success">
                        {{ session('status') }}
                    </div>
                  @endif

                  @if (session('error'))
                    <div class="mb-4 text-sm font-medium text-danger">
                      {{ session('error') }}
                    </div>
                  @endif


                  <form method="POST" action="{{ route('attendance.record') }}">
                      @csrf

                      <input type="hidden" value="{{ $churchId }}"  name="church_id">

                      <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="is_member" class="form-label fw-bold">Are you a member?</label>
                            <select class="py-2 form-control" id="is_member" name="is_member" required>
                                <option value="">Select an option</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="service" class="form-label fw-bold">Service</label>
                            <select class="py-2 form-control" id="service" type="text"aria-label="service" name="service" :value="old('service')" required>
                                @foreach ($service as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                      </div>

                    <div class="mb-2" id="member_fields" style="display: none;">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="member_name" class="form-label fw-bold">Name</label>
                                <input type="member_name" class="py-2 form-control" id="member_name" aria-describedby="member_name" name="member_name" :value="old('member_name')">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="member_email" class="form-label fw-bold">Email</label>
                                <input type="email" class="py-2 form-control" id="member_email" aria-describedby="member_email" name="member_email" :value="old('member_email')" autocomplete="username">
                                <small id="email-status" class="form-text text-muted"></small> <!-- Add this -->
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="member_phone" class="form-label fw-bold">Phone</label>
                                <input class="py-2 form-control" id="member_phone" type="text" placeholder="" aria-label="member_phone" name="member_phone" :value="old('member_phone')">
                                <small id="phone-status" class="form-text text-muted"></small> <!-- Add this -->
                            </div>


                          <div class="mb-3 col-md-6">
                            <label for="cell_name" class="form-label fw-bold">Cell Name</label>
                            <input class="py-2 form-control" id="cell_name" type="text" placeholder="" aria-label="cell_name" name="cell_name" :value="old('cell_name')" >
                         </div>

                         <div id="family-members-section" style="display: none;">
                            <h6 class="fw-bold">Family Members</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Select</th>
                                        <th>Name</th>
                                        <th>Relationship</th>
                                    </tr>
                                </thead>
                                <tbody id="family-members-table">
                                    <!-- Dynamic Rows Will Be Injected Here -->
                                </tbody>
                            </table>
                        </div>
                        </div>

                    </div>

                    <div class="mb-2" id="non_member_fields" style="display: none;">
                       <div class="row">

                        <div class="mb-2 col-md-6">
                            <label for="name" class="form-label fw-bold">Name</label>
                            <input type="text" class="py-2 form-control" id="name" aria-describedby="name" name="name" :value="old('name')">
                        </div>

                        <div class="mb-2 col-md-6">
                            <label for="member_name" class="form-label fw-bold">Gender</label>
                            <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                                <option value="">Select gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2 col-md-6">
                            <label class="form-label" for="name">Date of birth</label>
                            <input type="date" name="dob" class="form-control @error('dob') is-invalid @enderror" id="dob">
                            @error('dob')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2 col-lg-6">
                            <label class="form-label" for="occupation">Occupation</label>
                            <input class="form-control  @error('occupation') is-invalid @enderror" name="occupation" id="le_occupation">
                            @error('occupation')
                            <small class="invalid-feedback" role="alert">
                            {{ $message }}
                            </small>
                            @enderror
                        </div>

                        <div class="mb-2 col-md-6">
                            <label for="phone" class="form-label fw-bold">Phone</label>
                            <input class="py-2 form-control" id="phone" type="text" placeholder="" aria-label="phone" name="phone" :value="old('phone')">
                        </div>

                        <div class="mb-2 col-md-6">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="py-2 form-control" id="email" aria-describedby="email" name="email" :value="old('email')" autocomplete="username">
                        </div>

                        <div class="mb-2 col-lg-6">
                            <label class="form-label" for="preferred_contact">Preferred Contact</label>
                            <select class="form-control @error('preferred_contact') is-invalid @enderror" id="preferred_contact" name="preferred_contact">
                                <option value="">Select</option>
                                <option value="Email">Email</option>
                                <option value="Phone">Phone</option>
                                <option value="Text">Text Message</option>
                            </select>
                            @error('preferred_contact')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2 col-lg-6">
                            <label class="form-label" for="best_time">Best Time to Ring</label>
                            <input type="text" name="best_time" class="form-control  @error('best_time') is-invalid @enderror" placeholder="Morning 8:00am" id="best_time">
                            @error('best_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="location">Location</label>
                            <input class="form-control  @error('location') is-invalid @enderror" name="location" placeholder="City/Country" id="le_location">
                            @error('location')
                            <small class="invalid-feedback" role="alert">
                            {{ $message }}
                            </small>
                            @enderror
                        </div>

                        <div class="mb-2 col-md-6">
                            <label for="invitee" class="form-label fw-bold">Invitee Name</label>
                            <input class="py-2 form-control" id="invitee" type="text" placeholder="" aria-label="invitee" name="invitee" :value="old('invitee')"  >
                        </div>

                        <div class="mb-2 col-lg-6">
                            <label class="form-label" for="membership_interest">Connect as a family member .
                            </label>
                            <select class="form-control @error('membership_interest') is-invalid @enderror" id="membership_interest" name="membership_interest">
                                <option value="">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="Need time">Need some time</option>
                                <option value="No">No</option>
                            </select>
                            @error('membership_interest')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                       </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill">Record</button>

                  </form>

              </div>

            </div>
          </div>
        </div>
        <script>
            function handleColorTheme(e) {
                    document.documentElement.setAttribute("data-color-theme", e);
            }
        </script>

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
    </div>
    <div class="dark-transparent sidebartoggler"></div>
  </div>
  <!-- Import Js Files -->
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.min.js"></script>
  <script src="../assets/js/theme/app.init.js"></script>
  <script src="../assets/js/theme/theme.js"></script>
  <script src="../assets/js/theme/app.min.js"></script>
  <script src="../assets/js/theme/feather.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
    const isMemberSelect = document.getElementById('is_member');
    const nonMemberFields = document.getElementById('non_member_fields');
    const memberFields = document.getElementById('member_fields');

    // Initially hide both
    nonMemberFields.style.display = 'none';
    memberFields.style.display = 'none';

    isMemberSelect.addEventListener('change', function () {
        if (this.value === 'yes') {
            memberFields.style.display = 'block';
            nonMemberFields.style.display = 'none';
        } else if (this.value === 'no') {
            nonMemberFields.style.display = 'block';
            memberFields.style.display = 'none';
        } else {
            nonMemberFields.style.display = 'none';
            memberFields.style.display = 'none';
        }
    });

    const emailInput = document.getElementById('member_email');
    const phoneInput = document.getElementById('member_phone');
    const emailStatus = document.getElementById('email-status');
    const phoneStatus = document.getElementById('phone-status');
    const familyMembersSection = document.getElementById('family-members-section');
    const familyMembersTable = document.getElementById('family-members-table');

    // Function to fetch family members
    function fetchFamilyMembers(identifier, type) {
        const payload = {};
        payload[type] = identifier;

        fetch("{{ route('check.member') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}", // Include CSRF token for security
            },
            body: JSON.stringify(payload),
        })
            .then(response => {
                // Ensure response is JSON
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.status === "not_found") {
                    if (type === 'email') {
                        emailStatus.textContent = data.message;
                    } else if (type === 'phone') {
                        phoneStatus.textContent = data.message;
                    }
                    familyMembersSection.style.display = "none";
                } else if (data.status === "found") {
                    if (type === 'email') {
                        emailStatus.textContent = "Member found!";
                    } else if (type === 'phone') {
                        phoneStatus.textContent = "Member found!";
                    }

                    // Clear existing rows
                    familyMembersTable.innerHTML = "";

                    // Check if there are any family members
                    if (data.family_members.length === 0) {
                        familyMembersTable.innerHTML = "<tr><td colspan='3'>No family members found.</td></tr>";
                    } else {
                        // Populate the family members table
                        data.family_members.forEach(member => {
                            const row = `
                                <tr>
                                    <td>
                                        <input type="checkbox" name="family_members[]" value="${member.id}">
                                    </td>
                                    <td>${member.name}</td>
                                    <td>${member.relation || 'N/A'}</td>
                                </tr>
                            `;
                            familyMembersTable.insertAdjacentHTML('beforeend', row);
                        });
                    }

                    familyMembersSection.style.display = "block";
                }
            })
            .catch(error => {
                console.error("Error:", error);
                if (type === 'email') {
                    emailStatus.textContent = "";
                } else if (type === 'phone') {
                    phoneStatus.textContent = "";
                }
                familyMembersSection.style.display = "none";
            });
    }

    // Add event listeners for both inputs
    emailInput.addEventListener('blur', function () {
        const email = this.value.trim();
        if (email) {
            emailStatus.textContent = "Checking...";
            fetchFamilyMembers(email, 'email');
        }
    });

    phoneInput.addEventListener('blur', function () {
        const phone = this.value.trim();
        if (phone) {
            phoneStatus.textContent = "Checking...";
            fetchFamilyMembers(phone, 'phone');
        }
    });
});

  </script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>


