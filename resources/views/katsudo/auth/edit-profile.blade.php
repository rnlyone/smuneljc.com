@include('katsudo.layouts.header')

<section class="un-page-components">
    <div class="padding-20">

        {{-- Back button --}}
        <div class="title-page mb-4">
            <a href="{{ route('katsudo.index') }}" class="btn p-0 me-2">
                <i class="ri-arrow-left-line fs-5"></i>
            </a>
            <h2 class="d-inline mb-0">Edit Profil</h2>
        </div>

        {{-- Flash messages --}}
        @if(session('profil_success'))
            <div class="alert alert-success rounded-15 py-2 mb-3">{{ session('profil_success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger rounded-15 py-2 mb-3">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $e)
                        <li class="size-13">{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('ktd.profil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- ── Foto ── --}}
            <div class="card rounded-15 mb-4">
                <div class="card-body text-center py-4">
                    <div class="mb-3" id="previewWrap">
                        @if($user->foto_anggota && $user->foto_anggota !== 'default.jpg')
                            <img id="fotoPreview" src="/images/{{ $user->foto_anggota }}"
                                 class="rounded-circle" style="width:90px;height:90px;object-fit:cover;" alt="">
                        @elseif($user->JK == 'pria')
                            <img id="fotoPreview" src="/images/itsupp.png"
                                 class="rounded-circle" style="width:90px;height:90px;object-fit:cover;" alt="">
                        @else
                            <img id="fotoPreview" src="/images/itsukipp.png"
                                 class="rounded-circle" style="width:90px;height:90px;object-fit:cover;" alt="">
                        @endif
                    </div>
                    <label for="foto_anggota" class="btn btn-sm bg-primary color-white rounded-pill px-3">
                        <i class="ri-camera-line me-1"></i> Ganti Foto
                    </label>
                    <input type="file" id="foto_anggota" name="foto_anggota"
                           accept="image/jpeg,image/png,image/webp" class="d-none"
                           onchange="previewFoto(this)">
                    <p class="size-11 color-text mt-2 mb-0">JPG, PNG, atau WebP · Maks 3 MB</p>
                </div>
            </div>

            {{-- ── Data Diri ── --}}
            <div class="card rounded-15 mb-4">
                <div class="card-body">
                    <h6 class="mb-3">Data Diri</h6>

                    <div class="mb-3">
                        <label class="form-label size-14">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="NamaLengkap" class="form-control rounded-10"
                               value="{{ old('NamaLengkap', $user->NamaLengkap) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label size-14">Kelas</label>
                        <input type="text" name="Kelas" class="form-control rounded-10"
                               value="{{ old('Kelas', $user->Kelas) }}" placeholder="XII MIPA 1">
                    </div>

                    <div class="mb-3">
                        <label class="form-label size-14">No. WhatsApp</label>
                        <input type="text" name="NoWA" class="form-control rounded-10"
                               value="{{ old('NoWA', $user->NoWA) }}" placeholder="08xxxxxxxxxx">
                    </div>

                    <div class="mb-0">
                        <label class="form-label size-14">Instagram</label>
                        <div class="input-group">
                            <span class="input-group-text rounded-start-10 border-end-0 bg-transparent size-13 color-text">@</span>
                            <input type="text" name="Instagram" class="form-control rounded-end-10"
                                   value="{{ old('Instagram', ltrim($user->Instagram ?? '', '@')) }}"
                                   placeholder="username">
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Ganti PIN ── --}}
            <div class="card rounded-15 mb-4">
                <div class="card-body">
                    <h6 class="mb-1">Ganti PIN</h6>
                    <p class="size-12 color-text mb-3">Kosongkan jika tidak ingin mengganti PIN.</p>

                    <div class="mb-3">
                        <label class="form-label size-14">PIN Lama</label>
                        <input type="password" name="PIN_lama" class="form-control rounded-10"
                               autocomplete="current-password" placeholder="••••••">
                    </div>
                    <div class="mb-3">
                        <label class="form-label size-14">PIN Baru</label>
                        <input type="password" name="PIN_baru" class="form-control rounded-10"
                               autocomplete="new-password" placeholder="Min. 6 karakter">
                    </div>
                    <div class="mb-0">
                        <label class="form-label size-14">Konfirmasi PIN Baru</label>
                        <input type="password" name="PIN_baru_confirmation" class="form-control rounded-10"
                               autocomplete="new-password" placeholder="Ulangi PIN baru">
                    </div>
                </div>
            </div>

            {{-- ── Info tidak dapat diubah ── --}}
            <div class="card rounded-15 mb-4 opacity-75">
                <div class="card-body">
                    <h6 class="mb-3 color-text">Info (Tidak Dapat Diubah)</h6>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span class="size-13 color-text">NISN</span>
                        <span class="size-13 fw-semibold">{{ $user->NISN }}</span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span class="size-13 color-text">No. Anggota</span>
                        <span class="size-13 fw-semibold">{{ $user->nomor_anggota ?? '—' }}</span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span class="size-13 color-text">Divisi</span>
                        <span class="size-13 fw-semibold">{{ $user->dpt->nama ?? '—' }}</span>
                    </div>
                    <div class="d-flex justify-content-between py-2">
                        <span class="size-13 color-text">Status</span>
                        <span class="size-13 fw-semibold">{{ $user->sts->status ?? '—' }}</span>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn bg-primary color-white w-100 rounded-pill py-3 mb-4">
                <i class="ri-save-line me-1"></i> Simpan Perubahan
            </button>
        </form>

    </div>
</section>

<script>
function previewFoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('fotoPreview').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@include('katsudo.layouts.footer')
