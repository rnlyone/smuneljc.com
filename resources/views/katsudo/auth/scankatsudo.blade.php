@include('katsudo.layouts.header')

<div id="reader" style="width:100%;max-width:500px;margin:0 auto;"></div>
<p id="scanned-result" style="font-size:8px;color:var(--secondary);font-weight:400;margin:0;text-align:center;"></p>

<section class="un-page-components">
    <div class="padding-20 pt-3">

        {{-- ── Info Katsudo (muncul setelah scan pertama) ──────────── --}}
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
                    <p id="info-katsudo-deskripsi" class="size-12 color-text mt-2 mb-0 text-truncate" style="max-width:100%;">—</p>
                </div>
            </div>
        </div>

        {{-- ── Hasil scan terakhir ─────────────────────────────────── --}}
        <div id="last-scan-card" class="item-card-nft rounded-15 p-3">
            <div class="d-flex align-items-center gap-3">
                <div id="scan-icon" class="icon bg-snow rounded-circle p-2 flex-shrink-0" style="transition:background .3s">
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
    <div class="space-sticky-footer"></div>
</section>



<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center place__top w-100">
    <div id="Toasterscangagal" class="toast bg-danger" role="alert" aria-live="assertive" aria-atomic="true"
        data-bs-autohide="true" data-bs-delay="3000">
        <div class="toast-body">
            <div class="icon color-white">
                <i class="ri-error-warning-fill"></i>
            </div>
            <div class="content">
                <div class="display__text">
                    <p id="Toasterscangagaltext" class="text-white"></p>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close">
                <i class="ri-close-fill"></i>
            </button>
        </div>
    </div>
</div>

<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center place__top w-100">
    <div id="Toasterscansukses" class="toast bg-success" role="alert" aria-live="assertive" aria-atomic="true"
        data-bs-autohide="true" data-bs-delay="3000">
        <div class="toast-body">
            <div class="icon color-white">
                <i class="ri-error-warning-fill"></i>
            </div>
            <div class="content">
                <div class="display__text">
                    <p id="Toasterscansuksestext" class="text-white"></p>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close">
                <i class="ri-close-fill"></i>
            </button>
        </div>
    </div>
</div>




@include('katsudo.layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let lastPayload  = '';
    let lastScanTime = 0;
    const DEBOUNCE_MS = 3000;

    const html5QrCode = new Html5Qrcode('reader');

    html5QrCode.start(
        { facingMode: 'environment' },
        { fps: 10, qrbox: { width: 250, height: 250 } },
        function onScanSuccess(content) {
            const now = Date.now();
            if (content === lastPayload && now - lastScanTime < DEBOUNCE_MS) return;
            lastPayload  = content;
            lastScanTime = now;

            document.getElementById('scanned-result').textContent = content;

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
                // ── Update katsudo info card (jika ada data) ──────────
                if (response.katsudo_nama) {
                    document.getElementById('info-katsudo-nama').textContent      = response.katsudo_nama;
                    document.getElementById('info-katsudo-tgl').textContent       = response.katsudo_tgl || '—';
                    document.getElementById('info-katsudo-dept').textContent      = response.katsudo_dept || '—';
                    document.getElementById('info-katsudo-deskripsi').textContent = response.katsudo_deskripsi || '';
                    const faseBadge = document.getElementById('info-katsudo-fase-badge');
                    const fase      = response.katsudo_fase || '';
                    faseBadge.textContent  = fase === 'masuk' ? 'Fase Masuk' : fase === 'keluar' ? 'Fase Keluar' : fase;
                    faseBadge.className    = 'badge size-11 ' + (fase === 'masuk' ? 'bg-primary' : fase === 'keluar' ? 'bg-warning' : 'bg-secondary');
                    document.getElementById('katsudo-info-card').classList.remove('d-none');
                }

                // ── Update last-scan card ─────────────────────────────
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
                    document.getElementById('namapengguna').textContent    = response.nama || '—';
                    document.getElementById('usernamepengguna').textContent = response.message;
                    const isInfo = response.status === 'info';
                    iconEl.className  = isInfo
                        ? 'icon bg-orange-1 color-orange rounded-circle p-2 flex-shrink-0'
                        : 'icon bg-red-1 color-red rounded-circle p-2 flex-shrink-0';
                    iconEl.innerHTML  = isInfo
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
        },
        function onScanFailure() { /* abaikan frame tanpa QR */ }
    ).catch(function (err) {
        document.getElementById('reader').innerHTML =
            '<p class="text-danger text-center p-3">Kamera tidak dapat diakses: ' + err + '</p>';
    });

    function showToast(type, message) {
        const toastId = type === 'error' ? 'Toasterscangagal' : 'Toasterscansukses';
        const textId  = type === 'error' ? 'Toasterscangagaltext' : 'Toasterscansuksestext';
        document.getElementById(textId).innerHTML = message;
        const toastEl = document.getElementById(toastId);
        bootstrap.Toast.getOrCreateInstance(toastEl, { autohide: true, delay: 3500 }).show();
    }
</script>

