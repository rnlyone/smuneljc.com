@include('katsudo.layouts.header')

{{-- ── Full-screen camera ────────────────────────────────────────────── --}}
<div id="reader"></div>

{{-- ── Bottom Sheet ─────────────────────────────────────────────────── --}}
<div id="bottom-sheet">
    {{-- Drag handle --}}
    <div id="sheet-handle">
        <span class="sheet-handle-bar"></span>
    </div>

    {{-- Content --}}
    <div class="padding-20 pt-0 pb-4">

        {{-- Katsudo info (hidden until first scan) --}}
        <div id="katsudo-info-card" class="item-card-nft rounded-15 p-3 mb-3 d-none">
            <div class="d-flex align-items-start gap-3">
                <div class="icon bg-blue-1 color-blue rounded-circle p-2 flex-shrink-0">
                    <i class="ri-calendar-event-line fs-5"></i>
                </div>
                <div class="flex-grow-1 min-w-0">
                    <h6 id="info-katsudo-nama" class="mb-1 text-truncate">—</h6>
                    <p id="info-katsudo-tgl" class="size-12 color-text mb-1">—</p>
                    <div class="d-flex gap-2 flex-wrap align-items-center">
                        <span id="info-katsudo-dept" class="badge bg-label-primary size-11">—</span>
                        <span id="info-katsudo-fase-badge" class="badge size-11">—</span>
                    </div>
                    <p id="info-katsudo-deskripsi" class="size-12 color-text mt-2 mb-0" style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"></p>
                </div>
            </div>
        </div>

        {{-- Last scan result --}}
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
    z-index: 1;
    background: #000;
}
#reader video,
#reader canvas {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    position: absolute !important;
    inset: 0 !important;
}
#reader__scan_region {
    position: absolute !important;
    inset: 0 !important;
    width: 100% !important;
    height: 100% !important;
    overflow: hidden;
}
/* Hide html5-qrcode default controls */
#reader__dashboard          { display: none !important; }
#reader__header_message     { display: none !important; }

/* ── Bottom Sheet ─────────────────────────────────────────────── */
#bottom-sheet {
    --peek: 148px;          /* handle(28) + card(96) + padding(24) */
    position: fixed;
    bottom: 0; left: 0; right: 0;
    z-index: 500;
    background: var(--bs-body-bg, #fff);
    border-radius: 20px 20px 0 0;
    box-shadow: 0 -6px 32px rgba(0, 0, 0, .22);
    transform: translateY(calc(100% - var(--peek)));
    transition: transform .38s cubic-bezier(.32, .72, 0, 1);
    max-height: 82vh;
    overflow-y: auto;
    overscroll-behavior: contain;
}
body[data-theme="dark"] #bottom-sheet,
.dark-mode #bottom-sheet { background: var(--bs-dark, #1a1a1a); }

#bottom-sheet.is-open { transform: translateY(0); }

/* Handle */
#sheet-handle {
    display: flex;
    justify-content: center;
    padding: 12px 20px 8px;
    cursor: grab;
    user-select: none;
    -webkit-user-select: none;
}
.sheet-handle-bar {
    display: block;
    width: 36px; height: 4px;
    background: rgba(127, 127, 127, .35);
    border-radius: 2px;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
<script>
/* ── Bottom Sheet drag ─────────────────────────────────────────── */
(function () {
    const sheet    = document.getElementById('bottom-sheet');
    const handle   = document.getElementById('sheet-handle');
    let startY, startTY, dragging = false;

    function currentTY() {
        return new DOMMatrix(getComputedStyle(sheet).transform).m42;
    }

    handle.addEventListener('touchstart', e => {
        startY  = e.touches[0].clientY;
        startTY = currentTY();
        dragging = true;
        sheet.style.transition = 'none';
    }, { passive: true });

    window.addEventListener('touchmove', e => {
        if (!dragging) return;
        const dy  = e.touches[0].clientY - startY;
        const newY = Math.max(0, startTY + dy);
        sheet.style.transform = `translateY(${newY}px)`;
    }, { passive: true });

    window.addEventListener('touchend', () => {
        if (!dragging) return;
        dragging = false;
        sheet.style.transition = '';
        const maxY = sheet.offsetHeight - parseInt(getComputedStyle(sheet).getPropertyValue('--peek'));
        if (currentTY() > maxY * 0.45) {
            sheet.classList.remove('is-open');
            sheet.style.transform = '';
        } else {
            sheet.classList.add('is-open');
            sheet.style.transform = '';
        }
    });

    // Tap handle toggles
    handle.addEventListener('click', () => {
        sheet.style.transform = '';
        sheet.classList.toggle('is-open');
    });

    window._openSheet = () => { sheet.style.transform = ''; sheet.classList.add('is-open'); };
})();

/* ── QR Scanner ────────────────────────────────────────────────── */
const csrfToken  = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
let lastPayload  = '';
let lastScanTime = 0;
const DEBOUNCE_MS = 3000;

new Html5Qrcode('reader').start(
    { facingMode: 'environment' },
    { fps: 10, qrbox: { width: 220, height: 220 } },
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

            /* Auto-expand sheet on every scan response */
            window._openSheet();
        })
        .catch(function () {
            showToast('error', 'Gagal menghubungi server.');
        });
    },
    function onScanFailure() { /* abaikan frame tanpa QR */ }
).catch(function (err) {
    document.getElementById('reader').innerHTML =
        '<p style="color:#fff;text-align:center;padding-top:40vh;">Kamera tidak dapat diakses.<br><small>' + err + '</small></p>';
});

function showToast(type, message) {
    const toastId = type === 'error' ? 'Toasterscangagal' : 'Toasterscansukses';
    const textId  = type === 'error' ? 'Toasterscangagaltext' : 'Toasterscansuksestext';
    document.getElementById(textId).innerHTML = message;
    bootstrap.Toast.getOrCreateInstance(document.getElementById(toastId), { autohide: true, delay: 3500 }).show();
}
</script>
