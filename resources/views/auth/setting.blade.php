@include('app.auth.app', ['pagetitle' => $pagetitle, 'setting' => 'active'])

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">SmunelJC /</span> Setting
        </h4>
        <div class="row match-height mb-4">
            <!-- Basic Layout & Basic with Icons -->
                <!-- Basic Layout -->
                <div class="col-lg-6 mb-4">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Pengaturan Pendaftaran</h5> <small class="text-muted float-end"></small>
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
                            <form action="{{route('setting.store')}}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-company">Kode</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="KodeDaftar" class="form-control" id="basic-default-company"
                                            placeholder="Kode Pendaftaran" value="{{$settings->where('NamaSetting', 'KodeDaftar')->first()->Value}}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-message">Pesan WA</label>
                                    <div class="col-sm-10">
                                        <textarea id="basic-default-message" name="PesanDefault" class="form-control"
                                            placeholder="Minimal Berisi Teks Selamat Datang, dan Link Grup"
                                            aria-label="Minimal Berisi Teks Selamat Datang, dan Link Grup"
                                            aria-describedby="basic-icon-default-message2" style="height: 300px">{{$settings->where('NamaSetting', 'PesanDefault')->first()->Value}}</textarea>
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Basic with Icons -->
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Pengaturan Website</h5> <small class="text-muted float-end"></small>
                        </div>
                        <div class="card-body">
                            <form action="{{route('setting.update')}}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-company">Tahun</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="P1" class="form-control" id="basic-default-company"
                                            placeholder="Value" value="{{$settings->find(1)->Value}}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-company">NoTelp</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="P2" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control" id="basic-default-company"
                                            placeholder="Value" value="{{$settings->find(2)->Value}}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-company">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="P3" class="form-control" id="basic-default-company"
                                            placeholder="Value" value="{{$settings->find(3)->Value}}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-company">Alamat</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="P4" class="form-control" id="basic-default-company"
                                            placeholder="Value" value="{{$settings->find(4)->Value}}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-company">Link Video</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="P5" class="form-control" id="basic-default-company"
                                            placeholder="Value" value="{{$settings->find(5)->Value}}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-company">Head Text</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="P6" class="form-control" id="basic-default-company"
                                            placeholder="Value" value="{{$settings->find(6)->Value}}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-message">Sub Head Text</label>
                                    <div class="col-sm-10">
                                        <textarea id="basic-default-message" class="form-control"
                                            placeholder="Text"
                                            aria-label="Text" name="P7"
                                            aria-describedby="basic-icon-default-message2">{{$settings->find(7)->Value}}</textarea>
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

@include('app.auth.footer')
