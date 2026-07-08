@include('katsudo.layouts.header')

<section class="un-page-components">
    <div class="padding-20">

        {{-- Flash messages --}}
        @if(session('rek_success'))
            <div class="alert alert-success py-2 mb-3 rounded-15">{{ session('rek_success') }}</div>
        @endif
        @if(session('rek_error'))
            <div class="alert alert-danger py-2 mb-3 rounded-15">{{ session('rek_error') }}</div>
        @endif

        @if($isKaicho)
        {{-- ── KAICHO VIEW ──────────────────────────────────────────── --}}
        <div class="title-page mb-3">
            <h2 class="mb-1">Rekomendasi Katsudo</h2>
            <p class="color-text size-14 mb-0">Sebagai Kaichō, kamu dapat memberikan rekomendasi kepada divisi untuk membuat katsudo.</p>
        </div>

        <div class="card rounded-15 mb-4">
            <div class="card-body">
                <h6 class="mb-3">Beri Rekomendasi</h6>
                <form action="{{ route('ktd.rekomendasi.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label size-14">Divisi</label>
                        <select name="id_departemen" class="form-select" required>
                            <option value="">-- pilih divisi --</option>
                            @foreach($departemens as $d)
                                <option value="{{ $d->id }}">{{ $d->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label size-14">Catatan <span class="opacity-50">(opsional)</span></label>
                        <textarea name="catatan" class="form-control" rows="2" placeholder="Instruksi khusus..."></textarea>
                    </div>
                    <button type="submit" class="btn bg-primary color-white w-100 rounded-pill">
                        <i class="ri-send-plane-line me-1"></i> Kirim Rekomendasi
                    </button>
                </form>
            </div>
        </div>

        {{-- Daftar rekomendasi --}}
        @forelse($rekomendasis as $rek)
            <div class="item-card-nft rounded-15 mb-3 p-3">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="mb-1">{{ $rek->departemen->nama ?? '—' }}</h6>
                        @if($rek->catatan)
                            <p class="size-13 color-text mb-1">{{ $rek->catatan }}</p>
                        @endif
                        <small class="opacity-50">{{ $rek->created_at->diffForHumans() }}</small>
                    </div>
                    <div class="text-end">
                        @if($rek->status === 'aktif')
                            <span class="badge bg-success mb-2 d-block">Aktif</span>
                            <a href="{{ route('ktd.rekomendasi.cabut', $rek->id) }}"
                               class="btn btn-sm btn-outline-danger rounded-pill"
                               onclick="return confirm('Cabut rekomendasi ini?')">Cabut</a>
                        @elseif($rek->status === 'digunakan')
                            <span class="badge bg-secondary">Digunakan</span>
                        @else
                            <span class="badge bg-light text-dark">Dicabut</span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center opacity-50 py-5">
                <i class="ri-clipboard-line" style="font-size:2rem;"></i>
                <p class="size-14 mt-2">Belum ada rekomendasi untuk periode ini.</p>
            </div>
        @endforelse

        @else
        {{-- ── KYOKUCHO VIEW ────────────────────────────────────────── --}}
        <div class="title-page mb-3">
            <h2 class="mb-1">Rekomendasi Divisi</h2>
            <p class="color-text size-14 mb-0">Daftar rekomendasi dari Kaichō untuk divisimu.</p>
        </div>

        @forelse($rekomendasis as $rek)
            <div class="item-card-nft rounded-15 mb-3 p-3">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="size-13 mb-1">Dari: <strong>{{ $rek->kaicho->NamaLengkap ?? '—' }}</strong></p>
                        @if($rek->catatan)
                            <p class="size-13 color-text mb-1">"{{ $rek->catatan }}"</p>
                        @endif
                        <small class="opacity-50">{{ $rek->created_at->diffForHumans() }}</small>
                    </div>
                    <div>
                        @if($rek->status === 'aktif')
                            <span class="badge bg-success">Aktif</span>
                        @elseif($rek->status === 'digunakan')
                            <span class="badge bg-secondary">Sudah Digunakan</span>
                        @else
                            <span class="badge bg-danger">Dicabut</span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center opacity-50 py-5">
                <i class="ri-mail-send-line" style="font-size:2rem;"></i>
                <p class="size-14 mt-2">Belum ada rekomendasi untuk divisimu.</p>
            </div>
        @endforelse

        @if($rekomendasis->where('status','aktif')->isNotEmpty())
            <a href="{{ route('katsudo.create') }}" class="btn bg-primary color-white w-100 rounded-pill mt-2">
                <i class="ri-add-line me-1"></i> Buat Katsudo
            </a>
        @endif
        @endif

    </div>
    <div class="space-sticky-footer"></div>
</section>

@include('katsudo.layouts.footer')
