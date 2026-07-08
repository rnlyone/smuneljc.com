@include('katsudo.layouts.header')

<section class="un-page-components">
    <div class="padding-20">

        @if(session('error'))
            <div class="alert alert-danger rounded-15 py-2 mb-3">{{ session('error') }}</div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h2 class="mb-0">Katsudo Divisi</h2>
                <p class="size-13 color-text mb-0">{{ auth('pendaftar')->user()->dpt->nama ?? '' }}</p>
            </div>
            @if($hasRekomendasi)
                <a href="{{ route('katsudo.create') }}" class="btn bg-primary color-white rounded-pill px-3 size-13">
                    <i class="ri-add-line"></i> Buat
                </a>
            @else
                <a href="{{ route('ktd.rekomendasi') }}" class="btn btn-outline-secondary rounded-pill px-3 size-13">
                    <i class="ri-key-line"></i> Rekomendasi
                </a>
            @endif
        </div>

        @if(!$hasRekomendasi)
            <div class="alert alert-warning rounded-15 py-2 mb-3 size-13">
                Belum ada rekomendasi aktif dari Kaichō. Minta rekomendasi untuk membuat katsudo baru.
            </div>
        @endif

        @forelse($katsudos as $k)
            <a href="{{ route('katsudo.show', $k->id) }}" class="text-decoration-none">
                <div class="item-card-nft rounded-15 p-3 mb-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-1">{{ $k->nama }}</h6>
                            <p class="size-12 color-text mb-1">
                                <i class="ri-calendar-line me-1"></i>{{ \Carbon\Carbon::parse($k->tgl_laksana)->isoFormat('D MMM YYYY, HH:mm') }}
                            </p>
                            <p class="size-12 opacity-50 mb-0">{{ Str::limit($k->deskripsi, 60) }}</p>
                        </div>
                        <span class="badge ms-2 flex-shrink-0
                            @if($k->absensi_fase === 'belum') bg-label-secondary
                            @elseif(in_array($k->absensi_fase, ['masuk','keluar'])) bg-success
                            @else bg-label-dark @endif">
                            {{ $k->absensi_fase === 'belum' ? 'Belum Mulai' : ($k->absensi_fase === 'selesai' ? 'Selesai' : strtoupper($k->absensi_fase)) }}
                        </span>
                    </div>
                </div>
            </a>
        @empty
            <div class="text-center opacity-50 py-5">
                <i class="ri-calendar-event-line" style="font-size:2rem;"></i>
                <p class="size-14 mt-2">Belum ada katsudo untuk divisi ini.</p>
            </div>
        @endforelse

    </div>
    <div class="space-sticky-footer"></div>
</section>

@include('katsudo.layouts.footer')
