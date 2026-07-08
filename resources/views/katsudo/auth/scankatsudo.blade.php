@include('katsudo.layouts.header')

<div id="reader" style="width:100%;max-width:500px;margin:0 auto;"></div>
<p id="scanned-result" style="font-size:8px;color:var(--secondary);font-weight:400;margin:0;text-align:center;"></p>

<section class="un-page-components">
    <div class="padding-20 pt-3">
        <div class="card rounded-15 p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon bg-green-1 color-green rounded-circle p-2">
                    <i class="ri-user-check-line fs-5"></i>
                </div>
                <div>
                    <h6 id="namapengguna" class="mb-0">—</h6>
                    <p id="usernamepengguna" class="size-12 color-text mb-0">Belum ada scan</p>
                </div>
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
                if (response.status === 'success') {
                    document.getElementById('namapengguna').textContent = response.nama || '—';
                    document.getElementById('usernamepengguna').textContent =
                        'Absensi ' + (response.fase === 'masuk' ? 'Masuk' : 'Keluar') + ' ✓';
                    showToast('success', response.message);
                } else {
                    document.getElementById('namapengguna').textContent = '—';
                    document.getElementById('usernamepengguna').textContent =
                        response.status === 'info' ? '(sudah scan)' : '';
                    showToast(response.status === 'info' ? 'success' : 'error', response.message);
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

