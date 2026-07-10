@include('katsudo.layouts.headersub')

@php
    $defaultCover = '/images/katsudo_merah.svg';

    // Cari file .png di public/images berdasarkan nama departemen, fallback SVG default
    $imgByName = function ($nama) use ($defaultCover) {
        if ($nama) {
            foreach (['images/dept/' . $nama . '.png', 'images/' . $nama . '.png'] as $rel) {
                if (is_file(public_path($rel))) {
                    return '/' . $rel;
                }
            }
        }
        return $defaultCover;
    };
    $cover     = fn ($k) => $imgByName(optional($k->dpt)->nama ?: optional($thisdept)->nama);
    $deptCover = $imgByName(optional($thisdept)->nama);
    $pjFoto = function ($k) {
        $pj = $k->pj;
        if (!$pj) return '/images/itsupp.png';
        if ($pj->foto_anggota && $pj->foto_anggota != 'default.jpg') {
            return \Illuminate\Support\Facades\Storage::disk('public')->url($pj->foto_anggota);
        }
        return $pj->JK == 'wanita' ? '/images/itsukipp.png' : '/images/itsupp.png';
    };
@endphp

<section class="un-page-components">
    <div class="un-title-default">
        <div class="text">
            <h2>Departemen {{ $thisdept->nama }}</h2>
            <p>Kegiatan Departemen {{ $thisdept->nama }}</p>
        </div>
    </div>
    <div class="content-comp p-0">

        <div class="space-items"></div>

        {{-- ════════════ KARTU DEPARTEMEN ════════════ --}}
        <div class="discover-nft-random bg-white py-3">
            <div class="content-NFTs-body">
                <div class="item-card-nft">
                    <picture>
                        <img class="big-image" src="{{ $deptCover }}" alt="{{ $thisdept->nama }}"
                             onerror="this.onerror=null;this.src='{{ $defaultCover }}';">
                    </picture>
                    <div class="btn-like-click">
                        <div class="btnLike">
                            <span class="count-likes">{{ $thisdept->anggotas->count() }}</span>
                            <i class="ri-user-fill"></i>
                        </div>
                    </div>
                    <div class="un-info-card visited">
                        <div class="block-left">
                            <h4>{{ $thisdept->nama }}</h4>
                            <div class="user">
                                <picture>
                                    <img class="img-avatar" src="/images/avatar/{{ $kyokuchopp }}" alt="">
                                </picture>
                                <h5>{{ optional($thisdept->koor)->NamaLengkap ?? 'Kyokuchō' }}</h5>
                            </div>
                        </div>
                        <div class="block-right">
                            <h6>Kegiatan</h6>
                            <p>{{ $thisdept->katsudos->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-items"></div>

        {{-- ════════════ KATSUDO TERDEKAT ════════════ --}}
        <div class="un-navMenu-default pt-3 pb-0">
            <div class="sub-title-pkg py-0">
                <h2>Katsudo Terdekat!</h2>
            </div>
        </div>

        <div class="bg-white padding-20">
            @if ($deptTerdekat)
                <div class="item-card-gradual">
                    <a href="{{ route('katsudo.show', $deptTerdekat->id) }}" class="body-card">
                        <div class="cover-nft">
                            <picture>
                                <img class="img-cover" src="{{ $cover($deptTerdekat) }}" alt="{{ $deptTerdekat->nama }}"
                                     onerror="this.onerror=null;this.src='{{ $defaultCover }}';">
                            </picture>
                            <div class="icon-type">
                                <i class="ri-calendar-event-line"></i>
                            </div>
                            <div class="countdown-time">
                                <span>{{ $deptTerdekat->tgl_laksana->isoFormat('D MMM') }}</span>
                            </div>
                        </div>
                        <div class="title-card-nft">
                            <div class="side-one">
                                <h2>{{ $deptTerdekat->nama }}</h2>
                                <p>{{ $thisdept->nama }}</p>
                            </div>
                            <div class="side-other">
                                <span class="no-sales">Terjadwal</span>
                            </div>
                        </div>
                        <div class="creator-name">
                            <div class="image-user">
                                <picture>
                                    <img class="img-avatar" src="{{ $pjFoto($deptTerdekat) }}" alt="">
                                </picture>
                                <div class="icon">
                                    <i class="ri-checkbox-circle-fill"></i>
                                </div>
                            </div>
                            <h3>{{ optional($deptTerdekat->pj)->NamaLengkap ?? 'Panitia' }}</h3>
                        </div>
                    </a>
                    <div class="footer-card">
                        <div class="starting-bad">
                            <h4>{{ $deptTerdekat->tgl_laksana->isoFormat('dddd, D MMM YYYY') }}</h4>
                            <span>{{ $deptTerdekat->tgl_laksana->isoFormat('HH:mm') }} WIB</span>
                        </div>
                        <a href="{{ route('katsudo.show', $deptTerdekat->id) }}" class="btn-like-click">
                            <div class="btnLike">
                                <i class="ri-arrow-right-line"></i>
                            </div>
                        </a>
                    </div>
                </div>
            @else
                <div class="item-empty text-center py-4">
                    <i class="ri-calendar-todo-line size-30 opacity-50"></i>
                    <p class="size-14 opacity-75 mb-0 mt-2">Belum ada katsudo terjadwal di departemen ini.</p>
                </div>
            @endif
        </div>

        {{-- ════════════ KATSUDO AKAN DATANG ════════════ --}}
        @if ($deptAkanDatang->count())
            <div class="un-navMenu-default pt-3 pb-0">
                <div class="sub-title-pkg py-0">
                    <h2>Katsudo Akan Datang</h2>
                </div>
            </div>

            <div class="unSwiper-cards bg-white py-3">
                <div class="content-cards-NFTs">
                    <div class="swiper cardGradual">
                        <div class="swiper-wrapper">
                            @foreach ($deptAkanDatang as $k)
                                <div class="swiper-slide">
                                    <div class="item-card-gradual">
                                        <a href="{{ route('katsudo.show', $k->id) }}" class="body-card">
                                            <div class="cover-nft">
                                                <picture>
                                                    <img class="img-cover" src="{{ $cover($k) }}" alt="{{ $k->nama }}"
                                                         onerror="this.onerror=null;this.src='{{ $defaultCover }}';">
                                                </picture>
                                                <div class="countdown-time">
                                                    <span>{{ $k->tgl_laksana->isoFormat('D MMM') }}</span>
                                                </div>
                                            </div>
                                            <div class="title-card-nft">
                                                <div class="side-one">
                                                    <h2>{{ $k->nama }}</h2>
                                                    <p>{{ $thisdept->nama }}</p>
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

        {{-- ════════════ KATSUDO SEBELUMNYA ════════════ --}}
        <div class="un-navMenu-default pt-3 pb-0">
            <div class="sub-title-pkg py-0">
                <h2>Katsudo Sebelumnya</h2>
            </div>
        </div>

        <div class="un-blog-list bg-white py-3">
            <div class="content">
                <ul class="nav flex-column">
                    @forelse ($deptSebelumnya as $k)
                        <article class="nav-item">
                            <a class="nav-link" href="{{ route('katsudo.show', $k->id) }}">
                                <div class="image-blog">
                                    <picture>
                                        <img src="{{ $cover($k) }}" alt="{{ $k->nama }}"
                                             onerror="this.onerror=null;this.src='{{ $defaultCover }}';">
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

@include('katsudo.layouts.footer')
