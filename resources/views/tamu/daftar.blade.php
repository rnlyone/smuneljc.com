@include('app.tamu.app', ['pagetitle' => $pagetitle])
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">SmunelJC /</span> Pendaftaran
        </h4>
        <div class="row mb-4">
            <!-- Browser Default -->
            <div class="col-md mb-4 mb-md-0">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Formulir Pendaftaran</h5> <a href="https://api.whatsapp.com/send?phone=62{{$settings->where('NamaSetting', 'NoTelp')->first()->Value}}&text=Kak, Butuh Bantuan"><small class="float-end">Perlu Bantuan?</small></a>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <h6 class="alert-heading mb-1"></i>Aree~, Gagal</h6>
                                    <span>{{$error}}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    </button>
                                </div>
                            @endforeach
                        @endif
                        @if (session()->get('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <h6 class="alert-heading mb-1"></i>Yatta!, Sukses</h6>
                                <span> {{session('success')}}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                        @endif
                        <form action="{{route('daftar.store')}}" method="POST" class="needs-validation">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="bs-validation-name">Nama Lengkap</label>
                                <input type="text" name="NamaLengkap" id="basic-default-phone"
                                    class="form-control phone-mask" placeholder="Nama Lengkap Kamu"
                                    value="{{old('NamaLengkap')}}" required />
                                <div class="valid-feedback"> Terlihat Baik! </div>
                                <div class="invalid-feedback"> Masukkan Nama mu. </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="bs-validation-name">Nomor Induk Siswa Nasional
                                    (NISN)</label>
                                <input type="text" name="NISN" class="form-control" id="bs-validation-name"
                                    placeholder="00123456789" required value="{{old('NISN')}}"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                                <div class="valid-feedback"> Terlihat Baik! </div>
                                <div class="invalid-feedback"> Masukkan NISN mu. </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="bs-validation-name">Kelas / Gugus</label>
                                <input type="text" name="Kelas" class="form-control" id="bs-validation-name"
                                    placeholder="X MIPA 0 / Gugus 3" required value="{{old('Kelas')}}"/>
                                <div class="valid-feedback"> Terlihat Baik! </div>
                                <div class="invalid-feedback"> Masukkan Kelas mu. </div>
                            </div>
                            <div class="mb-3">
                                <label class="d-block form-label">Jenis Kelamin</label>
                                <div class="form-check mb-2">
                                    <input type="radio" id="bs-validation-radio-male" name="JK" class="form-check-input"
                                        value="pria" required @if (old('JK') == 'pria') checked @endif >
                                    <label class="form-check-label" for="bs-validation-radio-male">Laki-laki</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="bs-validation-radio-female" name="JK"
                                        class="form-check-input" value="wanita" required @if (old('JK') == 'wanita') checked @endif />
                                    <label class="form-check-label" for="bs-validation-radio-female">Perempuan</label>
                                </div>
                                <div class="valid-feedback"> Terlihat Baik! </div>
                                <div class="invalid-feedback"> Masukkan Gender mu. </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-phone">Nomor WhatsApp</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class="bx bx-phone"></i></span>
                                    <input type="text" id="basic-icon-default-phone" name="NoWA"
                                        class="form-control phone-mask" placeholder="081234567890"
                                        aria-label="081234567890" aria-describedby="basic-icon-default-phone2"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                        value="{{old('NoWA')}}">
                                </div>
                                <div class="valid-feedback"> Terlihat Baik! </div>
                                <div class="invalid-feedback"> Masukkan Nomor mu. </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-company">Instagram</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-company2" class="input-group-text">@</span>
                                    <input type="text" name="Instagram" id="basic-icon-default-company" class="form-control"
                                        placeholder="smuneljc (isi angka 0 jika tidak memiliki Instagram)" required
                                        value="{{old('Instagram')}}">
                                </div>
                                <div class="valid-feedback"> Terlihat Baik! </div>
                                <div class="invalid-feedback"> Masukkan Username mu. </div>
                            </div>
                              <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="basic-default-password">PIN</label>
                                <div class="input-group input-group-merge">
                                  <input type="password" name="PIN" id="basic-default-password" class="form-control"
                                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7; (6 Digit)"
                                  aria-describedby="basic-default-password3"
                                  required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                  maxlength="6"/>
                                  <span class="input-group-text cursor-pointer" id="basic-default-password3"><i class="bx bx-hide"></i></span>
                                </div>
                                <div class="form-text"> <span  data-bs-toggle="tooltip" data-bs-offset="0,8" data-bs-placement="top" data-color="blue" title="PIN membuatmu bisa mengedit formulir yang kamu pernah buat">Apa itu PIN?</span> </div>
                              </div>
                              <div class="mb-3">
                                <label class="form-label" for="bs-validation-name">Kode Pendaftaran</label>
                                <input type="text" name="KodeDaftar" class="form-control" id="bs-validation-name"
                                    placeholder="Kode Pendaftaran" oninput="this.value = this.value.toUpperCase()" required value="{{old('KodeDaftar')}}"/>
                                <div class="valid-feedback"> Terlihat Baik! </div>
                                <div class="invalid-feedback"> Masukkan Kode Pendaftaran mu. </div>
                                <div class="form-text"> <span  data-bs-toggle="tooltip"
                                    data-bs-offset="0,8" data-bs-placement="top" data-color="blue"
                                    title="Kode ini disebarkan di masing-masing grup. kalau kamu tidak tahu, hubungi admin dengan menekan 'Perlu Bantuan?'.">Apa itu Kode Pendaftaran?</span> </div>
                            </div>
                              <div class="mb-3">
                                <div class="form-check">
                                  <input type="checkbox" class="form-check-input" id="bs-validation-checkbox" required="">
                                  <label class="form-check-label" for="bs-validation-checkbox">Saya telah bersedia untuk mengikuti aturan yang telah
                                    ditetapkan oleh SmunelJC</label>
                                  <div class="invalid-feedback"> Kamu Harus Setuju Sebelum Submit.</div>
                                </div>
                              </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md mb-4 mb-md-0">
                <div class="card">
                    <h5 class="card-header">List Pendaftar</h5>
                    <div class="card-datatable table-responsive m-2">
                      <table id="daftarpendaftar" class="dt-multilingual table table-bordered">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>NISN</th>
                            <th>Edit</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendaftars as $i => $p)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$p->NamaLengkap}}</td>
                                <td>
                                    @php
                                        $count = strlen($p->NISN) - 6;
                                        $output = substr_replace($p->NISN, str_repeat('*', $count), 3, $count);
                                    @endphp
                                    {{$output}}</td>
                                <td><button type="button" class="btn btn-icon btn-outline-primary"
                                    data-bs-toggle="modal" data-bs-target="#modalpin{{$p->NISN}}">
                                    <span class="tf-icons bx bx-edit-alt"></span>
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
</div>

@foreach ($pendaftars as $p)
<div class="modal modal-transparent fade" id="modalpin{{$p->NISN}}" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <a href="javascript:void(0);" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></a>
          <p class="text-white text-large fw-light mb-3">Masukkan PIN untuk mengedit "{{$p->NamaLengkap}}"</p>
          <form action="/daftar/{{$p->NISN}}/pinauth" method="post">
            @csrf
          <div class="input-group input-group-lg mb-3">
            <input type="text" name="PIN" class="form-control bg-white border-0" placeholder="PIN Kamu (6 Digit)" aria-describedby="subscribe">
            <button class="btn btn-primary" type="submit" id="subscribe">Edit Form</button>
          </div>
          </form>
          <div class="text-start text-white opacity-50">PIN dibutuhkan untuk mengedit / menghapus form kamu</div>
        </div>
      </div>
    </div>
  </div>
@endforeach

@include('app.tamu.footer')


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

