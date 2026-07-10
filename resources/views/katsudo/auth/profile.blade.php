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
        <div class="img-coin-eth" style="position:relative;display:inline-block;">
            <!-- Department icon (main) -->
            <picture>
                @if(auth('pendaftar')->user()->sts->level == 1)
                    @if(auth('pendaftar')->user()->sts->status == 'Hikōshiki')
                    <source srcset="/images/hikoshiki.svg" type="image/webp">
                    <img src="/images/hikoshiki.svg" type="image/webp">
                    @else
                    <source srcset="/images/hikatsudo.svg" type="image/webp">
                    <img src="/images/hikatsudo.svg" type="image/webp">
                    @endif
                @else
                <source srcset="/images/{{auth('pendaftar')->user()->sts->img}}" type="image/webp">
                <img src="/images/{{auth('pendaftar')->user()->sts->img}}" type="image/webp">
                @endif
            </picture>
            <!-- Status badge (small, floating bottom-right) -->
            <div style="position:absolute;bottom:-6px;right:-6px;width:60px;height:60px;display:flex;align-items:center;justify-content:center;">
                @if(auth('pendaftar')->user()->dpt->img)
                    <img src="/images/{{auth('pendaftar')->user()->dpt->img}}" alt="Departemen" style="width:100%;height:100%;object-fit:contain;">
                @else
                    <img src="/images/kaiin.svg" alt="Departemen" style="width:100%;height:100%;object-fit:contain;">
                @endif

            </div>
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
                    @if($latestPeriode)
                        <small class="ms-2 opacity-50" style="font-size:.75em;">
                            {{ $latestPeriode->angkatan }} {{ $latestPeriode->tahun_mulai }}/{{ $latestPeriode->tahun_mulai + 1 }}
                        </small>
                    @endif
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                <div class="accordion-body px-0">
                    <div class="body mx-auto">
                        @if($keaktifan)
                        <div class="statisticses">
                            <div class="text-grid">
                                <h4>{{ $keaktifan->jumlah_th ?? 0 }}</h4>
                                <p>Hadir</p>
                            </div>
                            <div class="text-grid">
                                <h4>{{ $keaktifan->jumlah_absen ?? 0 }}</h4>
                                <p>Absen</p>
                            </div>
                            <div class="text-grid">
                                <h4>{{ $keaktifan->jumlah_izin ?? 0 }}</h4>
                                <p>Izin</p>
                            </div>
                            <div class="text-grid">
                                <h4>{{ $keaktifan->jumlah_th_berturut ?? 0 }}</h4>
                                <p>THB</p>
                            </div>
                        </div>
                        @else
                        <p class="text-center opacity-50 py-3" style="font-size:.85em;">
                            Belum ada kartu keaktifan untuk periode ini.
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    <ul class="nav flex-column">

        {{-- ── PORTAL DEPARTEMEN (Kyokucho level 4, bukan dept umum) ── --}}
        @php
            $me = auth('pendaftar')->user();
            $isKyokucho = $me->sts->level == 4 && $me->dpt && $me->dpt->kyokucho == $me->id && $me->dpt->id != 1;
            $isKaicho   = $me->sts->level >= 5;
        @endphp

        @if($isKyokucho)
        <div class="sub-title-pkg">
            <h2>Portal Departemen</h2>
        </div>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dpt.dash', $me->dpt->getSlugAttribute()) }}">
                <div class="item-content-link">
                    <div class="icon bg-green-1 color-green">
                        <i class="ri-home-gear-line"></i>
                    </div>
                    <h3 class="link-title">Dashboard Departemen</h3>
                </div>
                <div class="other-cc">
                    <span class="badge-text">{{ $me->dpt->nama }}</span>
                    <div class="icon-arrow"><i class="ri-arrow-drop-right-line"></i></div>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('katsudo.divisi') }}">
                <div class="item-content-link">
                    <div class="icon bg-blue-1 color-blue">
                        <i class="ri-calendar-event-line"></i>
                    </div>
                    <h3 class="link-title">Katsudo Divisi</h3>
                </div>
                <div class="other-cc">
                    <span class="badge-text"></span>
                    <div class="icon-arrow"><i class="ri-arrow-drop-right-line"></i></div>
                </div>
            </a>
        </li>
        @endif

        {{-- ── REKOMENDASI (Kyokucho atau Kaicho) ── --}}
        @if($isKyokucho || $isKaicho)
        @if(!$isKyokucho)
        <div class="sub-title-pkg">
            <h2>Portal Ketua</h2>
        </div>
        @endif
        <li class="nav-item">
            <a class="nav-link" href="{{ route('ktd.rekomendasi') }}">
                <div class="item-content-link">
                    <div class="icon bg-orange-1 color-orange">
                        <i class="ri-award-line"></i>
                    </div>
                    <h3 class="link-title">Rekomendasi Katsudo</h3>
                </div>
                <div class="other-cc">
                    <span class="badge-text"></span>
                    <div class="icon-arrow"><i class="ri-arrow-drop-right-line"></i></div>
                </div>
            </a>
        </li>
        @endif

        {{-- ── DASAR (semua anggota) ── --}}
        <div class="sub-title-pkg">
            <h2>Akun</h2>
        </div>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('ktd.profil.edit') }}">
                <div class="item-content-link">
                    <div class="icon bg-pink-1 color-pink">
                        <i class="ri-edit-line"></i>
                    </div>
                    <h3 class="link-title">Edit Profil</h3>
                </div>
                <div class="other-cc">
                    <span class="badge-text"></span>
                    <div class="icon-arrow"><i class="ri-arrow-drop-right-line"></i></div>
                </div>
            </a>
        </li>

        {{-- ── SETTINGS ── --}}
        <div class="sub-title-pkg">
            <h2>Tampilan</h2>
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

        {{-- ── KELUAR ── --}}
        <div class="sub-title-pkg">
            <h2>Aitakatta 😢</h2>
        </div>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('klogout') }}">
                <div class="item-content-link">
                    <div class="icon bg-snow text-dark">
                        <i class="ri-logout-box-r-line"></i>
                    </div>
                    <h3 class="link-title">Logout</h3>
                </div>
                <div class="other-cc">
                    <span class="badge-text size-18">😟</span>
                    <div class="icon-arrow"><i class="ri-arrow-drop-right-line"></i></div>
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

