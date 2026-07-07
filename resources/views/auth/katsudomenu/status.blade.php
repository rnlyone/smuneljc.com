@include('app.auth.app', ['pagetitle' => $pagetitle, 'status' => 'active'])

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">SmunelJC / Katsudo /</span> Status Anggota
        </h4>

        {{-- Sticky Bulk Action Bar --}}
        <div id="bulk-bar" class="card border-primary shadow mb-3 d-none"
             style="position:sticky; top:10px; z-index:999;">
            <div class="card-body d-flex align-items-center flex-wrap gap-3 py-2 px-3">
                <span class="fw-semibold text-primary">
                    <i class="bx bx-check-square me-1"></i>
                    <span id="selected-count">0</span> anggota dipilih
                </span>
                <div class="vr d-none d-sm-block"></div>
                <div class="d-flex align-items-center gap-2">
                    <label class="mb-0 text-nowrap small fw-semibold">Ubah Status ke:</label>
                    <select id="bulk-status-select" form="bulk-form" name="status_id"
                            class="form-select form-select-sm" style="width:180px;">
                        @foreach($statuses as $s)
                            <option value="{{ $s->id }}">{{ $s->status }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" form="bulk-form" class="btn btn-primary btn-sm">
                    <i class="bx bx-check me-1"></i>Terapkan
                </button>
                <button type="button" id="clear-btn" class="btn btn-outline-secondary btn-sm ms-auto">
                    <i class="bx bx-x me-1"></i>Batalkan Pilihan
                </button>
            </div>
        </div>

        {{-- Alerts --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible mb-3" role="alert">
                <h6 class="alert-heading mb-1"><i class="bx bx-check-circle me-1"></i>Yatta! Sukses</h6>
                <span>{{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible mb-2" role="alert">
                    <span>{{ $error }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endforeach
        @endif

        {{-- Year Filter --}}
        <div class="card mb-3">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0">Tahun Daftar</h5>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ $tahundaftar }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        @foreach ($existingYears as $year)
                            <a class="dropdown-item {{ $year == $tahundaftar ? 'active' : '' }}"
                               href="{{ route('status.fadmin', ['tahun' => $year]) }}">{{ $year }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Status Filter Pills --}}
        <div class="mb-3 d-flex gap-2 flex-wrap align-items-center">
            <span class="text-muted small me-1">Filter:</span>
            <button class="btn btn-sm btn-primary filter-pill active" data-filter="">
                Semua
                <span class="badge bg-white text-primary ms-1">{{ $pendaftars->count() }}</span>
            </button>
            @foreach($statuses as $s)
                <button class="btn btn-sm btn-outline-primary filter-pill" data-filter="{{ $s->status }}">
                    {{ $s->status }}
                    <span class="badge bg-primary ms-1">{{ $pendaftars->where('status', $s->id)->count() }}</span>
                </button>
            @endforeach
        </div>

        {{-- Bulk Form + Table --}}
        <form id="bulk-form" action="{{ route('status.bulk') }}" method="POST">
            @csrf
            <input type="hidden" name="tahun" value="{{ $tahundaftar }}" />

            <div class="card">
                <div class="table-responsive">
                    <table id="status-table" class="table table-bordered table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width:40px;">
                                    <input type="checkbox" id="select-all" class="form-check-input" />
                                </th>
                                <th style="width:50px;">No.</th>
                                <th>Nama</th>
                                <th>NISN</th>
                                <th>Kelas</th>
                                <th>Status</th>
                                <th style="width:160px;">Ubah Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendaftars as $i => $p)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="pendaftar_ids[]"
                                               value="{{ $p->id }}" class="form-check-input row-check" />
                                    </td>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $p->NamaLengkap }}</td>
                                    <td>{{ $p->NISN }}</td>
                                    <td>{{ $p->Kelas }}</td>
                                    <td>
                                        <span class="badge bg-label-primary">
                                            {{ $p->sts?->status ?? '-' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle w-100"
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ $p->sts?->status ?? '-' }}
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                @foreach ($statuses as $s)
                                                    <a class="dropdown-item {{ $p->status == $s->id ? 'active' : '' }}"
                                                       href="{{ route('status.ubahstatus', ['pendaftarId' => $p->id, 'statusId' => $s->id]) }}">
                                                        {{ $s->status }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        Tidak ada anggota untuk tahun {{ $tahundaftar }}.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </form>

    </div>
</div>

@include('app.auth.footer')

<script src="/assetsdash/vendor/libs/datatables/jquery.dataTables.js"></script>
<script src="/assetsdash/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script>
$(document).ready(function () {

    // -- DataTable (paging off so all rows stay in DOM for checkbox select-all) --
    const table = $('#status-table').DataTable({
        paging: false,
        info: false,
        order: [],
        columnDefs: [
            { orderable: false, targets: [0, 6] },
            { searchable: false, targets: [0, 1] }
        ],
        language: { search: 'Cari:', zeroRecords: 'Tidak ada anggota ditemukan.' }
    });

    // -- Status filter pills --
    $('.filter-pill').on('click', function () {
        $('.filter-pill').removeClass('active btn-primary').addClass('btn-outline-primary');
        $(this).addClass('active btn-primary').removeClass('btn-outline-primary');
        const filter = $(this).data('filter');
        // Exact match on status column (index 5)
        table.column(5).search(filter ? ('^' + filter.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + '$') : '', true, false).draw();
    });

    // -- Checkbox: update bulk bar visibility --
    function updateBulkBar() {
        const total   = $('.row-check').length;
        const checked = $('.row-check:checked').length;
        $('#selected-count').text(checked);
        if (checked > 0) {
            $('#bulk-bar').removeClass('d-none');
        } else {
            $('#bulk-bar').addClass('d-none');
        }
        // Update select-all state
        if (checked === 0) {
            $('#select-all').prop({ checked: false, indeterminate: false });
        } else if (checked === total) {
            $('#select-all').prop({ checked: true, indeterminate: false });
        } else {
            $('#select-all').prop({ checked: false, indeterminate: true });
        }
    }

    // Select all visible rows
    $('#select-all').on('change', function () {
        // Only target rows currently visible (after DataTable search/filter)
        table.rows({ search: 'applied' }).nodes().to$().find('.row-check').prop('checked', this.checked);
        updateBulkBar();
    });

    $(document).on('change', '.row-check', function () {
        updateBulkBar();
    });

    $('#clear-btn').on('click', function () {
        $('.row-check').prop('checked', false);
        updateBulkBar();
    });

    // Guard: prevent submit with no selection
    $('#bulk-form').on('submit', function (e) {
        if ($('.row-check:checked').length === 0) {
            e.preventDefault();
            alert('Pilih minimal 1 anggota terlebih dahulu.');
        }
    });
});
</script>

