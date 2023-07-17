<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="Website Resmi Ekstrakulikuler Jepang SMA Negeri 5 Makassar" />
    <meta name="keywords"
        content="HTML, CSS, JavaScript, Bootstrap, jQuery, Rakon, Themeforest, Template, envato, SASS, SCSS, HTML5, landing page, SaaS Product, SaaS Modern,  MultiPurpose, Crypto, Currency, ICO, Hosting, Agency, Mobile, App, Interior, Charity" />
    <meta name="author" content="Rakon - Creative Multi-Purpose HTML5 Templates" />

    <title>SmunelJC</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="assetshome/img/favicon.ico" type="image/x-icon" />
    <!-- Bootstrap 4.5 -->
    <link rel="stylesheet" href="assetshome/css/bootstrap.min.css" type="text/css" />
    <!-- animate -->
    <link rel="stylesheet" href="assetshome/css/animate.css" type="text/css" />
    <!-- Swiper -->
    <link rel="stylesheet" href="assetshome/css/swiper.min.css" />
    <!-- icons -->
    <link rel="stylesheet" href="assetshome/css/icons.css" type="text/css" />
    <link rel="stylesheet" href="assetsdash/vendor/fonts/boxicons.css" type="text/css" />
    <!-- aos -->
    <link rel="stylesheet" href="assetshome/css/aos.css" type="text/css" />
    <!-- main css -->
    <link rel="stylesheet" href="assetshome/css/main.css" type="text/css" />
    <!-- normalize -->
    <link rel="stylesheet" href="assetshome/css/normalize.css" type="text/css" />

    <!-- js for Brwoser -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Global site tag (gtag.js) - Google Ads: 971083070 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-971083070"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'AW-971083070');

    </script>

    <!-- Event snippet for Website sale conversion page
In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. -->
    <script>
        function gtag_report_conversion(url) {
            var callback = function () {
                if (typeof (url) != 'undefined') {
                    window.location = url;
                }
            };
            gtag('event', 'conversion', {
                'send_to': 'AW-971083070/7bFICNXzudkBEL6ahs8D',
                'transaction_id': '',
                'event_callback': callback
            });
            return false;
        }

    </script>


</head>

