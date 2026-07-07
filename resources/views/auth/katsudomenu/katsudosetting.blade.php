@include('app.auth.app', ['pagetitle' => $pagetitle, 'katsudo_setting' => 'active'])

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">SmunelJC / Katsudo /</span> Setting
        </h4>

        {{-- ======================== PERIODE ======================== --}}
        <h5 class="mb-3"><i class="bx bx-calendar me-1"></i> Manajemen Periode</h5>

        @if (session('periode_success'))
            <div class="alert alert-success alert-dismissible mb-3" role="alert">
                <h6 class="alert-heading mb-1">Yatta! Sukses</h6>
                <span>{{ session('periode_success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if (session('periode_error'))
            <div class="alert alert-danger alert-dismissible mb-3" role="alert">
                <h6 class="alert-heading mb-1">Gomen! Gagal</h6>
                <span>{{ session('periode_error') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row mb-5">
            <div class="col-lg-5 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0">Tambah Periode Baru</h5>
                        <small class="text-muted">Menambah periode baru otomatis membuat kartu keaktifan untuk semua anggota.</small>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('periode.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama Angkatan</label>
                                <input type="text" name="angkatan" class="form-control @error('angkatan') is-invalid @enderror"
                                    placeholder="cth: Hana no Shichi-gatsu" value="{{ old('angkatan') }}" />
                                @error('angkatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tahun Mulai</label>
                                <input type="number" name="tahun_mulai" class="form-control @error('tahun_mulai') is-invalid @enderror"
                                    placeholder="cth: 2025" min="2000" max="2100" value="{{ old('tahun_mulai') }}" />
                                @error('tahun_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bx bx-plus me-1"></i> Tambah Periode
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0">Daftar Periode</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Angkatan</th>
                                    <th>Tahun</th>
                                    <th>Periode</th>
                                    <th>Jml Anggota</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($periodes as $i => $periode)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $periode->angkatan }}</td>
                                        <td>{{ $periode->tahun_mulai }}</td>
                                        <td>{{ $periode->tahun_mulai }}&ndash;{{ $periode->tahun_mulai + 1 }}</td>
                                        <td>
                                            <span class="badge bg-label-primary">
                                                {{ $periode->keaktifans->count() }} anggota
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-3">Belum ada periode.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- ======================== STATUS ======================== --}}
        <h5 class="mb-3"><i class="bx bx-label me-1"></i> Manajemen Status Anggota</h5>

        @if (session('status_success'))
            <div class="alert alert-success alert-dismissible mb-3" role="alert">
                <h6 class="alert-heading mb-1">Yatta! Sukses</h6>
                <span>{{ session('status_success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row mb-5">
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0">Tambah Status Baru</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('status.list.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama Status</label>
                                <input type="text" name="status" class="form-control @error('status') is-invalid @enderror"
                                    placeholder="cth: Aktif" value="{{ old('status') }}" />
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Level <small class="text-muted">(urutan tampil)</small></label>
                                <input type="number" name="level" class="form-control @error('level') is-invalid @enderror"
                                    placeholder="cth: 1" min="0" value="{{ old('level', 1) }}" />
                                @error('level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bx bx-plus me-1"></i> Tambah Status
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0">Daftar Status</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Status</th>
                                    <th>Level</th>
                                    <th>Jml Anggota</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($statuses as $i => $status)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td colspan="2">
                                            <form action="{{ route('status.list.update', $status->id) }}" method="POST" class="d-flex gap-2">
                                                @csrf
                                                <input type="text" name="status" value="{{ $status->status }}"
                                                    class="form-control form-control-sm" style="min-width:120px;" required />
                                                <input type="number" name="level" value="{{ $status->level }}"
                                                    class="form-control form-control-sm" style="width:70px;" min="0" required />
                                                <button class="btn btn-sm btn-outline-primary text-nowrap" type="submit">
                                                    <i class="bx bx-save"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <span class="badge bg-label-secondary">
                                                {{ $status->anggotas->count() }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($status->anggotas->count() === 0)
                                                <a href="{{ route('status.list.destroy', $status->id) }}"
                                                    class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Hapus status {{ $status->status }}?')">
                                                    <i class="bx bx-trash"></i>
                                                </a>
                                            @else
                                                <button class="btn btn-sm btn-outline-secondary" disabled title="Status masih digunakan">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-3">Belum ada status.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- ======================== DEPARTEMEN ======================== --}}
        <h5 class="mb-3"><i class="bx bx-buildings me-1"></i> Manajemen Departemen</h5>

        @if (session('departemen_success'))
            <div class="alert alert-success alert-dismissible mb-3" role="alert">
                <h6 class="alert-heading mb-1">Yatta! Sukses</h6>
                <span>{{ session('departemen_success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row mb-5">
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0">Tambah Departemen Baru</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('departemen.list.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama Departemen</label>
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                    placeholder="cth: Bunka (文化)" value="{{ old('nama') }}" />
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Level <small class="text-muted">(urutan tampil)</small></label>
                                <input type="number" name="level" class="form-control @error('level') is-invalid @enderror"
                                    placeholder="cth: 1" min="0" value="{{ old('level', 1) }}" />
                                @error('level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Icon <small class="text-muted">(opsional, class Boxicons)</small></label>
                                <input type="text" name="icon" class="form-control"
                                    placeholder="cth: bx-music" value="{{ old('icon') }}" />
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bx bx-plus me-1"></i> Tambah Departemen
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0">Daftar Departemen</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Level</th>
                                    <th>Icon</th>
                                    <th>Jml Anggota</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($departemens as $i => $dept)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td colspan="3">
                                            <form action="{{ route('departemen.list.update', $dept->id) }}" method="POST" class="d-flex gap-2 align-items-center">
                                                @csrf
                                                <input type="text" name="nama" value="{{ $dept->nama }}"
                                                    class="form-control form-control-sm" style="min-width:150px;" required />
                                                <input type="number" name="level" value="{{ $dept->level }}"
                                                    class="form-control form-control-sm" style="width:70px;" min="0" required />
                                                <input type="text" name="icon" value="{{ $dept->icon }}"
                                                    class="form-control form-control-sm" style="min-width:100px;"
                                                    placeholder="bx-..." />
                                                <button class="btn btn-sm btn-outline-primary text-nowrap" type="submit">
                                                    <i class="bx bx-save"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <span class="badge bg-label-secondary">
                                                {{ $dept->anggotas->count() }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($dept->anggotas->count() === 0)
                                                <a href="{{ route('departemen.list.destroy', $dept->id) }}"
                                                    class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Hapus departemen {{ $dept->nama }}?')">
                                                    <i class="bx bx-trash"></i>
                                                </a>
                                            @else
                                                <button class="btn btn-sm btn-outline-secondary" disabled title="Departemen masih memiliki anggota">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-3">Belum ada departemen.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@include('app.auth.footer')
