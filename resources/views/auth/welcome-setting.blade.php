@include('app.auth.app', ['pagetitle' => $pagetitle, 'welcome_setting' => 'active'])

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">SmunelJC /</span> Welcome Page Setting
        </h4>

        {{-- Global alerts --}}
        @foreach (['success','inovasi_success','testimonial_success'] as $key)
            @if (session($key))
                <div class="alert alert-success alert-dismissible mb-3" role="alert">
                    <h6 class="alert-heading mb-1"><i class="bx bx-check-circle me-1"></i>Yatta! Sukses</h6>
                    <span>{{ session($key) }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        @endforeach
        @if ($errors->any())
            @foreach ($errors->all() as $err)
                <div class="alert alert-danger alert-dismissible mb-2" role="alert">
                    <span>{{ $err }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endforeach
        @endif

        {{-- Nav Tabs --}}
        <ul class="nav nav-tabs mb-4" id="welcomeTabs" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="gallery-tab" data-bs-toggle="tab"
                    data-bs-target="#tab-gallery" type="button">
                    <i class="bx bx-images me-1"></i>Karya Anggota
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="inovasi-tab" data-bs-toggle="tab"
                    data-bs-target="#tab-inovasi" type="button">
                    <i class="bx bx-bulb me-1"></i>Inovasi Kami
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="testimonial-tab" data-bs-toggle="tab"
                    data-bs-target="#tab-testimonial" type="button">
                    <i class="bx bx-comment-dots me-1"></i>Kata Alumni
                </button>
            </li>
        </ul>

        <div class="tab-content">

            {{-- =================== TAB 1: GALLERY =================== --}}
            <div class="tab-pane fade show active" id="tab-gallery">
                <div class="row">
                    {{-- Add Form --}}
                    <div class="col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="mb-0">Tambah Karya Baru</h5>
                                <small class="text-muted">
                                    Ukuran gambar yang disarankan: <strong>800 × 500 px</strong> (landscape, max 4MB)
                                </small>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Judul</label>
                                        <input type="text" name="Title" class="form-control" placeholder="cth: Poster Gakuensai 2024" required />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Author / Pembuat</label>
                                        <input type="text" name="Author" class="form-control" placeholder="cth: Divisi Hi" required />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Kategori</label>
                                        <input type="text" name="Category" class="form-control" placeholder="cth: Desain, Musik, Video" required />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Gambar <span class="badge bg-label-info">800×500 px</span></label>
                                        <input type="file" name="ImagePath" class="form-control" accept="image/*" required />
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="bx bx-plus me-1"></i>Tambah
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- List --}}
                    <div class="col-lg-8 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Daftar Karya ({{ $galeri->count() }} item)</h5>
                            </div>
                            <div class="table-responsive">
                                <table id="gallery-table" class="table table-bordered mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Preview</th>
                                            <th>Judul</th>
                                            <th>Author</th>
                                            <th>Kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($galeri as $i => $g)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>
                                                    <img src="{{ asset($g->ImagePath) }}" width="80" height="50"
                                                         style="object-fit:cover;border-radius:4px;" alt="{{ $g->Title }}">
                                                </td>
                                                <td>{{ $g->Title }}</td>
                                                <td>{{ $g->Author }}</td>
                                                <td><span class="badge bg-label-primary">{{ $g->Category }}</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary me-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editGalleryModal{{ $g->id }}">
                                                        <i class="bx bx-edit"></i>
                                                    </button>
                                                    <a href="{{ route('galeri.destroy', $g->id) }}"
                                                       class="btn btn-sm btn-outline-danger"
                                                       onclick="return confirm('Hapus karya {{ $g->Title }}?')">
                                                        <i class="bx bx-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                            {{-- Edit Modal --}}
                                            <div class="modal fade" id="editGalleryModal{{ $g->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Karya</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <form action="{{ route('galeri.update', $g->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3 text-center">
                                                                    <img src="{{ asset($g->ImagePath) }}" class="img-fluid rounded mb-2" style="max-height:150px;">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Judul</label>
                                                                    <input type="text" name="Title" class="form-control" value="{{ $g->Title }}" required />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Author</label>
                                                                    <input type="text" name="Author" class="form-control" value="{{ $g->Author }}" required />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Kategori</label>
                                                                    <input type="text" name="Category" class="form-control" value="{{ $g->Category }}" required />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">
                                                                        Ganti Gambar
                                                                        <small class="text-muted">(opsional, 800×500 px)</small>
                                                                    </label>
                                                                    <input type="file" name="ImagePath" class="form-control" accept="image/*" />
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-4">Belum ada karya.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- =================== TAB 2: INOVASI =================== --}}
            <div class="tab-pane fade" id="tab-inovasi">
                <div class="card mb-3 border-0 bg-label-info">
                    <div class="card-body py-2 px-3 small">
                        <i class="bx bx-info-circle me-1"></i>
                        <strong>Layout Inovasi:</strong> Item pertama (urutan = 1) tampil besar (<em>col-lg-8</em>).
                        Item berikutnya tampil kecil di samping atau baris baru (<em>col-lg-4</em>).
                        Ukuran gambar: Item besar <strong>1200 × 700 px</strong> · Item kecil <strong>600 × 700 px</strong> · Max 5 MB.
                    </div>
                </div>
                <div class="row">
                    {{-- Add Form --}}
                    <div class="col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="mb-0">Tambah Inovasi Baru</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('inovasi.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Judul</label>
                                        <input type="text" name="judul" class="form-control"
                                            placeholder="cth: Aplikasi Web Gakuensai" required />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Sub-judul / Keterangan</label>
                                        <input type="text" name="subjudul" class="form-control"
                                            placeholder="cth: Gakuensai 2023" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Link Proyek</label>
                                        <input type="url" name="link" class="form-control"
                                            placeholder="https://..." />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Link Video (YouTube) <small class="text-muted">opsional</small></label>
                                        <input type="url" name="video_link" class="form-control"
                                            placeholder="https://youtube.com/..." />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Urutan
                                            <span class="badge bg-label-warning">1 = tampil besar</span>
                                        </label>
                                        <input type="number" name="urutan" class="form-control"
                                            min="0" value="1" required />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Gambar
                                            <span class="badge bg-label-info">1200×700 px (besar) / 600×700 px (kecil)</span>
                                        </label>
                                        <input type="file" name="image_path" class="form-control" accept="image/*" required />
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="bx bx-plus me-1"></i>Tambah
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- List --}}
                    <div class="col-lg-8 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Daftar Inovasi ({{ $inovasis->count() }} item)</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Preview</th>
                                            <th>Judul</th>
                                            <th>Urutan</th>
                                            <th>Video</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($inovasis as $i => $inv)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>
                                                    <img src="{{ asset($inv->image_path) }}" width="80" height="50"
                                                         style="object-fit:cover;border-radius:4px;" alt="{{ $inv->judul }}">
                                                </td>
                                                <td>
                                                    <div class="fw-semibold">{{ $inv->judul }}</div>
                                                    <small class="text-muted">{{ $inv->subjudul }}</small>
                                                </td>
                                                <td>
                                                    <span class="badge {{ $inv->urutan == 1 ? 'bg-primary' : 'bg-label-secondary' }}">
                                                        {{ $inv->urutan == 1 ? 'Besar' : 'Kecil ('.$inv->urutan.')' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($inv->video_link)
                                                        <i class="bx bxl-youtube text-danger fs-5"></i>
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary me-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editInovasiModal{{ $inv->id }}">
                                                        <i class="bx bx-edit"></i>
                                                    </button>
                                                    <a href="{{ route('inovasi.destroy', $inv->id) }}"
                                                       class="btn btn-sm btn-outline-danger"
                                                       onclick="return confirm('Hapus inovasi {{ $inv->judul }}?')">
                                                        <i class="bx bx-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                            {{-- Edit Modal --}}
                                            <div class="modal fade" id="editInovasiModal{{ $inv->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Inovasi</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <form action="{{ route('inovasi.update', $inv->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3 text-center">
                                                                    <img src="{{ asset($inv->image_path) }}" class="img-fluid rounded mb-2" style="max-height:150px;">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Judul</label>
                                                                    <input type="text" name="judul" class="form-control" value="{{ $inv->judul }}" required />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Sub-judul</label>
                                                                    <input type="text" name="subjudul" class="form-control" value="{{ $inv->subjudul }}" />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Link Proyek</label>
                                                                    <input type="url" name="link" class="form-control" value="{{ $inv->link }}" />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Link Video</label>
                                                                    <input type="url" name="video_link" class="form-control" value="{{ $inv->video_link }}" />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Urutan</label>
                                                                    <input type="number" name="urutan" class="form-control" value="{{ $inv->urutan }}" min="0" required />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">
                                                                        Ganti Gambar
                                                                        <small class="text-muted">(opsional)</small>
                                                                    </label>
                                                                    <input type="file" name="image_path" class="form-control" accept="image/*" />
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-4">Belum ada inovasi.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- =================== TAB 3: TESTIMONIAL =================== --}}
            <div class="tab-pane fade" id="tab-testimonial">
                <div class="row">
                    {{-- Add Form --}}
                    <div class="col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="mb-0">Tambah Kata Alumni</h5>
                                <small class="text-muted">
                                    Foto profil yang disarankan: <strong>300 × 300 px</strong> (persegi, max 3MB)
                                </small>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('testimonial.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" name="nama" class="form-control"
                                            placeholder="cth: Muhammad Nabil" required />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Peran / Jabatan</label>
                                        <input type="text" name="peran" class="form-control"
                                            placeholder="cth: Ketua Umum 2021/2022" required />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Kutipan</label>
                                        <textarea name="kutipan" class="form-control" rows="4"
                                            placeholder="Tulis kata-kata dari alumni..." required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Foto Profil
                                            <span class="badge bg-label-info">300×300 px</span>
                                            <small class="text-muted">(opsional)</small>
                                        </label>
                                        <input type="file" name="image_path" class="form-control" accept="image/*" />
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="bx bx-plus me-1"></i>Tambah
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- List --}}
                    <div class="col-lg-8 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Daftar Kata Alumni ({{ $testimonials->count() }} item)</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Peran</th>
                                            <th>Kutipan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($testimonials as $i => $t)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>
                                                    @if($t->image_path)
                                                        <img src="{{ asset($t->image_path) }}" width="50" height="50"
                                                             style="object-fit:cover;border-radius:50%;">
                                                    @else
                                                        <div class="avatar avatar-sm">
                                                            <span class="avatar-initial rounded-circle bg-label-secondary">
                                                                {{ strtoupper(substr($t->nama, 0, 1)) }}
                                                            </span>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="fw-semibold">{{ $t->nama }}</td>
                                                <td><small class="text-muted">{{ $t->peran }}</small></td>
                                                <td>
                                                    <small class="text-truncate d-block" style="max-width:200px;">
                                                        "{{ $t->kutipan }}"
                                                    </small>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary me-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editTestimonialModal{{ $t->id }}">
                                                        <i class="bx bx-edit"></i>
                                                    </button>
                                                    <a href="{{ route('testimonial.destroy', $t->id) }}"
                                                       class="btn btn-sm btn-outline-danger"
                                                       onclick="return confirm('Hapus testimoni dari {{ $t->nama }}?')">
                                                        <i class="bx bx-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                            {{-- Edit Modal --}}
                                            <div class="modal fade" id="editTestimonialModal{{ $t->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Kata Alumni</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <form action="{{ route('testimonial.update', $t->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                @if($t->image_path)
                                                                    <div class="mb-3 text-center">
                                                                        <img src="{{ asset($t->image_path) }}" width="80" height="80"
                                                                             style="object-fit:cover;border-radius:50%;" class="mb-2">
                                                                    </div>
                                                                @endif
                                                                <div class="mb-3">
                                                                    <label class="form-label">Nama</label>
                                                                    <input type="text" name="nama" class="form-control" value="{{ $t->nama }}" required />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Peran / Jabatan</label>
                                                                    <input type="text" name="peran" class="form-control" value="{{ $t->peran }}" required />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Kutipan</label>
                                                                    <textarea name="kutipan" class="form-control" rows="4" required>{{ $t->kutipan }}</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">
                                                                        Ganti Foto
                                                                        <small class="text-muted">(opsional, 300×300 px)</small>
                                                                    </label>
                                                                    <input type="file" name="image_path" class="form-control" accept="image/*" />
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-4">Belum ada kata alumni.</td>
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
        {{-- end tab-content --}}

    </div>
</div>

@include('app.auth.footer')

<script src="/assetsdash/vendor/libs/datatables/jquery.dataTables.js"></script>
<script src="/assetsdash/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script>
$(document).ready(function () {
    $('#gallery-table').DataTable({
        paging: true,
        pageLength: 10,
        order: [],
        language: { search: 'Cari:' }
    });

    // Reopen the correct tab if page refreshes after form submit
    const activeTab = new URLSearchParams(window.location.search).get('tab');
    if (activeTab) {
        document.querySelector('#' + activeTab + '-tab')?.click();
    }
});
</script>
