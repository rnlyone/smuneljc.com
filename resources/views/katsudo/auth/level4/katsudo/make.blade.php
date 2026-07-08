@include('katsudo.layouts.header')

<section class="un-page-components">
    <div class="padding-20">

        <div class="title-page mb-3">
            <h2 class="mb-1">Buat Katsudo</h2>
            <p class="size-13 color-text mb-0">
                Rekomendasi aktif dari Kaichō:
                <strong>{{ $rekomendasi->catatan ?: 'Tidak ada catatan' }}</strong>
            </p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger rounded-15 mb-3">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $e)
                        <li class="size-13">{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('katsudo.store') }}" method="POST">
            @csrf

            {{-- Nama --}}
            <div class="form-group mb-3">
                <label class="form-label">Nama Katsudo</label>
                <input type="text" name="nama" class="form-control" required
                    placeholder="cth: Latihan Rutin Senin" value="{{ old('nama') }}">
            </div>

            {{-- Tanggal --}}
            <div class="form-group mb-3">
                <label class="form-label">Tanggal & Waktu Pelaksanaan</label>
                <input type="datetime-local" name="tgl_laksana" class="form-control" required
                    value="{{ old('tgl_laksana') }}">
            </div>

            {{-- Deskripsi --}}
            <div class="form-group mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3" required
                    placeholder="Jelaskan tujuan dan detail kegiatan...">{{ old('deskripsi') }}</textarea>
            </div>

            {{-- Divisi yang diundang --}}
            <div class="form-group mb-4">
                <label class="form-label">Divisi yang Diundang</label>
                <p class="size-12 color-text mb-2">
                    Kosongkan semua untuk mengundang semua anggota aktif. Member dari divisi yang tidak dipilih
                    <strong>tidak akan dihitung absen</strong> jika tidak hadir.
                </p>
                @foreach($departemens as $d)
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="checkbox"
                            name="divisi_undangan[]" value="{{ $d->id }}"
                            id="div_{{ $d->id }}"
                            {{ is_array(old('divisi_undangan')) && in_array($d->id, old('divisi_undangan')) ? 'checked' : '' }}>
                        <label class="form-check-label size-14" for="div_{{ $d->id }}">
                            {{ $d->nama }}
                        </label>
                    </div>
                @endforeach
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" id="checkAll">
                    <label class="form-check-label size-13 color-text" for="checkAll">Pilih / Batalkan Semua</label>
                </div>
            </div>

            <button type="submit" class="btn bg-primary color-white w-100 rounded-pill">
                <i class="ri-calendar-event-line me-1"></i> Buat Katsudo
            </button>
        </form>
    </div>
    <div class="space-sticky-footer"></div>
</section>

<script>
document.getElementById('checkAll').addEventListener('change', function () {
    document.querySelectorAll('input[name="divisi_undangan[]"]').forEach(function (cb) {
        cb.checked = document.getElementById('checkAll').checked;
    });
});
</script>

@include('katsudo.layouts.footer')
