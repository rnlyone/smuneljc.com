@include('app.auth.app', ['pagetitle' => $pagetitle, 'pendaftar' => 'active'])

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">SmunelJC /</span> Pendaftar
        </h4>
        <div class="row mb-4">
            <div class="card">
                <h5 class="card-header">List Pendaftar</h5>
                <div class="card-datatable table-responsive">
                    <table id="daftarpendaftar" class="dt-multilingual table table-bordered">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Nama</th>
                          <th>NISN</th>
                          <th>Kelas</th>
                          <th>WhatsApp</th>
                          <th>Instagram</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($pendaftars as $i => $p)
                          <tr>
                              <td>{{$i+1}}</td>
                              <td>{{$p->NamaLengkap}}</td>
                              <td>{{$p->NISN}}</td>
                              <td>{{$p->Kelas}}</td>
                              <td><a href="https://api.whatsapp.com/send?phone=62{{$p->NoWA}}&text=Hai%20{{$p->NamaLengkap}}%2C%0A{{$pesandefault->Value}}" target="_blank" class="btn btn-xs btn-outline-success">
                                <i class="tf-icons bx bx-phone-call"></i><span class="ms-2">WA</span>
                              </a></td>
                              <td><a href="https://instagram.com/{{$p->Instagram}}" target="_blank" class="btn btn-xs btn-outline-primary">
                                <i class="tf-icons bx bx-camera-home"></i><span class="ms-2">IG</span>
                              </a></td>
                              <td><button type="button" class="btn btn-xs btn-outline-secondary">
                                  <i class="tf-icons bx bx-edit-alt"></i><span class="ms-2">Edit</span>
                                </button></td>
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
<script src="assetsdash/vendor/libs/datatables/jquery.dataTables.js"></script>
<script src="assetsdash/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="assetsdash/vendor/libs/datatables-responsive/datatables.responsive.js"></script>
<script src="assetsdash/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js"></script>
<script src="assetsdash/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.js"></script>
<script src="assetsdash/vendor/libs/datatables-buttons/datatables-buttons.js"></script>
<script src="assetsdash/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js"></script>
<script src="assetsdash/vendor/libs/jszip/jszip.js"></script>
<script src="assetsdash/vendor/libs/pdfmake/pdfmake.js"></script>
<script src="assetsdash/js/form-layouts.js"></script>
<script src="assetsdash/js/tables-datatables-basic.js"></script>
<script>
    $(document).ready( function () {
    $('#daftarpendaftar').DataTable();
} );
</script>
