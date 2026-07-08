@include('katsudo.layouts.header')

<section class="un-page-components">
    <div class="padding-20">

        {{-- Flash --}}
        @if(session('success'))
            <div class="alert alert-success rounded-15 mb-3 py-2">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger rounded-15 mb-3 py-2">{{ session('error') }}</div>
        @endif

        <div class="title-page mb-3">
            <h2 class="mb-1">{{ $katsudo->nama }}</h2>
            <p class="size-13 color-text mb-0">
                <i class="ri-calendar-line me-1"></i>{{ \Carbon\Carbon::parse($katsudo->tgl_laksana)->isoFormat('D MMMM YYYY, HH:mm') }}
                &nbsp;·&nbsp;{{ $katsudo->dpt->nama ?? '—' }}
            </p>
        </div>

        {{-- Deskripsi --}}
        <div class="item-card-nft rounded-15 p-3 mb-4">
            <p class="size-14 mb-0">{{ $katsudo->deskripsi }}</p>
        </div>

        {{-- Divisi undangan --}}
        <div class="mb-4">
            <p class="size-13 opacity-75 mb-1">Divisi Diundang:</p>
            @if($katsudo->divisi_undangan === null)
                <span class="badge bg-label-primary">Semua Divisi</span>
            @else
                @foreach($katsudo->divisi_undangan as $deptId)
                    @php $d = \App\Models\Departemen::find($deptId); @endphp
                    @if($d)
                        <span class="badge bg-label-secondary me-1">{{ $d->nama }}</span>
                    @endif
                @endforeach
            @endif
        </div>

        @if($isPj)
        {{-- ─── QR ATTENDANCE PANEL (kyokucho only) ─────────────────── --}}
        <div class="card rounded-15 mb-4">
            <div class="card-body text-center">

                @if($katsudo->absensi_fase === 'belum')
                    <p class="size-14 color-text mb-3">Absensi belum dimulai.</p>
                    <a href="{{ route('katsudo.mulai', $katsudo->id) }}"
                       class="btn bg-primary color-white rounded-pill px-4">
                        <i class="ri-play-circle-line me-1"></i> Mulai Absensi Masuk
                    </a>

                @elseif(in_array($katsudo->absensi_fase, ['masuk','keluar']))
                    {{-- QR Code --}}
                    <p class="size-12 opacity-50 mb-1">
                        Fase: <strong>{{ strtoupper($katsudo->absensi_fase) }}</strong>
                        &nbsp;·&nbsp; QR refresh tiap 5 detik
                    </p>
                    <div id="qrcode" class="mx-auto mb-3" style="width:220px;height:220px;"></div>
                    <p id="countdown" class="size-12 opacity-50 mb-3">Refresh dalam <span id="timer">5</span>s</p>

                    <div class="d-flex gap-2 justify-content-center flex-wrap">
                        @if($katsudo->absensi_fase === 'masuk')
                            <a href="{{ route('katsudo.switch', $katsudo->id) }}"
                               class="btn btn-outline-primary rounded-pill px-3">
                                <i class="ri-logout-box-line me-1"></i> Beralih ke Keluar
                            </a>
                        @endif
                        <a href="{{ route('katsudo.selesai', $katsudo->id) }}"
                           class="btn btn-outline-danger rounded-pill px-3"
                           onclick="return confirm('Akhiri absensi dan update keaktifan semua anggota yang diundang?')">
                            <i class="ri-stop-circle-line me-1"></i> Selesai Absensi
                        </a>
                    </div>

                @elseif($katsudo->absensi_fase === 'selesai')
                    <p class="size-14 color-success mb-0">
                        <i class="ri-checkbox-circle-line me-1"></i> Absensi sudah selesai.
                    </p>
                @endif

            </div>
        </div>
        @endif

        {{-- ─── Daftar kehadiran ───────────────────────────────────────── --}}
        <h6 class="mb-2">Daftar Kehadiran ({{ $kehadirans->count() }})</h6>
        @forelse($kehadirans as $kh)
            <div class="d-flex justify-content-between align-items-center item-card-nft rounded-15 px-3 py-2 mb-2">
                <div>
                    <p class="mb-0 size-14">{{ $kh->anggota->NamaLengkap ?? '—' }}</p>
                    @if($kh->masuk_at)
                        <small class="opacity-50">Masuk: {{ $kh->masuk_at->format('H:i') }}
                        @if($kh->keluar_at) · Keluar: {{ $kh->keluar_at->format('H:i') }} @endif
                        </small>
                    @endif
                </div>
                <span class="badge
                    @if($kh->status_absen === 'hadir') bg-success
                    @elseif($kh->status_absen === 'absen') bg-danger
                    @elseif($kh->status_absen === 'izin') bg-warning
                    @else bg-info @endif">
                    {{ $kh->status_absen }}
                </span>
            </div>
        @empty
            <p class="size-13 opacity-50 text-center py-3">Belum ada kehadiran tercatat.</p>
        @endforelse

    </div>
    <div class="space-sticky-footer"></div>
</section>

@if(in_array($katsudo->absensi_fase, ['masuk','keluar']))
{{-- QR Code auto-refresh --}}
<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
<script>
const katsudoId  = {{ $katsudo->id }};
const csrfToken  = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
let currentPayload = "KATSUDO:{{ $katsudo->id }}:{{ $katsudo->token }}:{{ $katsudo->absensi_fase }}";
let qr = null;

function renderQR(payload) {
    const el = document.getElementById('qrcode');
    el.innerHTML = '';
    qr = new QRCode(el, {
        text: payload,
        width: 220,
        height: 220,
        correctLevel: QRCode.CorrectLevel.M,
    });
}

renderQR(currentPayload);

let seconds = 5;
const timerEl = document.getElementById('timer');

setInterval(function () {
    seconds--;
    if (timerEl) timerEl.textContent = seconds;

    if (seconds <= 0) {
        seconds = 5;
        fetch("{{ route('katsudo.token', $katsudo->id) }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            }
        })
        .then(r => r.json())
        .then(data => {
            if (data.payload) {
                currentPayload = data.payload;
                renderQR(currentPayload);
            }
        })
        .catch(() => {});
    }
}, 1000);
</script>
@endif

@include('katsudo.layouts.footer')
