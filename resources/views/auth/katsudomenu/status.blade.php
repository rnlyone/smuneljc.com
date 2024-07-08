@include('app.auth.app', ['pagetitle' => $pagetitle, 'status' => 'active'])

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">SmunelJC /</span> Katsudo / Status Anggota / {{$tahundaftar}}
        </h4>

        @if (session()->get('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <h6 class="alert-heading mb-1"></i>Yatta!, Sukses</h6>
                        <span> {{session('success')}}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                    @endif

        <div class="row mb-4">
            <!-- Basic Layout & Basic with Icons -->
            <!-- Basic Layout -->
            <div class="col-lg-12 mb-2">
                <div class="card mb-2">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title mb-0">Tahun</h5>
                        <div class="dropdown">
                            <button class="btn btn btn-outline-secondary dropdown-toggle" type="button"
                                id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                {{$tahundaftar}}
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                                @foreach ($existingYears as $year)
                                <a class="dropdown-item"
                                    href="{{route('status.fadmin', ['tahun' => $year])}}">{{$year}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($statuses as $status)
        <div class="row mb-4">
            <div class="card">
                <h5 class="card-header">List Anggota {{$status->status}}</h5>
                <div class="card-datatable table-responsive">
                    <table class="dt-multilingual table table-bordered daftarpendaftar">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>NISN</th>
                                <th>Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($pendaftars[$status->status]) && count($pendaftars[$status->status]) > 0)
                            @foreach (array_values($pendaftars[$status->status]->where('tahun_daftar',
                            $tahundaftar)->all()) as $i => $p)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$p->NamaLengkap}}</td>
                                <td>{{$p->NISN}}</td>
                                <td>{{$p->Kelas}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                            id="dropdown{{$p->NISN}}" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            {{$p->sts->status}}
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown{{$p->NISN}}">
                                            @foreach ($statuses as $status)
                                            <a class="dropdown-item"
                                                href="{{route('status.ubahstatus', ['pendaftarId' => $p->id, 'statusId' => $status->id])}}">{{$status->status}}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@include('app.auth.footer')

<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="/assetsdash/vendor/libs/datatables/jquery.dataTables.js"></script>
<script src="/assetsdash/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="/assetsdash/vendor/libs/datatables-responsive/datatables.responsive.js"></script>
<script src="/assetsdash/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js"></script>
<script src="/assetsdash/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.js"></script>
<script src="/assetsdash/vendor/libs/datatables-buttons/datatables-buttons.js"></script>
<script src="/assetsdash/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js"></script>
<script src="/assetsdash/vendor/libs/jszip/jszip.js"></script>
<script src="/assetsdash/vendor/libs/pdfmake/pdfmake.js"></script>
<script src="/assetsdash/js/form-layouts.js"></script>
<script src="/assetsdash/js/tables-datatables-basic.js"></script>
<script>
    $(document).ready(function () {
        $('.daftarpendaftar').DataTable();
    });

</script>
