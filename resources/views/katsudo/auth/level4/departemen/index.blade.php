@include('katsudo.layouts.headersub')

<section class="un-page-components">
    <div class="padding-20">

        @if(session('error'))
            <div class="alert alert-danger rounded-15 py-2 mb-3">{{ session('error') }}</div>
        @endif

        <div class="title-page mb-3">
            <h2 class="mb-1">{{ $thisdept->nama }}</h2>
            <p class="size-13 color-text mb-0">Dashboard Kyokuchō {{ $latestPeriode ? '· '.$latestPeriode->angkatan : '' }}</p>
        </div>

        {{-- ── Ringkasan Katsudo ─────────────────────────────────────── --}}
        <div class="d-flex gap-2 mb-4">
            <div class="item-card-nft rounded-15 p-3 flex-fill text-center">
                <h4 class="mb-0">{{ $totalKatsudo }}</h4>
                <p class="size-11 color-text mb-0">Total Katsudo</p>
            </div>
            <div class="item-card-nft rounded-15 p-3 flex-fill text-center">
                <h4 class="mb-0">{{ $katsudoAkanDatang }}</h4>
                <p class="size-11 color-text mb-0">Akan Datang</p>
            </div>
            <div class="item-card-nft rounded-15 p-3 flex-fill text-center">
                <h4 class="mb-0">{{ $katsudoSelesai }}</h4>
                <p class="size-11 color-text mb-0">Selesai</p>
            </div>
        </div>

        {{-- ── Aksi Cepat ────────────────────────────────────────────── --}}
        <div class="d-flex gap-2 mb-4 flex-wrap">
            <a href="{{ route('katsudo.divisi') }}" class="btn btn-outline-primary rounded-pill px-3 size-13">
                <i class="ri-list-check-2 me-1"></i> Katsudo Divisi
            </a>
            @if($hasRekomendasi)
                <a href="{{ route('katsudo.create') }}" class="btn bg-primary color-white rounded-pill px-3 size-13">
                    <i class="ri-add-line me-1"></i> Buat Katsudo
                </a>
            @else
                <a href="{{ route('ktd.rekomendasi') }}" class="btn btn-outline-secondary rounded-pill px-3 size-13">
                    <i class="ri-key-line me-1"></i> Rekomendasi
                </a>
            @endif
        </div>

        {{-- ── Keaktifan Anggota ─────────────────────────────────────── --}}
        <h6 class="mb-2">Keaktifan Anggota {{ $latestPeriode ? '· '.$latestPeriode->angkatan : '' }}</h6>

        @forelse($anggotaStats as $stat)
            <div class="item-card-nft rounded-15 p-3 mb-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-0 size-14">{{ $stat['anggota']->NamaLengkap }}</p>
                        <p class="size-11 color-text mb-0">
                            <i class="ri-checkbox-circle-line color-green me-1"></i>{{ $stat['hadir'] }} hadir
                            &nbsp;·&nbsp;
                            <i class="ri-close-circle-line color-red me-1"></i>{{ $stat['absen'] }} absen
                        </p>
                    </div>
                    @if($stat['absen_berturut'] >= 2)
                        <span class="badge bg-danger size-11">{{ $stat['absen_berturut'] }}x berturut</span>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center opacity-50 py-5">
                <i class="ri-team-line" style="font-size:2rem;"></i>
                <p class="size-14 mt-2">Belum ada anggota di departemen ini.</p>
            </div>
        @endforelse

    </div>
    <div class="space-sticky-footer"></div>
</section>

@include('katsudo.layouts.footer')
