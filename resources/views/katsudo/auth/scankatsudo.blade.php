@include('katsudo.layouts.header')

{{-- ── Full-screen camera ────────────────────────────────────────────── --}}
<div id="reader"></div>

{{-- ── Panel Info Statis (di bawah stack bottom-navmenu) ─────────────── --}}
<div id="scan-panel">
    <div class="padding-20 pt-3 pb-2">

        {{-- Katsudo info — statis, selalu tampil --}}
        <div id="katsudo-info-card" class="item-card-nft rounded-15 p-3 mb-3">
            <div class="d-flex align-items-start gap-3">
                <div class="icon bg-blue-1 color-blue rounded-circle p-2 flex-shrink-0">
                    <i class="ri-calendar-event-line fs-5"></i>
                </div>
                <div class="flex-grow-1 min-w-0">
                    <h6 id="info-katsudo-nama" class="mb-1 text-truncate">Belum ada kegiatan</h6>
                    <p id="info-katsudo-tgl" class="size-12 color-text mb-1">Scan QR untuk memuat info kegiatan</p>
                    <div class="d-flex gap-2 flex-wrap align-items-center">
                        <span id="info-katsudo-dept" class="badge bg-label-primary size-11">—</span>
                        <span id="info-katsudo-fase-badge" class="badge size-11 bg-secondary">—</span>
                    </div>
                    <p id="info-katsudo-deskripsi" class="size-12 color-text mt-2 mb-0" style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"></p>
                </div>
            </div>
        </div>

        {{-- Status absensi — statis, selalu tampil --}}
        <div class="item-card-nft rounded-15 p-3">
            <div class="d-flex align-items-center gap-3">
                <div id="scan-icon" class="icon bg-snow rounded-circle p-2 flex-shrink-0">
                    <i class="ri-qr-scan-2-line fs-5" style="color:var(--secondary)"></i>
                </div>
                <div class="flex-grow-1">
                    <h6 id="namapengguna" class="mb-0">Arahkan kamera ke QR</h6>
                    <p id="usernamepengguna" class="size-12 color-text mb-0">Belum ada scan</p>
                </div>
                <span id="scan-status-badge" class="badge d-none"></span>
            </div>
        </div>

    </div>
</div>

{{-- ── Toasts ───────────────────────────────────────────────────────── --}}
<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center place__top w-100" style="z-index:3000;">
    <div id="Toasterscangagal" class="toast bg-danger" role="alert" aria-live="assertive" aria-atomic="true"
        data-bs-autohide="true" data-bs-delay="3000">
        <div class="toast-body">
            <div class="icon color-white"><i class="ri-error-warning-fill"></i></div>
            <div class="content">
                <div class="display__text"><p id="Toasterscangagaltext" class="text-white"></p></div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close">
                <i class="ri-close-fill"></i>
            </button>
        </div>
    </div>
</div>
<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center place__top w-100" style="z-index:3000;">
    <div id="Toasterscansukses" class="toast bg-success" role="alert" aria-live="assertive" aria-atomic="true"
        data-bs-autohide="true" data-bs-delay="3000">
        <div class="toast-body">
            <div class="icon color-white"><i class="ri-checkbox-circle-fill"></i></div>
            <div class="content">
                <div class="display__text"><p id="Toasterscansuksestext" class="text-white"></p></div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close">
                <i class="ri-close-fill"></i>
            </button>
        </div>
    </div>
</div>

@include('katsudo.layouts.footer')

<style>
/* ── Full-screen camera ───────────────────────────────────────── */
body { overflow: hidden; }

