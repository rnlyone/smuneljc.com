@include('app.auth.app', ['pagetitle' => $pagetitle, 'pengurus' => 'active'])

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">SmunelJC /</span> Pengurus
        </h4>
        <div class="row mb-4">
            <div class="card">
                <h5 class="card-header">List Pengurus</h5>
                <div class="card-datatable table-responsive">
                    @if (session()->get('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <h6 class="alert-heading mb-1"></i>Yatta!, Sukses</h6>
                        <span> {{session('success')}}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                    @endif
                    <table id="daftarpengurus" class="dt-multilingual table table-bordered">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Nama</th>
                          <th>Jabatan</th>
                          <th>Image</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($pengurus as $i => $p)
                          <tr>
                              <td>{{$i+1}}</td>
                              <td>{{$p->NamaLengkap}}</td>
                              <td>{{$p->Posisi}}</td>
                              <td><img src="{{$p->ImagePath}}" width="50" alt="{{$p->ImagePath}}"></td>
                              <td><a href="/daftar/{{$p->NISN}}/edit" class="btn btn-xs btn-outline-secondary">
                                  <i class="tf-icons bx bx-edit-alt"></i><span class="ms-2">Edit</span>
                                </a></td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
        </div>
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
    $(document).ready( function () {
    $('#daftarpengurus').DataTable();
} );
</script>
