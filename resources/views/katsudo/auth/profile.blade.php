@include('katsudo.layouts.header')

<section class="un-my-account">
    <!-- head -->
    <div class="head">
        <div class="my-personal-account">
            <div class="user">
                <picture>
                    <source srcset="
                        @if (Auth::guard('pendaftar')->user()->foto_anggota != 'default.jpg')
                            Storage::disk('public')->get(Auth::guard('pendaftar')->user()->foto_anggota)
                        @elseif (Auth::guard('pendaftar')->user()->foto_anggota == 'default.jpg' && Auth::guard('pendaftar')->user()->JK == 'pria')
                            /images/itsupp.png
                        @elseif (Auth::guard('pendaftar')->user()->foto_anggota == 'default.jpg' && Auth::guard('pendaftar')->user()->JK == 'wanita')
                            /images/itsukipp.png
                        @endif
                        " type="image/webp">
                    <img src="" alt="">
                </picture>
                <div class="txt-user">
                    <h1>{{auth('pendaftar')->user()->NamaLengkap}}</h1>
                    <p>@if (auth('pendaftar')->user()->nomor_anggota == NULL)
                        No. Anggota
                    @else
                        {{auth('pendaftar')->user()->nomor_anggota}}
                    @endif</p>
                </div>
            </div>
            <button type="button" class="btn btn-copy-address">
                <input type="checkbox">
                <div class="icon-box">
                    <i class="ri-file-copy-2-line"></i>
                </div>
            </button>
        </div>
    </div>
    <!-- body -->
    <div class="body">
        <div class="img-coin-eth">
            <picture>
                @if (auth('pendaftar')->user()->sts->level == 1)
                    @if (auth('pendaftar')->user()->sts->status == 'Hikōshiki')
                        <source srcset="/images/hikoshiki.svg" type="image/webp">
                        <img src="/images/hikoshiki.svg" alt="">
                    @else
                        <source srcset="/images/hikatsudo.svg" type="image/webp">
                        <img src="/images/hikatsudo.svg" alt="">
                    @endif
                @else
                    <source srcset="/images/{{auth('pendaftar')->user()->sts->img}}" type="image/webp">
                    <img src="/images/kaiin.svg" alt="">
                @endif
            </picture>
        </div>
        <div class="my-balance-text">
            <h2>{{auth('pendaftar')->user()->dpt->nama}}</h2>
            <p>{{auth('pendaftar')->user()->sts->status}}</p>

            <a href="{{route('katsudo.index')}}"
                class="btn btn-md-size effect-click border-primary rounded-pill text-primary"
                >
                Profile Saya
            </a>
        </div>
    </div>
