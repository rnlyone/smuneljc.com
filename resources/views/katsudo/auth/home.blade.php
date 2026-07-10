@include('katsudo.layouts.header')

@php
    /**
     * Helper cover katsudo: pakai gambar departemen ranah, fallback ke logo.
     */
    $cover = function ($k) {
        $img = optional($k->dpt)->img;
        return $img ?: '/images/katsudo_merah.svg';
    };

    /**
     * Helper foto PJ (penanggung jawab) katsudo.
     */
    $pjFoto = function ($k) {
        $pj = $k->pj;
        if (!$pj) return '/images/itsupp.png';
        if ($pj->foto_anggota && $pj->foto_anggota != 'default.jpg') {
            return \Illuminate\Support\Facades\Storage::disk('public')->url($pj->foto_anggota);
        }
        return $pj->JK == 'wanita' ? '/images/itsukipp.png' : '/images/itsupp.png';
    };

    /**
     * Label & warna fase absensi.
     */
    $faseLabel = function ($k) {
        return match ($k->absensi_fase) {
            'masuk', 'keluar' => ['Sedang Berlangsung', 'no-sales'],
            'selesai'         => ['Selesai', 'no-sales'],
            default           => ['Terjadwal', 'no-sales'],
        };
    };
@endphp

<section class="un-page-components">
    <div class="un-title-default">
        <div class="text">
            <h2>Okaeri😆, {{ $nickname }}</h2>
            <p>Portal Katsudo SmunelJC</p>
        </div>
    </div>
    <div class="content-comp p-0">

        <div class="space-items"></div>

        {{-- ════════════════ KATSUDO TERDEKAT ════════════════ --}}
        <div class="un-navMenu-default pt-3 pb-0">
            <div class="sub-title-pkg py-0">
                <h2>Katsudo Terdekat!</h2>
            </div>
        </div>

        <div class="bg-white padding-20">
            @if ($terdekat)
                <div class="item-card-gradual">
                    <a href="{{ route('katsudo.show', $terdekat->id) }}" class="body-card">
                        <div class="cover-nft">
                            <picture>
                                <img class="img-cover" src="{{ $cover($terdekat) }}" alt="{{ $terdekat->nama }}">
                            </picture>
                            <div class="icon-type">
                                <i class="ri-calendar-event-line"></i>
                            </div>
                            <div class="countdown-time">
                                <span class="js-countdown" data-target="{{ $terdekat->tgl_laksana->toIso8601String() }}">
                                    {{ $terdekat->tgl_laksana->isoFormat('D MMM') }}
                                </span>
                            </div>
                        </div>
                        <div class="title-card-nft">
                            <div class="side-one">
                                <h2>{{ $terdekat->nama }}</h2>
                                <p>{{ optional($terdekat->dpt)->nama ?? 'Umum' }}</p>
                            </div>
                            <div class="side-other">
                                <span class="no-sales">{{ $faseLabel($terdekat)[0] }}</span>
                            </div>
                        </div>
                        <div class="creator-name">
                            <div class="image-user">
                                <picture>
                                    <img class="img-avatar" src="{{ $pjFoto($terdekat) }}" alt="">
                                </picture>
                                <div class="icon">
                                    <i class="ri-checkbox-circle-fill"></i>
                                </div>
                            </div>
                            <h3>{{ optional($terdekat->pj)->NamaLengkap ?? 'Panitia' }}</h3>
                        </div>
                    </a>
                    <div class="footer-card">
                        <div class="starting-bad">
                            <h4>{{ $terdekat->tgl_laksana->isoFormat('dddd, D MMM YYYY') }}</h4>
                            <span>{{ $terdekat->tgl_laksana->isoFormat('HH:mm') }} WIB</span>
                        </div>
                        <a href="{{ route('katsudo.show', $terdekat->id) }}" class="btn-like-click">
                            <div class="btnLike">
                                <i class="ri-arrow-right-line"></i>
                            </div>
                        </a>
                    </div>
                </div>
            @else
                <div class="item-empty text-center py-4">
                    <i class="ri-calendar-todo-line size-30 opacity-50"></i>
                    <p class="size-14 opacity-75 mb-0 mt-2">Belum ada katsudo terjadwal untukmu.</p>
                </div>
            @endif
        </div>

        {{-- ════════════════ KATSUDO AKAN DATANG ════════════════ --}}
        @if ($akanDatang->count())
            <div class="un-navMenu-default pt-3 pb-0">
                <div class="sub-title-pkg py-0">
                    <h2>Katsudo Akan Datang</h2>
                </div>
            </div>

            <div class="unSwiper-cards bg-white py-3">
                <div class="content-cards-NFTs">
                    <div class="swiper cardGradual">
                        <div class="swiper-wrapper">
                            @foreach ($akanDatang as $k)
                                <div class="swiper-slide">
                                    <div class="item-card-gradual">
                                        <a href="{{ route('katsudo.show', $k->id) }}" class="body-card">
                                            <div class="cover-nft">
                                                <picture>
                                                    <img class="img-cover" src="{{ $cover($k) }}" alt="{{ $k->nama }}">
                                                </picture>
                                                <div class="countdown-time">
                                                    <span>{{ $k->tgl_laksana->isoFormat('D MMM') }}</span>
                                                </div>
                                            </div>
                                            <div class="title-card-nft">
                                                <div class="side-one">
                                                    <h2>{{ $k->nama }}</h2>
                                                    <p>{{ optional($k->dpt)->nama ?? 'Umum' }}</p>
                                                </div>
                                            </div>
                                            <div class="creator-name">
                                                <div class="image-user">
                                                    <picture>
                                                        <img class="img-avatar" src="{{ $pjFoto($k) }}" alt="">
                                                    </picture>
                                                    <div class="icon">
                                                        <i class="ri-checkbox-circle-fill"></i>
                                                    </div>
                                                </div>
                                                <h3>{{ optional($k->pj)->NamaLengkap ?? 'Panitia' }}</h3>
                                            </div>
                                        </a>
                                        <div class="footer-card">
                                            <div class="starting-bad">
                                                <h4>{{ $k->tgl_laksana->isoFormat('HH:mm') }} WIB</h4>
                                                <span>{{ $k->tgl_laksana->isoFormat('dddd') }}</span>
                                            </div>
                                            <a href="{{ route('katsudo.show', $k->id) }}" class="btn-like-click">
                                                <div class="btnLike">
                                                    <i class="ri-arrow-right-line"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- ════════════════ KATSUDO SEBELUMNYA ════════════════ --}}
        <div class="un-navMenu-default pt-3 pb-0">
            <div class="sub-title-pkg py-0">
                <h2>Katsudo Sebelumnya</h2>
            </div>
        </div>

        <div class="un-blog-list bg-white py-3">
            <div class="content">
                <ul class="nav flex-column">
                    @forelse ($sebelumnya as $k)
                        <article class="nav-item">
                            <a class="nav-link" href="{{ route('katsudo.show', $k->id) }}">
                                <div class="image-blog">
                                    <picture>
                                        <img src="{{ $cover($k) }}" alt="{{ $k->nama }}">
                                    </picture>
                                    <div class="text-blog">
                                        <h2>{{ $k->nama }}</h2>
                                        <div class="others">
                                            <div class="time">
                                                <i class="ri-calendar-line"></i>
                                                <span>{{ $k->tgl_laksana->isoFormat('D MMM YYYY') }}</span>
                                            </div>
                                            <div class="views">
                                                <i class="ri-group-line"></i>
                                                <span>{{ $k->kehadirans->where('status_absen', 'hadir')->count() }} hadir</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </article>
                    @empty
                        <div class="item-empty text-center py-4">
                            <i class="ri-history-line size-30 opacity-50"></i>
                            <p class="size-14 opacity-75 mb-0 mt-2">Belum ada riwayat katsudo.</p>
                        </div>
                    @endforelse
                </ul>
            </div>
        </div>

    </div>
    <!-- End.content-comp -->
</section>

<script>
    // Countdown sederhana untuk katsudo terdekat
    (function () {
        var el = document.querySelector('.js-countdown');
        if (!el) return;
        var target = new Date(el.getAttribute('data-target')).getTime();
        var fallback = el.textContent.trim();

        function tick() {
            var diff = target - Date.now();
            if (diff <= 0) {
                el.textContent = 'Berlangsung';
                return;
            }
            var d = Math.floor(diff / 86400000);
            var h = Math.floor((diff % 86400000) / 3600000);
            var m = Math.floor((diff % 3600000) / 60000);
            var s = Math.floor((diff % 60000) / 1000);
            if (d > 0) {
                el.textContent = d + 'H ' + h + 'J';
            } else {
                el.textContent =
                    String(h).padStart(2, '0') + 'J ' +
                    String(m).padStart(2, '0') + 'M ' +
                    String(s).padStart(2, '0') + 'D';
            }
        }
        tick();
        setInterval(tick, 1000);
    })();
</script>

@include('katsudo.layouts.footer')
