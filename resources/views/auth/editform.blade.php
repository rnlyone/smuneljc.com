@guest
@include('app.tamu.app', ['pagetitle' => $pagetitle])
@endguest

@auth
@include('app.auth.app', ['pagetitle' => $pagetitle, 'pendaftar' => 'active'])
@endauth
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            @guest
            <span class="text-muted fw-light">SmunelJC / Pendaftar /</span> Edit Formulir
            @endguest
            @auth
            <span class="text-muted fw-light">SmunelJC / <a href="/pendaftar">Pendaftar</a> /</span> Edit Formulir
            @endauth
        </h4>
        <div class="row mb-4">
            <!-- Browser Default -->
            <div class="col-md mb-4 mb-md-0">
                <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Edit Formulir</h5> <a href="#" data-bs-target="#modalHapus" data-bs-toggle="modal" data-bs-dismiss="modal"><small class="float-end">Hapus Formulir</small></a>
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
                        <form action="/daftar/{{$form->NISN}}/update" method="POST" class="needs-validation">
                            @csrf
                            <input type="text" name="id" value="{{$form->id}}" hidden>
                            <div class="mb-3">
                                <label class="form-label" for="bs-validation-name">Nama Lengkap</label>
                                <input type="text" name="NamaLengkap" id="basic-default-phone"
                                    class="form-control phone-mask" placeholder="Nama Lengkap Kamu"
                                    value="{{$form->NamaLengkap}}" required />
                                <div class="valid-feedback"> Terlihat Baik! </div>
                                <div class="invalid-feedback"> Masukkan Nama mu. </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="bs-validation-name">Nomor Induk Siswa Nasional
                                    (NISN)</label>
                                <input type="text" name="NISN" class="form-control" id="bs-validation-name"
                                    placeholder="00123456789" required value="{{$form->NISN}}"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                                <div class="valid-feedback"> Terlihat Baik! </div>
                                <div class="invalid-feedback"> Masukkan NISN mu. </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="bs-validation-name">Kelas / Gugus</label>
                                <input type="text" name="Kelas" class="form-control" id="bs-validation-name"
                                    placeholder="X MIPA 0 / Gugus 3" required value="{{$form->Kelas}}"/>
                                <div class="valid-feedback"> Terlihat Baik! </div>
                                <div class="invalid-feedback"> Masukkan Kelas mu. </div>
                            </div>
                            <div class="mb-3">
                                <label class="d-block form-label">Jenis Kelamin</label>
                                <div class="form-check mb-2">
                                    <input type="radio" id="bs-validation-radio-male" name="JK" class="form-check-input"
                                        value="pria" required @if ($form->JK == 'pria') checked @endif >
                                    <label class="form-check-label" for="bs-validation-radio-male">Laki-laki</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="bs-validation-radio-female" name="JK"
                                        class="form-check-input" value="wanita" required @if ($form->JK == 'wanita') checked @endif />
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
                                        value="{{$form->NoWA}}">
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
                                        value="{{$form->Instagram}}">
                                </div>
                                <div class="valid-feedback"> Terlihat Baik! </div>
                                <div class="invalid-feedback"> Masukkan Username mu. </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="bs-validation-name">PIN</label>
                                <input type="text" class="form-control" id="bs-validation-name"
                                    placeholder="X MIPA 0 / Gugus 3" value="{{$form->PIN}}" disabled/>
                                <div class="valid-feedback"> Terlihat Baik! </div>
                                <div class="invalid-feedback"> Masukkan Kelas mu. </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalHapus" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalToggleLabel">Hapus Formulir</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Apakah kamu yakin untuk menghapus formulir ini?
        </div>
        <div class="modal-footer">
          <a href="/daftar/{{$form->NISN}}/destroy" class="btn btn-danger">Hapus Formulir</a>
        </div>
      </div>
    </div>
  </div>

@guest
    @include('app.tamu.footer')
@endguest

@auth
 @include('app.auth.footer')
@endauth


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

