@include('katsudo.layouts.header')
{{-- @include('layouts.pagetitle') --}}

<picture>
    <video id="scanner" allow="camera" style="width: 100%; height:auto; margin:auto"></video>
    <p id="scanned-result" style="    font-size: 8px;
    color: var(--secondary);
    font-weight: 400;
    margin: 0;" class="mx-auto"></p>
</picture>

<section class="un-page-components un-my-account">
        <div class="bg-white  pt-0 padding-20">
            <div class="item-card-nft rounded-15">
            </div>
        </div>
    <!-- End.content-comp -->
    <div class="space-sticky-footer mb-5 zindex-sticky"></div>
        <div class="footer footer-pages-forms mb-5" style="z-index: 90;">
            <div class="head">
                <div class="my-personal-account">
                    <div class="user">
                        <picture>
                            <source srcset="/storage/profile_pict/itsupp.png" type="image/webp">
                            <img src="images/avatar/11.jpg" alt="">
                        </picture>
                        <div class="txt-user">
                            <h1 id="namapengguna">Nama Pengguna</h1>
                            <p id="usernamepengguna">username</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="un-create-collectibles bg-white">
                <div class="form-group">
                    <label>Nama Tiket</label>
                    <input id="nama_tiket" name="nama_tiket" type="text" class="form-control" disabled>
                </div>
            </div>
            <div class="divider"></div>
            <div class="bg-white py-3 un-creator-ptofile">
                <div class="tab-creatore-profile">
                    <ul class="nav nav-pills nav-pilled-tab w-100 mb-0" id="selector" role="tablist"></ul>
                </div>
            </div>
        </div>
</section>



<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center place__top w-100">
    <div id="Toasterscangagal" class="toast bg-danger" role="alert" aria-live="assertive" aria-atomic="true"
        data-bs-autohide="true" data-bs-delay="3000">
        <div class="toast-body">
            <div class="icon color-white">
                <i class="ri-error-warning-fill"></i>
            </div>
            <div class="content">
                <div class="display__text">
                    <p id="Toasterscangagaltext" class="text-white"></p>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close">
                <i class="ri-close-fill"></i>
            </button>
        </div>
    </div>
</div>

<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center place__top w-100">
    <div id="Toasterscansukses" class="toast bg-success" role="alert" aria-live="assertive" aria-atomic="true"
        data-bs-autohide="true" data-bs-delay="3000">
        <div class="toast-body">
            <div class="icon color-white">
                <i class="ri-error-warning-fill"></i>
            </div>
            <div class="content">
                <div class="display__text">
                    <p id="Toasterscansuksestext" class="text-white"></p>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close">
                <i class="ri-close-fill"></i>
            </button>
        </div>
    </div>
</div>




@include('katsudo.layouts.footer')


