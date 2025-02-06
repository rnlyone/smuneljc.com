@auth
@include('app.auth.app', ['pagetitle' => $pagetitle, 'pengurus' => 'active'])
@endauth
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            @guest
            <span class="text-muted fw-light">SmunelJC / pengurus /</span> Edit Pengurus
            @endguest
            @auth
            <span class="text-muted fw-light">SmunelJC / <a href="/pengurus">pengurus</a> /</span> Edit Pengurus
            @endauth
        </h4>
        <div class="row mb-4">
            <!-- Browser Default -->
            <div class="col-md mb-4 mb-md-0">
                <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Edit Pengurus</h5> <a href="#" data-bs-target="#modalHapus" data-bs-toggle="modal" data-bs-dismiss="modal"><small class="float-end">Hapus Formulir</small></a>
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
                        <form action="{{route('pengurus.update', ['penguru' => $orang->id])}}" method="POST" class="needs-validation" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="bs-validation-name">Nama Lengkap</label>
                                <input type="text" name="NamaLengkap" id="basic-default-phone"
                                    class="form-control phone-mask" placeholder="Nama Lengkap Kamu"
                                    value="{{$orang->NamaLengkap}}" required />
                                <div class="valid-feedback"> Terlihat Baik! </div>
                                <div class="invalid-feedback"> Masukkan Nama mu. </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="bs-validation-name">Image Path</label>
                                <input type="file" name="ImagePath" class="form-control" id="image-upload" accept=".jpg, .png"/>
                                <img id="image-preview" src="#" alt="Image Preview" style="display: none; max-width: 100%; height: auto; margin-top: 10px;" />
                                <div class="valid-feedback"> Terlihat Baik! </div>
                                <div class="invalid-feedback"> Masukkan Gambar mu. </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="bs-validation-name">LinkedIn</label>
                                <input type="text" name="LinkedIn" class="form-control" id="bs-validation-name"
                                    placeholder="LinkedIn Kamu" required value="{{$orang->LinkedIn}}"/>
                                <div class="valid-feedback"> Terlihat Baik! </div>
                                <div class="invalid-feedback"> Masukkan LinkedIn mu. </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="bs-validation-name">Discord</label>
                                <input type="text" name="Discord" class="form-control" id="bs-validation-name"
                                    placeholder="Discord Kamu" required value="{{$orang->Discord}}"/>
                                <div class="valid-feedback"> Terlihat Baik! </div>
                                <div class="invalid-feedback"> Masukkan Discord mu. </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-company">Instagram</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-company2" class="input-group-text">@</span>
                                    <input type="text" name="Instagram" id="basic-icon-default-company" class="form-control"
                                        placeholder="smuneljc (isi angka 0 jika tidak memiliki Instagram)" required
                                        value="{{$orang->Instagram}}">
                                </div>
                                <div class="valid-feedback"> Terlihat Baik! </div>
                                <div class="invalid-feedback"> Masukkan Username mu. </div>
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
          <a href="/pengurus/{{$orang->id}}/destroy" class="btn btn-danger">Hapus Formulir</a>
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
    document.getElementById('image-upload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            if (!['image/jpeg', 'image/png'].includes(file.type)) {
                alert('Invalid file type. Only JPG and PNG are allowed.');
                event.target.value = '';
                document.getElementById('image-preview').style.display = 'none';
            } else {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imagePreview = document.getElementById('image-preview');
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                    if (window.innerWidth >= 1024) { // Check if the agent is desktop
                        imagePreview.style.maxWidth = '50%';
                    } else {
                        imagePreview.style.maxWidth = '100%';
                    }
                };
                reader.readAsDataURL(file);
            }
        }
    });
</script>