#reader {
    position: fixed;
    inset: 0;
    z-index: 5;
    width: 100vw;
    height: 100vh;
    background: #000;
    overflow: hidden;
}
#reader video {
    width: 100vw !important;
    height: 100vh !important;
    object-fit: cover !important;
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    display: block !important;
}
#reader canvas {
    object-fit: cover !important;
}
#reader__scan_region {
    position: absolute !important;
    inset: 0 !important;
    width: 100vw !important;
    height: 100vh !important;
    min-height: 100vh !important;
    overflow: hidden;
    display: flex !important;
    align-items: center;
    justify-content: center;
}
/* Sembunyikan placeholder image & overlay bawaan yang bisa menutupi video */
#reader__scan_region img,
#reader__scan_region > img { display: none !important; }
#qr-shaded-region           { display: none !important; }
/* Hide html5-qrcode default controls */
#reader__dashboard          { display: none !important; }
#reader__header_message     { display: none !important; }
#reader__status_span        { display: none !important; }

/* ── Panel Info Statis ────────────────────────────────────────── */
/* Ditempatkan tepat di atas bottom-navmenu (tinggi ±56px) dengan
   z-index di bawah navmenu (99) supaya navmenu tetap di paling atas. */
#scan-panel {
    position: fixed;
    left: 0; right: 0;
    bottom: calc(56px + env(safe-area-inset-bottom));
    z-index: 90;
    /* var(--white) flips to #222032 under [data-theme=dark] on <html>,
       same surface color used by the rest of the unic theme. */
    background: var(--white);
    border-radius: 20px 20px 0 0;
    box-shadow: 0 -6px 32px rgba(0, 0, 0, .22);
    max-height: 60vh;
    overflow-y: auto;
    overscroll-behavior: contain;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
<script>
/* ── QR Scanner ────────────────────────────────────────────────── */
const csrfToken  = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
let lastPayload  = '';
let lastScanTime = 0;
const DEBOUNCE_MS = 3000;

function showCamError(msg) {
    document.getElementById('reader').innerHTML =
        '<div style="color:#fff;text-align:center;padding:38vh 28px 0;line-height:1.5;">' +
        '<i class="ri-camera-off-line" style="font-size:32px;display:block;margin-bottom:10px;"></i>' +
        msg + '</div>';
}

function onScanSuccess(content) {
        const now = Date.now();
        if (content === lastPayload && now - lastScanTime < DEBOUNCE_MS) return;
        lastPayload  = content;
        lastScanTime = now;

        if (!content.startsWith('KATSUDO:')) {
            showToast('error', 'QR tidak dikenal.');
            return;
        }

        fetch("{{ route('scan') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({ payload: content }),
        })
        .then(r => r.json())
        .then(function (response) {
            /* ── Katsudo info card ── */
            if (response.katsudo_nama) {
                document.getElementById('info-katsudo-nama').textContent      = response.katsudo_nama;
                document.getElementById('info-katsudo-tgl').textContent       = response.katsudo_tgl  || '—';
                document.getElementById('info-katsudo-dept').textContent      = response.katsudo_dept || '—';
                document.getElementById('info-katsudo-deskripsi').textContent = response.katsudo_deskripsi || '';
                const fb   = document.getElementById('info-katsudo-fase-badge');
                const fase = response.katsudo_fase || '';
                fb.textContent = fase === 'masuk' ? 'Fase Masuk' : fase === 'keluar' ? 'Fase Keluar' : fase;
                fb.className   = 'badge size-11 ' + (fase === 'masuk' ? 'bg-primary' : fase === 'keluar' ? 'bg-warning' : 'bg-secondary');
                document.getElementById('katsudo-info-card').classList.remove('d-none');
            }

            /* ── Last scan card ── */
            const iconEl  = document.getElementById('scan-icon');
            const badgeEl = document.getElementById('scan-status-badge');

            if (response.status === 'success') {
                document.getElementById('namapengguna').textContent    = response.nama || '—';
                document.getElementById('usernamepengguna').textContent =
                    response.fase === 'masuk' ? 'Absensi Masuk ✓' : 'Absensi Keluar ✓';
                iconEl.className  = 'icon bg-green-1 color-green rounded-circle p-2 flex-shrink-0';
                iconEl.innerHTML  = '<i class="ri-user-check-line fs-5"></i>';
                badgeEl.textContent = 'Hadir';
                badgeEl.className   = 'badge bg-success';
                badgeEl.classList.remove('d-none');
                showToast('success', response.message);
            } else {
                const isInfo = response.status === 'info';
                document.getElementById('namapengguna').textContent    = response.nama || '—';
                document.getElementById('usernamepengguna').textContent = response.message;
                iconEl.className = isInfo
                    ? 'icon bg-orange-1 color-orange rounded-circle p-2 flex-shrink-0'
                    : 'icon bg-red-1 color-red rounded-circle p-2 flex-shrink-0';
                iconEl.innerHTML = isInfo
                    ? '<i class="ri-checkbox-circle-line fs-5"></i>'
                    : '<i class="ri-close-circle-line fs-5"></i>';
                badgeEl.textContent = isInfo ? 'Sudah Scan' : 'Gagal';
                badgeEl.className   = isInfo ? 'badge bg-warning' : 'badge bg-danger';
                badgeEl.classList.remove('d-none');
                showToast(isInfo ? 'success' : 'error', response.message);
            }
        })
        .catch(function () {
            showToast('error', 'Gagal menghubungi server.');
        });
}

