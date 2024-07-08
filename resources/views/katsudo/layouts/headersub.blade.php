@include('katsudo.layouts.app')

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
                <div class="un-title-page go-back">
                    <a href="{{route($stgs['previous'])}}" class="icon visited">
                        <i class="ri-arrow-drop-left-line"></i>
                    </a>
                    <h1>{{$stgs['pagetitle']}}</h1>
                </div>
                <div class="un-block-right">
                    @auth('pendaftar')
                        <div class="un-notification">
                            <a href="{{route('activity.index')}}" aria-label="activity">
                                <i class="ri-notification-line"></i>
                            </a>
                            <span class="bull-activity"></span>
                        </div>
                        <div class="un-user-profile">
                            <a href="#user" aria-label="profile">
                                <picture>
                                    <source srcset="@if (Auth::guard('pendaftar')->user()->foto_anggota != 'default.jpg')
                            Storage::disk('public')->get(Auth::guard('pendaftar')->user()->foto_anggota)
                        @elseif (Auth::guard('pendaftar')->user()->foto_anggota == 'default.jpg' && Auth::guard('pendaftar')->user()->JK == 'pria')
                            /images/itsupp.png
                        @elseif (Auth::guard('pendaftar')->user()->foto_anggota == 'default.jpg' && Auth::guard('pendaftar')->user()->JK == 'wanita')
                            /images/itsukipp.png
                        @endif" type="image/png">
                                    <img class="img-avatar" src="@if (Auth::guard('pendaftar')->user()->foto_anggota != 'default.jpg')
                            Storage::disk('public')->get(Auth::guard('pendaftar')->user()->foto_anggota)
                        @elseif (Auth::guard('pendaftar')->user()->foto_anggota == 'default.jpg' && Auth::guard('pendaftar')->user()->JK == 'pria')
                            /images/itsupp.png
                        @elseif (Auth::guard('pendaftar')->user()->foto_anggota == 'default.jpg' && Auth::guard('pendaftar')->user()->JK == 'wanita')
                            /images/itsukipp.png
                        @endif" alt="">
                                </picture>
                            </a>
                        </div>
                    @endauth
                    @guest
                    <div class="un-user-profile">
                        <div class="un-notification">
                            <a href="{{route('flogin')}}" aria-label="activity">
                                <i class="ri-user-4-line"></i>
                            </a>
                        </div>
                    </div>
                    @endguest
                </div>
            </header>

            <div class="space-sticky"></div>
