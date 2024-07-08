<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="format-detection" content="telephone=no">
    <!-- <meta name="theme-color" content="#ffffff"> -->
    <meta name="theme-color" content="#ffffff" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#222032" media="(prefers-color-scheme: dark)">
    <title>Katsudo</title>
    <meta name="description" content="Katsudo | SmunelJC">
    <meta name="keywords"
        content="gakuensai, festival, expo, competition, pwa" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- FAVICON -->
    {{-- <link rel="icon" type="image/png" href="/images/favicon/icon-32x32.png" sizes="32x32">
    <!-- IOS SUPPORT -->
    <link rel="apple-touch-icon" href="/images/favicon/icon-96x96.png"> --}}
    <!-- CSS FILES -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/remixicon.min.css">
    <link rel="stylesheet" href="/assets/vendors/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="/assets/vendors/zuck_stories/zuck.min.css">


    {{-- <script>
        // Disable right-click
        document.addEventListener('contextmenu', (e) => e.preventDefault());

        function ctrlShiftKey(e, keyCode) {
        return e.ctrlKey && e.shiftKey && e.keyCode === keyCode.charCodeAt(0);
        }

        document.onkeydown = (e) => {
        // Disable F12, Ctrl + Shift + I, Ctrl + Shift + J, Ctrl + U
        if (
            event.keyCode === 123 ||
            ctrlShiftKey(e, 'I') ||
            ctrlShiftKey(e, 'J') ||
            ctrlShiftKey(e, 'C') ||
            (e.ctrlKey && e.keyCode === 'U'.charCodeAt(0))
        )
            return false;
        };
    </script> --}}

    @laravelPWA

</head>

<body>
    <!-- ===================================
      START LODAER PAGE
    ==================================== -->
    <section class="loader-page" id="loaderPage">
        <div class="spinner_flash"></div>
    </section>
    <!-- START WRAPPER -->
    <div id="wrapper">
        <!-- START CONTENT -->
        <div id="content">
            <!-- ===================================
              START THE HEADER
            ==================================== -->

            <header class="default heade-sticky">
                <a href="/ktd/katsudo">
                    <div class="un-item-logo">
                        <img class="logo-img light-mode" src="/images/katsudo_merah.svg" alt="">
                        <img class="logo-img dark-mode" src="/images/katsudo_putih.svg" alt="">
                    </div>
                </a>
            </header>

            <div class="space-sticky"></div>
            <div class="padding-50 pt-0"></div>
            <div class="padding-50 pt-0"></div>
            <div class="padding-50 pt-0"></div>

<div class="empty-items">
    <img class="empty-light" src="images/masihkosong.gif" alt="">
    <img class="empty-dark" src="images/masihkosong.gif" alt="">
    <h4>Kamu Offline</h4>
    <p>Gomen, Coba Cek Internet Kamu</p>
</div>
    </div>
    <!-- ===================================
      START THE MODAL SIDEBAR MENU - CONNECTED
    ==================================== -->
    <!-- ===================================
      START STATUS CONNECTION
    ==================================== -->
    <div class="d-flex justify-content-center">
        <div class="toast status-connection" role="alert" aria-live="assertive" aria-atomic="true"></div>
    </div>


    @include('katsudo.layouts.jses')

</body>

</html>

