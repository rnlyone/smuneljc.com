@include('app.auth.app', ['pagetitle' => $pagetitle, 'dashboard' => 'active'])
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">SmunelJC /</span> Dashboard
        </h4>
        <div class="row mb-4">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card h-100">
                  <div class="card-header">
                    <h3 class="card-title mb-2">Halo, {{auth()->user()->name}}</h3>
                    <span class="text-nowrap">Berikut Jumlah Pendaftar</span>
                  </div>
                  <div class="card-body">
                    <div class="row align-items-end">
                      <div class="col-6">
                        <h1 class="display-6 text-primary mb-2 pt-3 pb-1">{{$total2022}}</h1>
                        <small class="d-block mb-3">Orang Yang terdaftar,<br>Lihat Detailnya.</small>
                        <a href="/pendaftar" class="btn btn-sm btn-primary">Lihat Pendaftar</a>
                      </div>
                      <div class="col-6">
                        <img src="assetshome/img/agency/benkyochibi.png" width="100%" height="100%" class="rounded-end" alt="View Sales">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-xl-4 col-xxl-4 mb-xxl-0 mb-4 order-0 order-lg-0">
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title mb-0">Pendaftar Terakhir</h5>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-borderless mb-1">
                      <thead class="border-bottom">
                        <tr>
                          <th class="pt-0">Nama Lengkap</th>
                          <th class="pt-0">WhatsApp</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($latest5 as $person)
                        <tr>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="">
                                  <p class="mb-0 lh-1 text-nowrap"></p>
                                  <small class="text-muted text-nowrap">{{$person->NamaLengkap}}</small>
                                </div>
                              </div>
                            </td>
                            <td>
                                <a href="https://api.whatsapp.com/send?phone=62{{$person->NoWA}}&text=Hai {{$person->NamaLengkap}}, {{$pesandefault->Value}}" target="_blank" class="btn btn-xs btn-outline-success">
                                    <i class="tf-icons bx bx-phone-call"></i><span class="ms-2">WA</span>

                                  </a>
                            </td>
                          </tr>
                        @endforeach
                        @if ($latest5->isEmpty())
                            <tr>
                                <td style="text-align: center; vertical-align: middle;" colspan="2">
                                    Tidak Ada Pendaftar
                                </td>
                            </tr>
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            <!-- Doughnut Chart -->
            <div class="col-lg-4 col-12 mb-4">
                <div class="card">
                <h5 class="card-header">Data Jenis Kelamin</h5>
                <div class="card-body">
                    @if ($latest5->isEmpty())
                        <div class="d-flex justify-content-around">
                            <p>Belum Ada Pendaftar</p>
                        </div>
                    @else
                        <canvas id="doughnutChart" class="chartjs mb-4"></canvas>
                    @endif
                    <ul class="doughnut-legend d-flex justify-content-around ps-0 mb-2 pt-1">
                    <li class="ct-series-0 d-flex flex-column">
                    <li class="ct-series-1 d-flex flex-column">
                        <h5 class="mb-0 fw-bold">Laki-laki</h5>
                        <span class="badge badge-dot my-2 cursor-pointer rounded-pill" style="background-color: rgb(40, 208, 148);width:35px; height:6px;"></span>
                        <div class="text-muted">{{$totaljk[1]}}</div>
                    </li>
                    <li class="ct-series-2 d-flex flex-column">
                        <h5 class="mb-0 fw-bold">Perempuan</h5>
                        <span class="badge badge-dot my-2 cursor-pointer rounded-pill" style="background-color: rgb(253, 172, 52);width:35px; height:6px;"></span>
                        <div class="text-muted">{{$totaljk[3]}}</div>
                    </li>
                    </ul>
                </div>
                </div>
            </div>
            <!-- /Doughnut Chart -->
            <div class="col-xl-8 mb-4 order-lg-0">
                <div class="card h-100">
                  <div class="card-header header-elements">
                    <h5 class="card-title mb-0">Pendaftar Tahun Ke tahun</h5>
                    <div class="card-action-element ms-auto py-0">
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row align-items-end">
                    <canvas id="barChart" class="chartjs"></canvas>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>