</section>
<section class="un-navMenu-default without-visit un-creator-ptofile">
    <div class="accordion nav flex-column" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Statistik
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                <div class="accordion-body px-0">
                    <div class="body mx-auto">
                        <div class="statisticses">
                            <div class="text-grid">
                                <h4>35</h4>
                                <p>Hadir</p>
                            </div>
                            <div class="text-grid">
                                <h4>2</h4>
                                <p>Absen</p>
                            </div>
                            <div class="text-grid">
                                <h4>8</h4>
                                <p>Izin</p>
                            </div>
                            <div class="text-grid">
                                <h4>48</h4>
                                <p>THB</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <ul class="nav flex-column">
        @if ((auth('pendaftar')->user()->dpt->id != 1) && (auth('pendaftar')->user()->sts->level == 4))
            <div class="sub-title-pkg">
                <h2>Portal Departemen</h2>
            </div>
            <li class="nav-item">
                <a class="nav-link visited" href="#">
                    <div class="item-content-link">
                        <div class="icon bg-green-1 color-green">
                            {!! auth('pendaftar')->user()->dpt->icon !!}
                        </div>
                        <h3 class="link-title">Dashboard Departemen</h3>
                    </div>
                    <div class="other-cc">
                        <span class="badge-text"></span>
                        <div class="icon-arrow">
                            <i class="ri-arrow-drop-right-line"></i>
                        </div>
                    </div>
                </a>
            </li>
        @endif

        <div class="sub-title-pkg">
            <h2>Dasar</h2>
        </div>
        <li class="nav-item">
            <a class="nav-link visited" href="page-my-wallet.html">
                <div class="item-content-link">
                    <div class="icon bg-green-1 color-green">
                        <i class="ri-wallet-line"></i>
                    </div>
                    <h3 class="link-title">My Wallet</h3>
                </div>
                <div class="other-cc">
                    <span class="badge-text"> 0Xe388...E162</span>
                    <div class="icon-arrow">
                        <i class="ri-arrow-drop-right-line"></i>
                    </div>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="page-edit-profile.html">
                <div class="item-content-link">
                    <div class="icon bg-orange-1 color-orange">
                        <i class="ri-user-3-line"></i>
                    </div>
                    <h3 class="link-title">Edit Profile</h3>
                </div>
                <div class="other-cc">
                    <span class="badge-text"></span>
                    <div class="icon-arrow">
                        <i class="ri-arrow-drop-right-line"></i>
                    </div>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="page-my-item.html">
                <div class="item-content-link">
                    <div class="icon bg-blue-1 color-blue">
                        <i class="ri-landscape-line"></i>
                    </div>
                    <h3 class="link-title">My Items</h3>
                </div>
                <div class="other-cc">
                    <span class="badge-text"></span>
                    <div class="icon-arrow">
                        <i class="ri-arrow-drop-right-line"></i>
                    </div>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="page-news-list.html">
                <div class="item-content-link">
                    <div class="icon bg-pink-1 color-pink">
                        <i class="ri-file-list-2-line"></i>
                    </div>
                    <h3 class="link-title">News List</h3>
                </div>
                <div class="other-cc">
                    <span class="badge-text"></span>
                    <div class="icon-arrow">
                        <i class="ri-arrow-drop-right-line"></i>
                    </div>
                </div>
            </a>
        </li>

        <div class="sub-title-pkg">
            <h2>Settings</h2>
        </div>

        <li class="nav-item">
            <div class="nav-link">
                <div class="item-content-link">
                    <div class="txt">
                        <h3 class="link-title">Yoru Mode</h3>
                        <p class="size-11 color-text m-0">Berkegiatan dengan Tampilan Malam</p>
                    </div>
                </div>
                <div class="other-cc">

                    <label class="switch_toggle toggle_lg theme-switch" for="switchDark">
                        <input type="checkbox" class="switchDarkMode theme-switch" id="switchDark"
                            aria-describedby="switchDark" aria-label="switchDark">
                        <span class="handle"></span>
                    </label>

                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="javascript: void(0)">
                <div class="item-content-link">
                    <div class="icon bg-snow text-dark">
                        <i class="ri-global-line"></i>
                    </div>
                    <h3 class="link-title">Language</h3>
                </div>
                <div class="other-cc">
                    <span class="badge-text">English (UK)</span>
                    <div class="icon-arrow">
                        <i class="ri-arrow-drop-right-line"></i>
                    </div>
                </div>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="page-activity-settings.html">
                <div class="item-content-link">
                    <div class="icon bg-red-1 color-red">
                        <i class="ri-notification-line"></i>
                    </div>
                    <h3 class="link-title">Activity Settings</h3>
                </div>
                <div class="other-cc">
                    <span class="badge-text"></span>
                    <div class="icon-arrow">
                        <i class="ri-arrow-drop-right-line"></i>
                    </div>
                </div>
            </a>
        </li>

        <div class="sub-title-pkg">
            <h2>Support</h2>
        </div>

        <li class="nav-item">
            <a class="nav-link visited" href="page-help.html">
                <div class="item-content-link">
                    <div class="icon bg-green-1 color-green">
                        <i class="ri-questionnaire-line"></i>
                    </div>
                    <h3 class="link-title">Help Center</h3>
                </div>
                <div class="other-cc">
                    <span class="badge-text"></span>
                    <div class="icon-arrow">
                        <i class="ri-arrow-drop-right-line"></i>
                    </div>
                </div>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="page-about.html">
                <div class="item-content-link">
                    <div class="icon bg-blue-1 color-blue">
                        <i class="ri-information-line"></i>
                    </div>
                    <h3 class="link-title">About Unic.</h3>
                </div>
                <div class="other-cc">
                    <span class="badge-text"></span>
                    <div class="icon-arrow">
                        <i class="ri-arrow-drop-right-line"></i>
                    </div>
                </div>
            </a>
        </li>

        <div class="sub-title-pkg">
            <h2>Aitakatta 😢</h2>
        </div>

        <li class="nav-item">
            <a class="nav-link" href="{{route('klogout')}}">
                <div class="item-content-link">
                    <div class="icon bg-snow text-dark">
                        <i class="ri-logout-box-r-line"></i>
                    </div>
                    <h3 class="link-title">Logout</h3>
                </div>
                <div class="other-cc">
                    <span class="badge-text size-18">😟</span>
                    <div class="icon-arrow">
                        <i class="ri-arrow-drop-right-line"></i>
                    </div>
                </div>
            </a>
        </li>


    </ul>
</section>
<!-- ===================================
  START THE COPYRIGHT MARK
==================================== -->
<section class="copyright-mark">
    <div class="content">
        <img class="logo-gray" src="/images/logo-gray.svg" alt="image">
        <p>Copyright © smuneljc 2023</p>
    </div>
</section>

@include('katsudo.layouts.footer')