<script src="https://code.jquery.com/jquery-3.6.3.min.js"
            integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script>

            let scanner;

            // Meminta izin pengguna untuk menggunakan kamera
            if (navigator.mediaDevices === undefined) {
                navigator.mediaDevices = {};
            }

            if (navigator.mediaDevices.getUserMedia === undefined) {
                navigator.mediaDevices.getUserMedia = function (constraints) {
                    var getUserMedia = navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

                    if (!getUserMedia) {
                        return Promise.reject(new Error('getUserMedia is not implemented in this browser'));
                    }

                    return new Promise(function (resolve, reject) {
                        getUserMedia.call(navigator, constraints, resolve, reject);
                    });
                }
            }



            function changeCamera(index) {
                        Instascan.Camera.getCameras().then(function (cameras) {
                            scanner.start(cameras[index]);
                            localStorage.setItem("selectedCamera", index);
                        });
                        // document.getElementById("cam"+index).setAttribute("nav-link active");

            }

            navigator.mediaDevices.getUserMedia({
                    video: { facingMode: { exact: "environment" } },
                })
                .then(function (stream) {
                    scanner = new Instascan.Scanner({
                        video: document.getElementById('scanner'),
                        mirror: false,
                        scanPeriod: 5
                    });


                    scanner.addListener('scan', function (content) {
                        document.getElementById('scanned-result').innerHTML = content;

                        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                        var formData = new FormData();
                        formData.append("id_event", content);
                        formData.append("_token", token);

                        var form = document.createElement("form");
                        form.setAttribute("method", "post");
                        form.setAttribute("action", "{{route('scan')}}");
                        form.setAttribute("id", "scan-tiket-form");

                        var hiddenField = document.createElement("input");
                        hiddenField.setAttribute("type", "hidden");
                        hiddenField.setAttribute("name", "tokentiket");
                        hiddenField.setAttribute("id", "tokentiket");
                        hiddenField.setAttribute("value", content);

                        var tokenField = document.createElement("input");
                        tokenField.setAttribute("type", "hidden");
                        tokenField.setAttribute("name", "_token");
                        tokenField.setAttribute("value", token);

                        form.appendChild(hiddenField);
                        form.appendChild(tokenField);

                        document.body.appendChild(form);
                        ajaxscan(form);
                    });

                    Instascan.Camera.getCameras().then(function (cameras) {
                        if (cameras.length > 0) {
                            for (var i = 0; i < cameras.length; i++) {
                                var camera = cameras[i];
                                var radio = document.createElement("input");
                                radio.setAttribute("style", "margin-top:0;")
                                radio.setAttribute("name", "camera");
                                radio.setAttribute("id", "cam"+i)
                                radio.setAttribute("value", "Kamera " + i);
                                radio.setAttribute("readonly", "readonly")
                                radio.setAttribute("onclick", "changeCamera("+i+")");
                                radio.setAttribute("data-bs-toggle", "pill")
                                if (i === 0) {
                                    radio.setAttribute("class", "nav-link active");
                                } else {
                                    radio.setAttribute("class", "nav-link");
                                }

                                var label = document.createElement("li");
                                label.appendChild(radio);
                                label.setAttribute("class", "nav-item")

                                document.getElementById("selector").appendChild(label);
                            }

                            // cek localStorage untuk melihat apakah ada indeks kamera yang disimpan
                            var selectedCamera = localStorage.getItem("selectedCamera");
                                if (selectedCamera !== null) {
                                    // pilih kamera yang tersimpan di localStorage
                                    var radioButtons = document.getElementsByName("camera");
                                    radioButtons[selectedCamera].click();
                                }
                        } else {
                            console.error("No cameras found.");
                        }
                    });
                })
                .catch(function (err) {
                    console.log(err);
                });

</script>


<script>
    function ajaxscan(form) {

    // Buat instance dari FormData dan tambahkan nilai dari form
    var formData = new FormData(form);

    // Kirim request ke server dengan AJAX
    $.ajax({
        url: $(form).attr('action'),
        method: $(form).attr('method'),
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            // Ubah nilai elemen pada halaman sesuai dengan response dari server
            console.log(response);
            if (response.response === "sukses") {
                $('#nama_tiket').val(response.nama_ticket);
                $('#id_tiket').val(response.paidtix.id);
                $('#namapengguna').text(response.nama_user);
                $('#usernamepengguna').text(response.username);

                var toastElList = [].slice.call(document.querySelectorAll('#Toasterscansukses'))
                var toastList = toastElList.map(function (toastEl) {
                    return new bootstrap.Toast(toastEl)
                });
                document.getElementById("Toasterscansuksestext").innerHTML = response.message;
                toastList.forEach(toast => toast.show());
            } else {
                if (response.message === "Tiket Sudah Pernah digunakan!") {
                    $('#nama_tiket').val(response.nama_ticket);
                    $('#id_tiket').val(response.paidtix.id);
                    $('#namapengguna').text(response.nama_user);
                    $('#usernamepengguna').text(response.username);
                } else {
                    $('#nama_tiket').val("Tidak ditemukan");
                    $('#id_tiket').val("Tidak ditemukan");
                    $('#namapengguna').text("Tidak ditemukan");
                    $('#usernamepengguna').text("Tidak ditemukan");
                }
                var toastElList = [].slice.call(document.querySelectorAll('#Toasterscangagal'))
                var toastList = toastElList.map(function (toastEl) {
                    return new bootstrap.Toast(toastEl)
                });
                document.getElementById("Toasterscangagaltext").innerHTML = response.message;
                toastList.forEach(toast => toast.show());
            }
            // Tampilkan pesan sukses atau gagal
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}
</script>

