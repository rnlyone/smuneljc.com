<!DOCTYPE html>

<!-- =========================================================
* Frest - Bootstrap Admin Template | v1.0.0
==============================================================

* Product Page: https://1.envato.market/frest_admin
* Created by: PIXINVENT
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright PIXINVENT (https://pixinvent.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html lang="en" class="light-style  customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="assetsdash/" data-template="vertical-menu-template">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login Basic - Pages | Frest - Bootstrap Admin Template</title>

    <meta name="description" content="Start your development with a Dashboard for Bootstrap 5" />
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 admin, bootstrap 5 design, bootstrap 5">
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://1.envato.market/frest_admin">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assetsdash/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="assetsdash/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="assetsdash/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="assetsdash/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assetsdash/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assetsdash/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assetsdash/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assetsdash/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="assetsdash/vendor/libs/typeahead-js/typeahead.css" />
    <!-- Vendor -->
<link rel="stylesheet" href="assetsdash/vendor/libs/formvalidation/dist/css/formValidation.min.css" />

    <!-- Page CSS -->
    <!-- Page -->
<link rel="stylesheet" href="assetsdash/vendor/css/pages/page-auth.css">
    <!-- Helpers -->
    <script src="assetsdash/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="assetsdash/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assetsdash/js/config.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async="async" src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'GA_MEASUREMENT_ID');
    </script>
    <!-- Custom notification for demo -->
    <!-- beautify ignore:end -->

</head>

<body>

    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">

                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- /Logo -->
                        <h4 class="mb-2">Selamat Datang 👋</h4>
                        <p class="mb-4">Silahkan Sign In</p>

                        <form id="formAuthentication" class="mb-3" action="login" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" autofocus>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                            </div>
                        </form>
                        @if (session()->get('gagal'))
                        <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                            <div class="alert-body d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info me-50"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                            <span>{{session('gagal')}}</span>
                            </div>
                        </div>
                    @endif
                    @error('email')
                        <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                            <div class="alert-body d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info me-50"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                            <span>{{$message}}</span>
                            </div>
                        </div>
                    @enderror
                    @error('password')
                        <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                            <div class="alert-body d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info me-50"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                            <span>{{$message}}</span>
                            </div>
                        </div>
                    @enderror
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>

    <!-- / Content -->





    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="assetsdash/vendor/libs/jquery/jquery.js"></script>
    <script src="assetsdash/vendor/libs/popper/popper.js"></script>
    <script src="assetsdash/vendor/js/bootstrap.js"></script>
    <script src="assetsdash/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assetsdash/vendor/libs/hammer/hammer.js"></script>


    <script src="assetsdash/vendor/libs/i18n/i18n.js"></script>
    <script src="assetsdash/vendor/libs/typeahead-js/typeahead.js"></script>

    <script src="assetsdash/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="assetsdash/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
    <script src="assetsdash/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
    <script src="assetsdash/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>

    <!-- Main JS -->
    <script src="assetsdash/js/main.js"></script>

    <!-- Page JS -->
    <script src="assetsdash/js/pages-auth.js"></script>
</body>

</html>
