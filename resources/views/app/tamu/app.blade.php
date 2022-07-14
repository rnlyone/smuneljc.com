@include('app.tamu.header', ['pagetitle' => $pagetitle])

<body>

  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar  layout-without-menu">
    <div class="layout-container">

      <!-- Layout container -->
      <div class="layout-page">

        <!-- Navbar -->
        <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
          <div class="container-fluid">

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                {{-- logo --}}
                <div class="navbar-nav align-items-center">
                    <a class="nav-link" href="/">
                        <div class="avatar">
                            <img class="rounded-circle"  src="/assetshome/img/logosjc.png" alt="logo"/>
                        </div>
                      </a>
                </div>
                {{-- endlogo --}}
              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!--/ Language -->




                <!-- Style Switcher -->
                <li class="nav-item me-2 me-xl-0">
                  <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                    <i class='bx bx-sm'></i>
                  </a>
                </li>
                <!--/ Style Switcher -->

                <!-- Quick links  -->
                <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-2 me-xl-0">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-expanded="false">
                    <i class='bx bx-grid-alt bx-sm'></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end py-0">
                    <div class="dropdown-menu-header border-bottom">
                      <div class="dropdown-header d-flex align-items-center py-3">
                        <h5 class="text-body mb-0 me-auto">Shortcuts</h5>
                        <a href="javascript:void(0)" class="dropdown-shortcuts-add text-body" data-bs-toggle="tooltip"
                          data-bs-placement="top" title="Add shortcuts"><i class="bx bx-sm bx-plus-circle"></i></a>
                      </div>
                    </div>
                  </div>
                </li>
                <!-- Quick links -->

                <!-- Notification -->
                <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-expanded="false">
                    <i class="bx bx-bell bx-sm"></i>
                    <span class="badge bg-danger rounded-pill badge-notifications">0</span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end py-0">
                    <li class="dropdown-menu-header border-bottom">
                      <div class="dropdown-header d-flex align-items-center py-3">
                        <h5 class="text-body mb-0 me-auto">Notification</h5>
                        <a href="javascript:void(0)" class="dropdown-notifications-all text-body"
                          data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read"><i
                            class="bx fs-4 bx-envelope-open"></i></a>
                      </div>
                    </li>
                    <li class="dropdown-menu-footer border-top">
                      <a href="javascript:void(0);" class="dropdown-item d-flex justify-content-center p-3">
                        View all notifications
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ Notification -->


              </ul>
            </div>


            <!-- Search Small Screens -->
            <div class="navbar-search-wrapper search-input-wrapper  d-none">
              <input type="text" class="form-control search-input container-fluid border-0" placeholder="Search..."
                aria-label="Search...">
              <i class="bx bx-x bx-sm search-toggler cursor-pointer"></i>
            </div>


          </div>
        </nav>