@include('app.auth.footer')

<script src="/assetsdash/vendor/libs/chartjs/chartjs.js"></script>

<script>! function () {
    var o = "#836AF9",
        r = "#ffe800",
        t = "#28dac6",
        l = "#EDF1F4",
        i = "#2B9AFF",
        e = "#84D0FF";
    let a, n;
    n = isDarkStyle ? (a = config.colors_dark.borderColor, config.colors_dark.axisColor) : (a = config.colors.borderColor, config.colors.axisColor);
    const d = document.querySelectorAll(".chartjs");
    d.forEach(function (o) {
        o.height = o.dataset.height
    });
    var s = document.getElementById("barChart"),
        s = (s && new Chart(s, {
            type: "bar",
            data: {
                labels: {{$years}},
                datasets: [{
                    data: {{$totaldaftar}},
                    backgroundColor: t,
                    borderColor: "transparent",
                    maxBarThickness: 15,
                    borderRadius: {
                        topRight: 15,
                        topLeft: 15
                    }
                }]
            },
            options: {
                responsive: !0,
                maintainAspectRatio: !1,
                animation: {
                    duration: 500
                },
                plugins: {
                    tooltip: {
                        rtl: isRtl,
                        backgroundColor: config.colors.white,
                        titleColor: config.colors.black,
                        bodyColor: config.colors.black,
                        borderWidth: 1,
                        borderColor: a
                    },
                    legend: {
                        display: !1
                    }
                },
                scales: {
                    x: {
                        grid: {
                            color: a,
                            borderColor: a
                        },
                        ticks: {
                            color: n
                        }
                    },
                    y: {
                        min: 0,
                        max: 50,
                        grid: {
                            color: a,
                            borderColor: a
                        },
                        ticks: {
                            stepSize: 10,
                            tickColor: a,
                            color: n
                        }
                    }
                }
            }
        }), document.getElementById("horizontalBarChart")),
        s = (s && new Chart(s, {
            type: "bar",
            data: {
                labels: ["MON", "TUE", "WED ", "THU", "FRI", "SAT", "SUN"],
                datasets: [{
                    data: [710, 350, 470, 580, 230, 460, 120],
                    backgroundColor: config.colors.info,
                    borderColor: "transparent",
                    maxBarThickness: 15
                }]
            },
            options: {
                indexAxis: "y",
                responsive: !0,
                maintainAspectRatio: !1,
                animation: {
                    duration: 500
                },
                elements: {
                    bar: {
                        borderRadius: {
                            topRight: 15,
                            bottomRight: 15
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        rtl: isRtl,
                        backgroundColor: config.colors.white,
                        titleColor: config.colors.black,
                        bodyColor: config.colors.black,
                        borderWidth: 1,
                        borderColor: a
                    },
                    legend: {
                        display: !1
                    }
                },
                scales: {
                    x: {
                        min: 0,
                        grid: {
                            color: a,
                            borderColor: a
                        },
                        ticks: {
                            color: n
                        }
                    },
                    y: {
                        grid: {
                            borderColor: a,
                            display: !1
                        },
                        ticks: {
                            color: n
                        }
                    }
                }
            }
        }), document.getElementById("lineChart"));
    s && new Chart(s, {
        type: "line",
        data: {
            labels: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120, 130, 140],
            datasets: [{
                data: [80, 150, 180, 270, 210, 160, 160, 202, 265, 210, 270, 255, 290, 360, 375],
                label: "Europe",
                borderColor: config.colors.danger,
                tension: .5,
                pointStyle: "circle",
                backgroundColor: config.colors.danger,
                fill: !1,
                pointRadius: 1,
                pointHoverRadius: 5,
                pointHoverBorderWidth: 5,
                pointBorderColor: "transparent",
                pointHoverBorderColor: config.colors.white,
                pointHoverBackgroundColor: config.colors.danger
            }, {
                data: [80, 125, 105, 130, 215, 195, 140, 160, 230, 300, 220, 170, 210, 200, 280],
                label: "Asia",
                borderColor: config.colors.primary,
                tension: .5,
                pointStyle: "circle",
                backgroundColor: config.colors.primary,
                fill: !1,
                pointRadius: 1,
                pointHoverRadius: 5,
                pointHoverBorderWidth: 5,
                pointBorderColor: "transparent",
                pointHoverBorderColor: config.colors.white,
                pointHoverBackgroundColor: config.colors.primary
            }, {
                data: [80, 99, 82, 90, 115, 115, 74, 75, 130, 155, 125, 90, 140, 130, 180],
                label: "Africa",
                borderColor: r,
                tension: .5,
                pointStyle: "circle",
                backgroundColor: r,
                fill: !1,
                pointRadius: 1,
                pointHoverRadius: 5,
                pointHoverBorderWidth: 5,
                pointBorderColor: "transparent",
                pointHoverBorderColor: config.colors.white,
                pointHoverBackgroundColor: r
            }]
        },
        options: {
            responsive: !0,
            maintainAspectRatio: !1,
            scales: {
                x: {
                    grid: {
                        color: a,
                        borderColor: a
                    },
                    ticks: {
                        color: n
                    }
                },
                y: {
                    scaleLabel: {
                        display: !0
                    },
                    min: 0,
                    max: 400,
                    ticks: {
                        color: n,
                        stepSize: 100
                    },
                    grid: {
                        color: a,
                        borderColor: a
                    }
                }
            },
            plugins: {
                tooltip: {
                    rtl: isRtl,
                    backgroundColor: config.colors.white,
                    titleColor: config.colors.black,
                    bodyColor: config.colors.black,
                    borderWidth: 1,
                    borderColor: a
                },
                legend: {
                    position: "top",
                    align: "start",
                    rtl: isRtl,
                    labels: {
                        usePointStyle: !0,
                        padding: 35,
                        boxWidth: 6,
                        color: n
                    }
                }
            }
        }
    });
    const c = document.getElementById("radarChart");
    if (c) {
        const p = c.getContext("2d").createLinearGradient(0, 0, 0, 150),
            b = (p.addColorStop(0, "rgba(85, 85, 255, 0.9)"), p.addColorStop(1, "rgba(151, 135, 255, 0.8)"), c.getContext("2d").createLinearGradient(0, 0, 0, 150));
        b.addColorStop(0, "rgba(255, 85, 184, 0.9)"), b.addColorStop(1, "rgba(255, 135, 135, 0.8)");
        new Chart(c, {
            type: "radar",
            data: {
                labels: ["STA", "STR", "AGI", "VIT", "CHA", "INT"],
                datasets: [{
                    label: "Donté Panlin",
                    data: [25, 59, 90, 81, 60, 82],
                    fill: !0,
                    pointStyle: "dash",
                    backgroundColor: b,
                    borderColor: "transparent",
                    pointBorderColor: "transparent"
                }, {
                    label: "Mireska Sunbreeze",
                    data: [40, 100, 40, 90, 40, 90],
                    fill: !0,
                    pointStyle: "dash",
                    backgroundColor: p,
                    borderColor: "transparent",
                    pointBorderColor: "transparent"
                }]
            },
            options: {
                responsive: !0,
                maintainAspectRatio: !1,
                animation: {
                    duration: 500
                },
                scales: {
                    r: {
                        ticks: {
                            maxTicksLimit: 1,
                            display: !1,
                            color: n
                        },
                        grid: {
                            color: a
                        },
                        angleLines: {
                            color: a
                        },
                        pointLabels: {
                            color: n
                        }
                    }
                },
                plugins: {
                    legend: {
                        rtl: isRtl,
                        position: "top",
                        labels: {
                            padding: 25,
                            color: n
                        }
                    },
                    tooltip: {
                        rtl: isRtl,
                        backgroundColor: config.colors.white,
                        titleColor: config.colors.black,
                        bodyColor: config.colors.black,
                        borderWidth: 1,
                        borderColor: a
                    }
                }
            }
        })
    }
    s = document.getElementById("polarChart"), s && new Chart(s, {
        type: "polarArea",
        data: {
            labels: ["Africa", "Asia", "Europe", "America", "Antarctica", "Australia"],
            datasets: [{
                label: "Population (millions)",
                backgroundColor: [o, r, "#FF8132", "#299AFF", "#4F5D70", t],
                data: [19, 17.5, 15, 13.5, 11, 9],
                borderWidth: 0
            }]
        },
        options: {
            responsive: !0,
            maintainAspectRatio: !1,
            animation: {
                duration: 500
            },
            scales: {
                r: {
                    ticks: {
                        display: !1,
                        color: n
                    },
                    grid: {
                        display: !1
                    }
                }
            },
            plugins: {
                tooltip: {
                    rtl: isRtl,
                    backgroundColor: config.colors.white,
                    titleColor: config.colors.black,
                    bodyColor: config.colors.black,
                    borderWidth: 1,
                    borderColor: a
                },
                legend: {
                    rtl: isRtl,
                    position: "right",
                    labels: {
                        usePointStyle: !0,
                        padding: 25,
                        boxWidth: 8,
                        color: n
                    }
                }
            }
        }
    }), s = document.getElementById("bubbleChart"), s && new Chart(s, {
        type: "bubble",
        data: {
            animation: {
                duration: 1e4
            },
            datasets: [{
                label: "Dataset 1",
                backgroundColor: o,
                borderColor: o,
                data: [{
                    x: 20,
                    y: 74,
                    r: 10
                }, {
                    x: 10,
                    y: 110,
                    r: 5
                }, {
                    x: 30,
                    y: 165,
                    r: 7
                }, {
                    x: 40,
                    y: 200,
                    r: 20
                }, {
                    x: 90,
                    y: 185,
                    r: 7
                }, {
                    x: 50,
                    y: 240,
                    r: 7
                }, {
                    x: 60,
                    y: 275,
                    r: 10
                }, {
                    x: 70,
                    y: 305,
                    r: 5
                }, {
                    x: 80,
                    y: 325,
                    r: 4
                }, {
                    x: 100,
                    y: 310,
                    r: 5
                }, {
                    x: 110,
                    y: 240,
                    r: 5
                }, {
                    x: 120,
                    y: 270,
                    r: 7
                }, {
                    x: 130,
                    y: 300,
                    r: 6
                }]
            }, {
                label: "Dataset 2",
                backgroundColor: r,
                borderColor: r,
                data: [{
                    x: 30,
                    y: 72,
                    r: 5
                }, {
                    x: 40,
                    y: 110,
                    r: 7
                }, {
                    x: 20,
                    y: 135,
                    r: 6
                }, {
                    x: 10,
                    y: 160,
                    r: 12
                }, {
                    x: 50,
                    y: 285,
                    r: 5
                }, {
                    x: 60,
                    y: 235,
                    r: 5
                }, {
                    x: 70,
                    y: 275,
                    r: 7
                }, {
                    x: 80,
                    y: 290,
                    r: 4
                }, {
                    x: 90,
                    y: 250,
                    r: 10
                }, {
                    x: 100,
                    y: 220,
                    r: 7
                }, {
                    x: 120,
                    y: 230,
                    r: 4
                }, {
                    x: 110,
                    y: 320,
                    r: 15
                }, {
                    x: 130,
                    y: 330,
                    r: 7
                }]
            }]
        },
        options: {
            responsive: !0,
            maintainAspectRatio: !1,
            scales: {
                x: {
                    min: 0,
                    max: 140,
                    grid: {
                        color: a,
                        borderColor: a
                    },
                    ticks: {
                        stepSize: 1,
                        color: n
                    }
                },
                y: {
                    min: 0,
                    max: 400,
                    grid: {
                        color: a,
                        borderColor: a
                    },
                    ticks: {
                        stepSize: 10,
                        color: n
                    }
                }
            },
            plugins: {
                legend: {
                    display: !1
                },
                tooltip: {
                    rtl: isRtl,
                    backgroundColor: config.colors.white,
                    titleColor: config.colors.black,
                    bodyColor: config.colors.black,
                    borderWidth: 1,
                    borderColor: a
                }
            }
        }
    }), s = document.getElementById("doughnutChart"), s && new Chart(s, {
        type: "doughnut",
        data: {
            labels: ["Laki-laki", "Perempuan"],
            datasets: [{
                data: {{$datajk}},
                backgroundColor: [t, "#FDAC34", config.colors.primary],
                borderWidth: 0,
                pointStyle: "rectRounded"
            }]
        },
        options: {
            responsive: !0,
            animation: {
                duration: 500
            },
            cutout: "68%",
            plugins: {
                legend: {
                    display: !1
                },
                tooltip: {
                    callbacks: {
                        label: function (o) {
                            return " " + (o.labels || "") + " : " + o.parsed + " %"
                        }
                    },
                    rtl: isRtl,
                    backgroundColor: config.colors.white,
                    titleColor: config.colors.black,
                    bodyColor: config.colors.black,
                    borderWidth: 1,
                    borderColor: a
                }
            }
        }
    }), o = document.getElementById("scatterChart"), o && new Chart(o, {
        type: "scatter",
        data: {
            datasets: [{
                label: "iPhone",
                data: [{
                    x: 72,
                    y: 225
                }, {
                    x: 81,
                    y: 270
                }, {
                    x: 90,
                    y: 230
                }, {
                    x: 103,
                    y: 305
                }, {
                    x: 103,
                    y: 245
                }, {
                    x: 108,
                    y: 275
                }, {
                    x: 110,
                    y: 290
                }, {
                    x: 111,
                    y: 315
                }, {
                    x: 109,
                    y: 350
                }, {
                    x: 116,
                    y: 340
                }, {
                    x: 113,
                    y: 260
                }, {
                    x: 117,
                    y: 275
                }, {
                    x: 117,
                    y: 295
                }, {
                    x: 126,
                    y: 280
                }, {
                    x: 127,
                    y: 340
                }, {
                    x: 133,
                    y: 330
                }],
                backgroundColor: config.colors.primary,
                borderColor: "transparent",
                pointBorderWidth: 2,
                pointHoverBorderWidth: 2,
                pointRadius: 5
            }, {
                label: "Samsung Note",
                data: [{
                    x: 13,
                    y: 95
                }, {
                    x: 22,
                    y: 105
                }, {
                    x: 17,
                    y: 115
                }, {
                    x: 19,
                    y: 130
                }, {
                    x: 21,
                    y: 125
                }, {
                    x: 35,
                    y: 125
                }, {
                    x: 13,
                    y: 155
                }, {
                    x: 21,
                    y: 165
                }, {
                    x: 25,
                    y: 155
                }, {
                    x: 18,
                    y: 190
                }, {
                    x: 26,
                    y: 180
                }, {
                    x: 43,
                    y: 180
                }, {
                    x: 53,
                    y: 202
                }, {
                    x: 61,
                    y: 165
                }, {
                    x: 67,
                    y: 225
                }],
                backgroundColor: r,
                borderColor: "transparent",
                pointRadius: 5
            }, {
                label: "OnePlus",
                data: [{
                    x: 70,
                    y: 195
                }, {
                    x: 72,
                    y: 270
                }, {
                    x: 98,
                    y: 255
                }, {
                    x: 100,
                    y: 215
                }, {
                    x: 87,
                    y: 240
                }, {
                    x: 94,
                    y: 280
                }, {
                    x: 99,
                    y: 300
                }, {
                    x: 102,
                    y: 290
                }, {
                    x: 110,
                    y: 275
                }, {
                    x: 111,
                    y: 250
                }, {
                    x: 94,
                    y: 280
                }, {
                    x: 92,
                    y: 340
                }, {
                    x: 100,
                    y: 335
                }, {
                    x: 108,
                    y: 330
                }],
                backgroundColor: t,
                borderColor: "transparent",
                pointBorderWidth: 2,
                pointHoverBorderWidth: 2,
                pointRadius: 5
            }]
        },
        options: {
            responsive: !0,
            maintainAspectRatio: !1,
            animation: {
                duration: 800
            },
            plugins: {
                legend: {
                    position: "top",
                    rtl: isRtl,
                    align: "start",
                    labels: {
                        usePointStyle: !0,
                        padding: 25,
                        boxWidth: 6,
                        color: n
                    }
                },
                tooltip: {
                    rtl: isRtl,
                    backgroundColor: config.colors.white,
                    titleColor: config.colors.black,
                    bodyColor: config.colors.black,
                    borderWidth: 1,
                    borderColor: a
                }
            },
            scales: {
                x: {
                    min: 0,
                    max: 140,
                    grid: {
                        color: a,
                        drawTicks: !1,
                        borderColor: a
                    },
                    ticks: {
                        stepSize: 10,
                        color: n
                    }
                },
                y: {
                    min: 0,
                    max: 400,
                    grid: {
                        color: a,
                        drawTicks: !1,
                        borderColor: a
                    },
                    ticks: {
                        stepSize: 100,
                        color: n
                    }
                }
            }
        }
    }), s = document.getElementById("lineAreaChart");
    s && new Chart(s, {
        type: "line",
        data: {
            labels: ["7/12", "8/12", "9/12", "10/12", "11/12", "12/12", "13/12", "14/12", "15/12", "16/12", "17/12", "18/12", "19/12", "20/12", ""],
            datasets: [{
                label: "Africa",
                data: [40, 55, 45, 75, 65, 55, 70, 60, 100, 98, 90, 120, 125, 140, 155],
                tension: 0,
                fill: !0,
                backgroundColor: i,
                pointStyle: "circle",
                borderColor: "transparent",
                pointRadius: .5,
                pointHoverRadius: 5,
                pointHoverBorderWidth: 5,
                pointBorderColor: "transparent",
                pointHoverBackgroundColor: i,
                pointHoverBorderColor: config.colors.white
            }, {
                label: "Asia",
                data: [70, 85, 75, 150, 100, 140, 110, 105, 160, 150, 125, 190, 200, 240, 275],
                tension: 0,
                fill: !0,
                backgroundColor: e,
                pointStyle: "circle",
                borderColor: "transparent",
                pointRadius: .5,
                pointHoverRadius: 5,
                pointHoverBorderWidth: 5,
                pointBorderColor: "transparent",
                pointHoverBackgroundColor: e,
                pointHoverBorderColor: config.colors.white
            }, {
                label: "Europe",
                data: [240, 195, 160, 215, 185, 215, 185, 200, 250, 210, 195, 250, 235, 300, 315],
                tension: 0,
                fill: !0,
                backgroundColor: l,
                pointStyle: "circle",
                borderColor: "transparent",
                pointRadius: .5,
                pointHoverRadius: 5,
                pointHoverBorderWidth: 5,
                pointBorderColor: "transparent",
                pointHoverBackgroundColor: l,
                pointHoverBorderColor: config.colors.white
            }]
        },
        options: {
            responsive: !0,
            maintainAspectRatio: !1,
            plugins: {
                legend: {
                    position: "top",
                    rtl: isRtl,
                    align: "start",
                    labels: {
                        usePointStyle: !0,
                        padding: 35,
                        boxWidth: 6,
                        color: n
                    }
                },
                tooltip: {
                    rtl: isRtl,
                    backgroundColor: config.colors.white,
                    titleColor: config.colors.black,
                    bodyColor: config.colors.black,
                    borderWidth: 1,
                    borderColor: a
                }
            },
            scales: {
                x: {
                    grid: {
                        color: "transparent",
                        borderColor: a
                    },
                    ticks: {
                        color: n
                    }
                },
                y: {
                    min: 0,
                    max: 400,
                    grid: {
                        color: "transparent",
                        borderColor: a
                    },
                    ticks: {
                        stepSize: 100,
                        color: n
                    }
                }
            }
        }
    })
}();
</script>