function onScanFailure() { /* abaikan frame tanpa QR */ }

const scanConfig = { fps: 10, qrbox: { width: 220, height: 220 } };

// Paksa elemen <video> yang di-inject library mengisi layar penuh.
function forceVideoFill() {
    const v = document.querySelector('#reader video');
    if (v) {
        v.setAttribute('playsinline', 'true');
        v.style.cssText =
            'width:100vw;height:100vh;object-fit:cover;position:absolute;top:0;left:0;display:block;';
    }
}

// Kamera hanya bisa diakses di secure context (HTTPS / localhost).
if (!window.isSecureContext || !navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
    showCamError('Kamera hanya bisa diakses lewat koneksi aman.<br>' +
        'Buka aplikasi melalui <b>https://</b> (bukan http) atau di <b>localhost</b>.');
} else {
    const html5 = new Html5Qrcode('reader');

    function startWith(cameraSource) {
        return html5.start(cameraSource, scanConfig, onScanSuccess, onScanFailure)
            .then(function () {
                // Beri jeda agar <video> ter-inject lalu paksa ukurannya.
                setTimeout(forceVideoFill, 200);
                setTimeout(forceVideoFill, 800);
            });
    }

    // Pilih kamera belakang secara eksplisit (render lebih andal di HP),
    // fallback ke facingMode environment bila daftar kamera tak tersedia.
    Html5Qrcode.getCameras()
        .then(function (cameras) {
            if (cameras && cameras.length) {
                const back = cameras.find(function (c) {
                    return /back|rear|environment|belakang/i.test(c.label);
                }) || cameras[cameras.length - 1];

                startWith(back.id).catch(function () {
                    startWith({ facingMode: 'environment' }).catch(function (err) {
                        showCamError('Kamera tidak dapat diakses.<br><small>' + err + '</small>');
                    });
                });
            } else {
                startWith({ facingMode: 'environment' }).catch(function (err) {
                    showCamError('Tidak ada kamera terdeteksi.<br><small>' + err + '</small>');
                });
            }
        })
        .catch(function () {
            // getCameras butuh izin; coba langsung facingMode.
            startWith({ facingMode: 'environment' }).catch(function (err) {
                showCamError('Izin kamera ditolak atau tidak tersedia.<br><small>' + err + '</small>');
            });
        });
}

function showToast(type, message) {
    const toastId = type === 'error' ? 'Toasterscangagal' : 'Toasterscansukses';
    const textId  = type === 'error' ? 'Toasterscangagaltext' : 'Toasterscansuksestext';
    document.getElementById(textId).innerHTML = message;
    bootstrap.Toast.getOrCreateInstance(document.getElementById(toastId), { autohide: true, delay: 3500 }).show();
}
</script>