<body>
    <div id="wrapper">
        <div id="content">
            <!-- Start header -->
            <header class="header-nav-center active-blue" id="myNavbar">
                <div class="container">
                    <!-- navbar -->
                    <nav class="navbar navbar-expand-lg navbar-light px-sm-0">
                        <a class="navbar-brand" href="/">
                            <img class="logo" src="assetshome/img/logosjc.png" alt="logo" />
                        </a>

                        <button class="navbar-toggler menu ripplemenu" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <svg viewBox="0 0 64 48">
                                <path d="M19,15 L45,15 C70,15 58,-2 49.0177126,7 L19,37"></path>
                                <path d="M19,24 L45,24 C61.2371586,24 57,49 41,33 L32,24"></path>
                                <path d="M45,33 L19,33 C-8,33 6,-2 22,14 L45,37"></path>
                            </svg>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link" href="#Keunggulan">Keunggulan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#Tentang">Tentang</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#Program">Program Kerja</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#Divisi">Divisi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#Tim">Tim Kami</a>
                                </li>

                            </ul>
                            @guest
                                <div class="nav_account btn_demo2">
                                    <a href="daftar" class="btn btn_sm_primary effect-letter rounded-8">
                                        Daftar
                                    </a>
                                </div>
                            @endguest
                            @auth
                                <div class="nav_account btn_demo2">
                                    <a href="dash" class="btn btn_sm_primary effect-letter rounded-8">
                                        Dashboard
                                    </a>
                                </div>
                            @endauth
                        </div>
                    </nav>
                    <!-- End Navbar -->
                </div>
                <!-- end container -->
            </header>
            <!-- End header -->

            <!-- Stat main -->
            <main data-spy="scroll" data-target="#navbar-example2" data-offset="0">
                <!-- Start Banner Section -->
                <section id="Keunggulan" class="demo_1 banner_section banner_demo7">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5 my-auto">
                                <div class="banner_title">
                                    <h1>{{ $settings->where('id', 6)->first()->Value}}</h1>
                                    <p>
                                        {{ $settings->where('id', 7)->first()->Value}}
                                    </p>
                                    <a href="daftar"
                                        class="btn btn_md_primary effect-letter rounded-8 bg-blue c-white">Daftar</a>
                                    <div class="margin-t-8">
                                        <button type="button" class="btn btn_video" data-toggle="modal"
                                            data-src="{{ $settings->where('id', 5)->first()->Value}}"
                                            data-target="#mdllVideo">
                                            <div class="scale rounded-circle play_video">
                                                <i class="tio play_outlined"></i>
                                            </div>
                                            <span class="ml-3 font-s-16 c-dark">Lihat Video</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <img class="ill_05" src="assetshome/img/agency/itsukyodaibanner.png" />
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End Banner -->

                <!-- Start About -->
                <section class="abo_company">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 emo mb-4 mb-lg-0">
                                <div class="gq_item bg-blue">
                                    <span class="d-block c-white font-s-16">Ekstrakulikuler Kreatif</span>
                                    <div class="title_sections">
                                        <img class="mb-3" src="assetshome/img/gif/waving_hand.gif" width="60" />
                                        <h2 class="c-white">Ekskul Jepang Kreatif</h2>
                                        <p class="c-white">
                                            Kegiatan unik, lingkungan yang menyenangkan, pelatihan skill yang membuat
                                            dirimu lebih produktif,
                                            semua bisa kamu dapatkan di Smunel Japanese Community.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 emo mb-4 mb-lg-0">
                                <div class="gq_item ill_item">
                                    <a href="https://www.instagram.com/stories/highlights/17989596841769338/" target="_blank">
                                        <span class="d-block c-dark font-s-16">Prestasifolio</span>
                                        <img class="img-fluid ill_sec" src="assetshome/img/agency/benkyochibi.png" />
                                        <div class="title_sections">
                                            <h2 class="c-dark">Ekstrakulikuler Berprestasi</h2>
                                            <p class="c-gray">
                                                <span class="font-weight-bold">35</span> gelar juara telah kami
                                                dapatkan dalam kurun waktu 5 tahun terakhir.
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 emo mb-4 mb-lg-0">
                                <div class="gq_item ill_item">
                                    <span class="d-block c-dark font-s-16">Inovasi</span>
                                    <img class="img-fluid ill_sec" src="assetshome/img/agency/furry.png" />
                                    <div class="title_sections">
                                        <h2 class="c-dark">Ektrakulikuler 4.0</h2>
                                        <p class="c-gray">
                                            Mewujudkan Smunel Japanese Community sebagai ekskul yang tidak pernah
                                            berhenti berinovasi.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End. About -->

                <!-- Start Agency About -->
                <section class="about_agency padding-t-12" id="Tentang">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="title_sections mb-0">
                                    <div class="before_title">
                                        <span>Ekstrakulikuler Budaya</span>
                                        <span class="c-blue">Jepang</span>
                                    </div>
                                    <h2>Ekskul Jepang di SMA Negeri 5 Makassar 👋</h2>
                                    <p>
                                        SJC / SmunelJC adalah singkatan dari Smunel Japanese Community
                                        yang berarti Komunitas Jepang yang berada di SMA Negeri 5 Makassar.
                                    </p>
                                    <p>
                                        Smunel Japanese Community adalah ekstrakulikuler
                                        budaya Jepang yang hadir sejak 2017 menjadi wadah
                                        untuk mengembangkan minat dan prestasi, serta kreativitas
                                        siswa SMA Negeri 5 Makassar khususnya budaya Jepang.
                                    </p>
                                    <p>
                                        Yoroshiku. Itsumo Daiseikou!!
                                    </p>
                                    <img class="inside_pic" src="assetshome/img/agency/98701.jpg" />
                                </div>
                            </div>
                            <div class="col-lg-5 ml-auto">
                                <div class="pro_agency">
                                    <img src="assetshome/img/agency/banneritsuha.jpg" />
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Edn. Agency About -->

                <!-- Start logos -->
                <section id="Program" class="logos_section logos_demo2 padding-t-10">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="title_sections mb-0">
                                    <h2>
                                        Bersama Kami, Menyelenggarakan Program Kerja Spektakuler.
                                    </h2>
                                    <p>
                                        SmunelJC telah beberapa kali menyelenggarakan kegiatan besar,
                                        dan kamu bakal menjadi salah satu yang akan menambahnya.
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6 ml-auto">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="item_logo" data-aos="fade-up" data-aos-delay="0">
                                            <img src="assetshome/img/logos/tenji.png" />
                                            <p class="c-gray">
                                                Kompetisi Tenji Kyanpu 2022.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-5 ml-auto">
                                        <div class="item_logo" data-aos="fade-up" data-aos-delay="100">
                                            <img src="assetshome/img/logos/gakuensai.svg" />
                                            <p class="c-gray">
                                                Festival Sekolah Gakuensai 2023.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="item_logo" data-aos="fade-up" data-aos-delay="200">
                                            <img src="assetshome/img/logos/5thkinenbi.svg" />
                                            <p class="c-gray">
                                                Ulang Tahun SmunelJC yang ke 5 Tahun.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End logos -->

                <!-- Start Services -->
                <section class="products_section product_demo2 features_hosting service_demo3 margin-t-8 padding-t-10"
                    id="Divisi">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 margin-b-3">
                                <div class="title_sections mb-0">
                                    <div class="before_title">
                                        <span>Tiga Divisi</span>
                                        <span class="c-blue">Peminatan</span>
                                    </div>
                                    <h2>Fokuskan minatmu, kembangkan bakatmu.</h2>
                                    <p>
                                        3 Divisi yang siap membuat kamu menjadi lebih fokus
                                        mengembangkan minatmu dalam budaya jepang.
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-7 ml-sm-auto">
                                <div class="row">
                                    <div class="col-md-6 item pr-sm-5 mb-3 mb-sm-5">
                                        <div class="item_pro" data-aos="fade-up" data-aos-delay="0">
                                            <div class="icon_t">
                                                <span class="font-weight-bold text-white">火</span>
                                            </div>
                                            <h3>Divisi Hi</h3>
                                            <p>
                                                Divisi ini fokus dalam pengembangan diri anggota dalam hal seni, visual,
                                                musik, dsb.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 item pr-sm-5 mb-3 mb-sm-5">
                                        <div class="item_pro" data-aos="fade-up" data-aos-delay="100">
                                            <div class="icon_t">
                                                <span class="font-weight-bold text-white">風</span>
                                            </div>
                                            <h3>Divisi Kaze</h3>
                                            <p>
                                                Divisi ini berfokus dalam pengembangan soft-skill anggota dalam
                                                memanajemen organisasi
                                                layaknya di Jepang.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 item pr-sm-5 mb-3 mb-sm-5">
                                        <div class="item_pro" data-aos="fade-up" data-aos-delay="200">
                                            <div class="icon_t">
                                                <span class="font-weight-bold text-white">水</span>
                                            </div>
                                            <h3>Divisi Mizu</h3>
                                            <p>
                                                Divisi ini memiliki fokus mengembangkan akademik anggota untuk
                                                meningkatkan prestasi khususnya dalam hal budaya Jepang.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- .container -->
                </section>
                <!-- End. Services -->

                <!-- Start Works -->
                <section class="works_demo2 gng_serv_about padding-t-10" id="Works">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="title_sections">
                                    <div class="before_title">
                                        <span>Penyaluran</span>
                                        <span class="c-blue">Kreativitas</span>
                                    </div>
                                    <h2>Inovasi Kami</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <a href="https://gakuensai.smuneljc.com" class="item_ig item_mywork">
                                    <div class="mg_img">
                                        <img class="item_pic" src="assetshome/img/agency/0321.png" />
                                    </div>
                                    <div class="info_work">
                                        <h4>
                                            Gakuensai ditayangkan live di Gakuensai App.
                                        </h4>
                                        <p>
                                            Gakuensai 2023
                                        </p>
                                        <div class="link_view">Show Project</div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4">
                                <div class="item_ig item_mywork">
                                    <div class="icon_played">
                                        <button type="button" class="btn" data-toggle="modal"
                                            data-src="https://www.youtube.com/watch?v=sfNtlzyya4g&t=46s"
                                            data-target="#mdllVideo">
                                            <div class="scale rounded-circle play_video">
                                                <i class="tio play_outlined"></i>
                                            </div>
                                        </button>
                                    </div>
                                    <a href="https://gakuensai.smuneljc.com" class="d-block">
                                        <div class="mg_img">
                                            <img class="item_pic" src="assetshome/img/agency/097.png" />
                                        </div>
                                        <div class="info_work">
                                            <h4>Aplikasi Web Gakuensai.</h4>
                                            <p>
                                                Gakuensai 2023
                                            </p>
                                            <div class="link_view">Show Project</div>
                                        </div>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="section__stories margin-b-6" id="Stories">
                    <div class="container">
                      <div class="swip__stories">
                        <!-- Swiper -->
                        <div class="swiper-container feature_strories">
                          <div class="title_sections">
                            <h3>Karya Anggota Kami</h3>
                          </div>
                          <div class="swiper-wrapper">
                            @foreach ($gallerys as $gallery)
                                <div class="swiper-slide">
                                    <a href="#" class="item">
                                    <div class="img__nature">
                                        <img src="{{$gallery->ImagePath}}">
                                    </div>
                                    <div class="inf__txt">
                                        <span>{{$gallery->Category}}</span>
                                        <h3>{{$gallery->Title}}</h3>
                                        <time>{{$gallery->Author}}</time>
                                    </div>
                                    </a>
                                </div>
                            @endforeach
                          </div>
                          <!-- Add Arrows -->
                          <div class="swiper-button-next">
                            <i class="tio chevron_right"></i>
                          </div>
                          <div class="swiper-button-prev">
                            <i class="tio chevron_left"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                <!-- End. works -->

                <section id="Tim" class="gb_team_te margin-t-12 padding-t-15">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-3 order-3 order-lg-1 mb-3 mb-lg-0">
                                <div class="hg_person">
                                    <img src="{{$penguruses->where('id', 2)->first()->ImagePath}}" />
                                    <div class="txt">
                                        <h4>{{$penguruses->where('id', 2)->first()->NamaLengkap}}</h4>
                                        <p>{{$penguruses->where('id', 2)->first()->Posisi}}</p>
                                    </div>
                                    <div class="so_media horizontal_item">
                                        <a href="{{$penguruses->where('id', 2)->first()->LinkedIn}}" target="_blank"><i
                                            class="bx bxl-linkedin"></i></a>
                                        <a href="{{$penguruses->where('id', 2)->first()->Discord}}" target="_blank"><i
                                            class="bx bxl-discord-alt"></i></a>
                                        <a href="{{$penguruses->where('id', 2)->first()->Instagram}}" target="_blank"
                                            class="active bg-blue"><i
                                            class="bx bxl-instagram-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 mx-auto order-2 order-lg-2 mb-3 mb-lg-0">
                                <div class="hg_person">
                                    <img src="{{$penguruses->where('id', 1)->first()->ImagePath}}" />
                                    <div class="txt">
                                        <h4>{{$penguruses->where('id', 1)->first()->NamaLengkap}}</h4>
                                        <p>{{$penguruses->where('id', 1)->first()->Posisi}}</p>
                                    </div>
                                    <div class="so_media">
                                        <a href="{{$penguruses->where('id', 1)->first()->LinkedIn}}" target="_blank" class="active bg-blue"><i
                                            class="bx bxl-linkedin"></i></a>
                                        <a href="{{$penguruses->where('id', 1)->first()->Discord}}" target="_blank"><i
                                            class="bx bxl-discord-alt"></i></a>
                                        <a href="{{$penguruses->where('id', 1)->first()->Instagram}}" target="_blank"><i
                                            class="bx bxl-instagram-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 order-4 order-lg-3 mb-3 mb-lg-0">
                                <div class="hg_person">
                                    <img src="{{$penguruses->where('id', 3)->first()->ImagePath}}" />
                                    <div class="txt">
                                        <h4>{{$penguruses->where('id', 3)->first()->NamaLengkap}}</h4>
                                        <p>{{$penguruses->where('id', 3)->first()->Posisi}}</p>
                                    </div>
                                    <div class="so_media horizontal_item">
                                        <a href="{{$penguruses->where('id', 3)->first()->LinkedIn}}" target="_blank"
                                            class="active bg-blue"><i class="bx bxl-linkedin"></i></a>
                                        <a href="{{$penguruses->where('id', 3)->first()->Discord}}" target="_blank"><i
                                            class="bx bxl-discord-alt"></i></a>
                                        <a href="{{$penguruses->where('id', 3)->first()->Instagram}}" target="_blank"><i
                                            class="bx bxl-instagram-alt"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 mr-auto order-5 order-lg-7 mb-3 mb-lg-0">
                                <div class="hg_person">
                                    <img src="{{$penguruses->where('id', 4)->first()->ImagePath}}" />
                                    <div class="txt">
                                        <h4>{{$penguruses->where('id', 4)->first()->NamaLengkap}}</h4>
                                        <p>{{$penguruses->where('id', 4)->first()->Posisi}}</p>
                                    </div>
                                    <div class="so_media horizontal_item">
                                        <a href="{{$penguruses->where('id', 4)->first()->LinkedIn}}" target="_blank"><i
                                            class="bx bxl-linkedin"></i></a>
                                        <a href="{{$penguruses->where('id', 4)->first()->Discord}}" target="_blank"><i
                                            class="bx bxl-discord-alt"></i></a>
                                        <a href="{{$penguruses->where('id', 4)->first()->Instagram}}" target="_blank"
                                            class="active bg-blue"><i
                                            class="bx bxl-instagram-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100 order-sm-4"></div>
                            <div class="col-lg-4 order-1 order-lg-3 text-center mx-auto">
                                <div class="title_sections">
                                    <div class="before_title">
                                        <span>Kepengurusan</span>
                                        <span class="c-blue">2022-2023</span>
                                    </div>
                                    <h2>Bertemu dengan tim hebat kami.</h2>
                                </div>
                            </div>
                            <div class="col-lg-3 mr-auto order-6 order-lg-8 mb-3 mb-lg-0">
                                <div class="hg_person">
                                    <img src="{{$penguruses->where('id', 5)->first()->ImagePath}}" />
                                    <div class="txt">
                                        <h4>{{$penguruses->where('id', 5)->first()->NamaLengkap}}</h4>
                                        <p>{{$penguruses->where('id', 5)->first()->Posisi}}</p>
                                    </div>
                                    <div class="so_media">
                                        <a href="{{$penguruses->where('id', 5)->first()->LinkedIn}}" target="_blank" class="active bg-blue"><i
                                            class="bx bxl-linkedin"></i></a>
                                        <a href="{{$penguruses->where('id', 5)->first()->Discord}}" target="_blank"><i
                                            class="bx bxl-discord-alt"></i></a>
                                        <a href="{{$penguruses->where('id', 5)->first()->Instagram}}" target="_blank"><i
                                            class="bx bxl-instagram-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 order-7 order-lg-9 mb-lg-0">
                                <div class="hg_person">
                                    <img src="{{$penguruses->where('id', 6)->first()->ImagePath}}" />
                                    <div class="txt">
                                        <h4>{{$penguruses->where('id', 6)->first()->NamaLengkap}}</h4>
                                        <p>{{$penguruses->where('id', 6)->first()->Posisi}}</p>
                                    </div>
                                    <div class="so_media horizontal_item">
                                        <a href="{{$penguruses->where('id', 6)->first()->LinkedIn}}" target="_blank"><i
                                            class="bx bxl-linkedin"></i></a>
                                        <a href="{{$penguruses->where('id', 6)->first()->Discord}}" target="_blank"><i
                                            class="bx bxl-discord-alt"></i></a>
                                        <a href="{{$penguruses->where('id', 6)->first()->Instagram}}" target="_blank"
                                            class="active bg-blue"><i
                                            class="bx bxl-instagram-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End. Team -->
                {{-- <hr> --}}

                        <!-- Start team_static_style -->
        {{-- <section id="Tim" class="team_static_style team_default_style">
            <div class="container">

              <div class="row justify-content-center text-center">
                <div class="col-lg-5">
                  <div class="title_sections_inner margin-b-5">
                    <h2>Pengurus 2022/2023</h2> <hr>
                  </div>
                </div>
              </div>

              <div class="row justify-content-lg-center">

                <div class="col-md-6 col-lg-3 item">
                  <div class="item_group">
                    <div class="img_group">
                        <img src="{{$penguruses->where('id', 2)->first()->ImagePath}}" />
                    </div>
                    <div class="personal_info">
                      <h3>{{$penguruses->where('id', 2)->first()->NamaLengkap}}</h3>
                      <p>{{$penguruses->where('id', 2)->first()->Posisi}}</p>
                    </div>
                    <div class="social_text">
                        <a href="{{$penguruses->where('id', 2)->first()->LinkedIn}}">
                          Linkedin
                        </a>
                        <a href="{{$penguruses->where('id', 2)->first()->Instagram}}">
                          Instagram
                        </a>
                        <a href="{{$penguruses->where('id', 2)->first()->Discord}}">
                          Discord
                        </a>
                      </div>
                  </div>
                </div>

                <div class="col-lg-4 item text-center mx-auto my-auto">
                  <div class="title_sections_inner">
                    <div class="before_title">
                        <span>Kepengurusan</span>
                        <span class="c-blue">2022/2023</span>
                    </div>
                    <h2>Bertemu dengan tim hebat kami.</h2>
                  </div>
                </div>

                <div class="col-md-6 col-lg-3 item">
                    <div class="item_group">
                        <div class="img_group">
                            <img src="{{$penguruses->where('id', 3)->first()->ImagePath}}" />
                        </div>
                        <div class="personal_info">
                          <h3>{{$penguruses->where('id', 3)->first()->NamaLengkap}}</h3>
                          <p>{{$penguruses->where('id', 3)->first()->Posisi}}</p>
                        </div>
                        <div class="social_text">
                            <a href="{{$penguruses->where('id', 3)->first()->LinkedIn}}">
                                Linkedin
                              </a>
                              <a href="{{$penguruses->where('id', 3)->first()->Instagram}}">
                                Instagram
                              </a>
                              <a href="{{$penguruses->where('id', 3)->first()->Discord}}">
                                Discord
                              </a>
                          </div>
                      </div>
                </div>

                <div class="col-md-6 col-lg-3 item">
                    <div class="item_group">
                        <div class="img_group">
                            <img src="{{$penguruses->where('id', 4)->first()->ImagePath}}" />
                        </div>
                        <div class="personal_info">
                          <h3>{{$penguruses->where('id', 4)->first()->NamaLengkap}}</h3>
                          <p>{{$penguruses->where('id', 4)->first()->Posisi}}</p>
                        </div>
                        <div class="social_text">
                            <a href="{{$penguruses->where('id', 4)->first()->LinkedIn}}">
                                Linkedin
                              </a>
                              <a href="{{$penguruses->where('id', 4)->first()->Instagram}}">
                                Instagram
                              </a>
                              <a href="{{$penguruses->where('id', 4)->first()->Discord}}">
                                Discord
                              </a>
                          </div>
                      </div>
                </div>

                <div class="col-md-6 col-lg-3 order-2 order-lg-2 mb-3 mb-lg-0 item mx-auto">
                    <div class="item_group">
                        <div class="img_group">
                            <img src="{{$penguruses->where('id', 1)->first()->ImagePath}}" />
                        </div>
                        <div class="personal_info">
                          <h3>{{$penguruses->where('id', 1)->first()->NamaLengkap}}</h3>
                          <p>{{$penguruses->where('id', 1)->first()->Posisi}}</p>
                        </div>
                        <div class="social_text">
                            <a href="{{$penguruses->where('id', 1)->first()->LinkedIn}}">
                                Linkedin
                              </a>
                              <a href="{{$penguruses->where('id', 1)->first()->Instagram}}">
                                Instagram
                              </a>
                              <a href="{{$penguruses->where('id', 1)->first()->Discord}}">
                                Discord
                              </a>
                          </div>
                      </div>
                </div>

                <div class="col-md-6 col-lg-3 item">
                    <div class="item_group">
                        <div class="img_group">
                            <img src="{{$penguruses->where('id', 5)->first()->ImagePath}}" />
                        </div>
                        <div class="personal_info">
                          <h3>{{$penguruses->where('id', 5)->first()->NamaLengkap}}</h3>
                          <p>{{$penguruses->where('id', 5)->first()->Posisi}}</p>
                        </div>
                        <div class="social_text">
                            <a href="{{$penguruses->where('id', 5)->first()->LinkedIn}}">
                                Linkedin
                              </a>
                              <a href="{{$penguruses->where('id', 5)->first()->Instagram}}">
                                Instagram
                              </a>
                              <a href="{{$penguruses->where('id', 5)->first()->Discord}}">
                                Discord
                              </a>
                          </div>
                      </div>
                </div>

                <div class="w-100 d-none d-md-block"></div>
                <div class="col-md-6 col-lg-3 item">
                    <div class="item_group">
                        <div class="img_group">
                            <img src="{{$penguruses->where('id', 6)->first()->ImagePath}}" />
                        </div>
                        <div class="personal_info">
                          <h3>{{$penguruses->where('id', 6)->first()->NamaLengkap}}</h3>
                          <p>{{$penguruses->where('id', 6)->first()->Posisi}}</p>
                        </div>
                        <div class="social_text">
                            <a href="{{$penguruses->where('id', 6)->first()->LinkedIn}}">
                                Linkedin
                              </a>
                              <a href="{{$penguruses->where('id', 6)->first()->Instagram}}">
                                Instagram
                              </a>
                              <a href="{{$penguruses->where('id', 6)->first()->Discord}}">
                                Discord
                              </a>
                          </div>
                      </div>
                </div>

              </div>
            </div>
        </section> --}}
          <!-- End. team_static_style -->



                <!-- Start Testimonial -->
                <section class="testimonial_demo2 padding-t-12">
                    <div class="container">
                        <div class="row justify-content-center text-center">
                            <div class="col-lg-5">
                                <div class="title_sections_inner margin-b-5">
                                    <h2>Kata Alumni</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-lg-5 mb-4 mb-lg-0">
                                <div class="item_mmon">
                                    <div class="profile_user">
                                        <img src="assetshome/img/persons/rossensei.png" />
                                        <div class="categ">
                                            <span>Pembina SJC</span>
                                        </div>
                                    </div>
                                    <div class="info_persons">
                                        <p>
                                            "Smunel Japanese Community adalah ekstrakulikuler tepat
                                            untuk mengembangkan diri dalam hal budaya Jepang
                                            karena memiliki lingkungan sosial yang baik serta progresif."
                                        </p>
                                        <h5>Rosneneng Juanda</h5>
                                        <span>Guru Bahasa Jepang SMAN 5 Makassar</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="item_mmon">
                                    <div class="profile_user">
                                        <img src="assetshome/img/persons/nabil.png" />
                                        <div class="categ">
                                            <span>Ketua Umum 2020/2021</span>
                                        </div>
                                    </div>
                                    <div class="info_persons">
                                        <p>
                                            "Jujur, SJC telah menjadi tempat terbaik ku mengembangkan diri.
                                            Terima kasih telah memberikan saya tempat dan kesempatan
                                            untuk berkembang."
                                        </p>
                                        <h5>Muhammad Nabil Taufik</h5>
                                        <span>Mahasiswa Sastra Jepang UNHAS</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End. Testimonial -->



                <!-- Start Team -->
            </main>
            <!-- end main -->
        </div>
        <!-- [id] content -->

        <!-- footr -->
        <footer class="defalut-footer foot_demo3 light margin-t-12 padding-py-8">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                        <div class="item_about">
                            <a class="logo" href="agency.html">
                                <img src="assetshome/img/logosjc.png" alt="" />
                            </a>
                            <p>
                                Smunel Japanese Community adalah bagian dari Organisasi Siswa Intra Sekolah
                                berbasis di SMA Negeri 5 Makassar
                            </p>
                            <div class="address">
                                <span>{{ $settings->where('id', 4)->first()->Value}}</span>
                                <span>Telepon: <a href="tel:{{ $settings->where('id', 2)->first()->Value}}">{{ $settings->where('id', 2)->first()->Value}}</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-6 col-lg-2">
                        <div class="item_links">
                            <h4>Sosial Media</h4>
                            @foreach ($socials as $social)
                                <a class="nav-link" href="{{$social->Link}}">{{$social->Platform}}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-6 col-md-6 col-lg-2">
                        <div class="item_links">
                            <h4>Halaman Terkait</h4>
                            @foreach ($pages as $page)
                                <a class="nav-link" href="{{$page->Link}}">{{$page->PageName}}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mt-4 mt-lg-0">
                        <div class="item_subscribe">
                            <h4>Kirim Pesan</h4>
                            <p>
                                Ada pertanyaan?<br />
                                tulis pesanmu dan kirimkan sekarang!
                            </p>
                            <form action="/kirimpesan" method="POST" class="form-row">
                                @csrf
                                <div class="col-md-11 form-group subscribebtn">
                                    <div class="item_input">
                                        <input type="text" name="pesan" class="form-control rounded-8" id="pesankesan"
                                            placeholder="Masukkan Pesanmu" aria-describedby="emailHelp" />
                                        <button type="submit"  class="btn ripple_circle scale rounded-8 btn_subscribe">
                                            <i class="tio send"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center padding-t-4">
                    <div class="copyright">
                        <span>© {{$settings->where('NamaSetting', 'Tahun')->first()->Value}}
                            <a href="/" target="_blank">SmunelJC</a>
                            All Right Reseved</span>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End. -->

        <!-- Back to top with progress indicator-->
        <div class="prgoress_indicator">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
            </svg>
        </div>

        <!-- Tosts -->
        <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center">
            <div class="toast toast_demo" id="myTost" role="alert" aria-live="assertive" aria-atomic="true"
                data-animation="true" data-autohide="false">
                <div class="toast-body">
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <i class="tio clear"></i>
                    </button>
                    <h5>Konnichiwa 👋</h5>
                    <p>Ayo Gabung SJC <a href="daftar">Join us</a></p>
                </div>
            </div>
        </div>
        <!-- End. Toasts -->

        <!-- Video Modal -->
        <div class="modal mdll_video fade" id="mdllVideo" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <!-- Close -->
            <button type="button" class="close bbt_close ripple_circle" data-dismiss="modal" aria-label="Close">
                <i class="tio clear"></i>
            </button>
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always"
                                allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start Section Loader -->
        <section class="loading_overlay">
            <div class="loader_logo">
                <img class="logo" src="assetshome/img/logosjc.png" />
            </div>
        </section>
        <!-- End. Loader -->
    </div>
    <!-- End. wrapper -->

    <!-- jquery -->
    <script src="assetshome/js/jquery-3.5.0.js" type="text/javascript"></script>
    <!-- jquery-migrate -->
    <script src="assetshome/js/jquery-migrate.min.js" type="text/javascript"></script>
    <!-- popper -->
    <script src="assetshome/js/popper.min.js" type="text/javascript"></script>
    <!-- bootstrap -->
    <script src="assetshome/js/bootstrap.min.js" type="text/javascript"></script>
    <!--
  ============
  vendor file
  ============
   -->
    <!-- particles -->
    <script src="assetshome/js/vendor/particles.min.js" type="text/javascript"></script>
    <!-- TweenMax -->
    <script src="assetshome/js/vendor/TweenMax.min.js" type="text/javascript"></script>
    <!-- ScrollMagic -->
    <script src="assetshome/js/vendor/ScrollMagic.js" type="text/javascript"></script>
    <!-- animation.gsap -->
    <script src="assetshome/js/vendor/animation.gsap.js" type="text/javascript"></script>
    <!-- addIndicators -->
    <script src="assetshome/js/vendor/debug.addIndicators.min.js" type="text/javascript"></script>
    <!-- Swiper js -->
    <script src="assetshome/js/vendor/swiper.min.js" type="text/javascript"></script>
    <!-- countdown -->
    <script src="assetshome/js/vendor/countdown.js" type="text/javascript"></script>
    <!-- simpleParallax -->
    <script src="assetshome/js/vendor/simpleParallax.min.js" type="text/javascript"></script>
    <!-- waypoints -->
    <script src="assetshome/js/vendor/waypoints.min.js" type="text/javascript"></script>
    <!-- counterup -->
    <script src="assetshome/js/vendor/jquery.counterup.min.js" type="text/javascript"></script>
    <!-- charming -->
    <script src="assetshome/js/vendor/charming.min.js" type="text/javascript"></script>
    <!-- imagesloaded -->
    <script src="assetshome/js/vendor/imagesloaded.pkgd.min.js" type="text/javascript"></script>
    <!-- BX-Slider -->
    <script src="assetshome/js/vendor/jquery.bxslider.min.js" type="text/javascript"></script>
    <!-- Sharer -->
    <script src="assetshome/js/vendor/sharer.js" type="text/javascript"></script>
    <!-- sticky -->
    <script src="assetshome/js/vendor/sticky.min.js" type="text/javascript"></script>
    <!-- Aos -->
    <script src="assetshome/js/vendor/aos.js" type="text/javascript"></script>
    <!-- main file -->
    <script src="assetshome/js/main.js" type="text/javascript"></script>
    <!-- agency -->
    <script src="assetshome/js/pages/agency.js" type="text/javascript"></script>

    <script>
        $(document).ready(function() {
            console.log($("#kirimpesan"));
            // $("#pesankesan").on('input', function() {
            //     var oldUrl = $("#kirimpesan").attr("href");
            //     console.log(oldUrl);
            //     var pesan = $(this).val();
            //     var newUrl = oldUrl.replace("{pesan}", pesan);
            // });
        });
        </script>
</body>

</html>
