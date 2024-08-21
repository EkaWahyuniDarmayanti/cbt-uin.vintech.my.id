@extends('layouts.master')

@push('plugin-styles')
<link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            @if (auth()->user()->role == 'Admin')
            <!--begin::Row-->
            <div class="row g-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-12">
                    <!--begin::Chart widget 18-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Statistik Mentoring</span>
                                <span class="text-gray-400 mt-1 fw-semibold fs-6">Per Angkatan</span>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body d-flex align-items-end px-0 pt-3 pb-5">
                            <!--begin::Chart-->
                            <div id="kt_charts_widget_18_chart" class="h-325px w-100 min-h-auto ps-4 pe-6"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end: Card Body-->
                    </div>
                    <!--end::Chart widget 18-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            @elseif (auth()->user()->role == 'Mentor')
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10 mt-1">
                @foreach ($jadwal as $item)
                <!--begin::Col-->
                <div class="col-xl-4 col-6">
                    <!--begin::Card widget 3-->
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                        style="background-color: #{{ substr(md5(rand()), 0, 6) }};background-image:url('assets/media/svg/shapes/wave-bg-red.svg')">
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end mb-3">
                            <!--begin::Info-->
                            <div class="d-flex align-items-center">
                                <span class="fs-4hx text-white fw-bold me-0">&nbsp;</span>
                                <div class="fw-bold fs-1 text-white">
                                    <span class="d-block">{{ \Carbon\Carbon::parse($item->jadwal->tanggal)->isoFormat('D MMMM Y') }}</span>
                                </div>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Card footer-->
                        <div class="card-footer"
                            style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                            <!--begin::Progress-->
                            <div class="fw-bold text-white py-2">
                                <span class="fs-1 d-block">{{ $item->jadwal->topik }}</span>
                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Card footer-->
                    </div>
                    <!--end::Card widget 3-->
                </div>
                <!--end::Col-->
                @endforeach
            </div>
            <!--end::Row-->
            @elseif (auth()->user()->role == 'Mahasiswa')
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10 mt-1">
                @foreach ($jadwal as $item)
                <!--begin::Col-->
                <div class="col-xl-4 col-6">
                    <a href="{{ route('detail.jadwal', ['jadwal' => $item->jadwal_id, 'user' => $item->user_id, 'jadwalMentor' => $item->id]) }}">
                        <!--begin::Card widget 3-->
                        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                            style="background-color: #{{ substr(md5(rand()), 0, 6) }};background-image:url('assets/media/svg/shapes/wave-bg-red.svg')">
                            <!--begin::Card body-->
                            <div class="card-body d-flex align-items-end mb-3">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center">
                                    <span class="fs-4hx text-white fw-bold me-0">&nbsp;</span>
                                    <div class="fw-bold fs-1 text-white">
                                        <span class="d-block">{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMMM Y') }}</span>
                                    </div>
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Card body-->
                            <!--begin::Card footer-->
                            <div class="card-footer"
                                style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                                <!--begin::Progress-->
                                <div class="fw-bold text-white py-2">
                                    <span class="fs-1 d-block">{{ $item->topik }}</span>
                                </div>
                                <!--end::Progress-->
                            </div>
                            <!--end::Card footer-->
                        </div>
                        <!--end::Card widget 3-->
                    </a>
                </div>
                <!--end::Col-->
                @endforeach
            </div>
            <!--end::Row-->
            @endif
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
@endsection

@push('plugin-scripts')
<script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
@endpush

@push('custom-scripts')
<script src="assets/js/custom/widgets.js"></script>
<script src="assets/js/custom/apps/chat/chat.js"></script>
<script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
<script src="assets/js/custom/utilities/modals/create-app.js"></script>
<script src="assets/js/custom/utilities/modals/users-search.js"></script>
@if (auth()->user()->role == 'Admin')
    <script>
        var KTChartsWidget18 = function () {
        var e = {
                self: null,
                rendered: !1
            },
            t = function (e) {
                var t = document.getElementById("kt_charts_widget_18_chart");
                if (t) {
                    var a = parseInt(KTUtil.css(t, "height")),
                        l = KTUtil.getCssVariableValue("--bs-gray-900"),
                        r = KTUtil.getCssVariableValue("--bs-border-dashed-color"),
                        o = {
                            series: [{
                                name: "Total",
                                data: [
                                    @foreach ($angkatan as $item)
                                        {{ $total[$item->id] }},
                                    @endforeach
                                ]
                            }],
                            chart: {
                                fontFamily: "inherit",
                                type: "bar",
                                height: a,
                                toolbar: {
                                    show: !1
                                }
                            },
                            plotOptions: {
                                bar: {
                                    horizontal: !1,
                                    columnWidth: ["28%"],
                                    borderRadius: 5,
                                    dataLabels: {
                                        position: "top"
                                    },
                                    startingShape: "flat"
                                }
                            },
                            legend: {
                                show: !1
                            },
                            dataLabels: {
                                enabled: !0,
                                offsetY: -28,
                                style: {
                                    fontSize: "13px",
                                    colors: [l]
                                },
                                formatter: function (e) {
                                    return e
                                }
                            },
                            stroke: {
                                show: !0,
                                width: 2,
                                colors: ["transparent"]
                            },
                            xaxis: {
                                categories: [
                                    @foreach ($angkatan as $item)
                                        "{{ $item->angkatan }}", 
                                    @endforeach
                                ],
                                axisBorder: {
                                    show: !1
                                },
                                axisTicks: {
                                    show: !1
                                },
                                labels: {
                                    style: {
                                        colors: KTUtil.getCssVariableValue("--bs-gray-500"),
                                        fontSize: "13px"
                                    }
                                },
                                crosshairs: {
                                    fill: {
                                        gradient: {
                                            opacityFrom: 0,
                                            opacityTo: 0
                                        }
                                    }
                                }
                            },
                            yaxis: {
                                labels: {
                                    style: {
                                        colors: KTUtil.getCssVariableValue("--bs-gray-500"),
                                        fontSize: "13px"
                                    },
                                    formatter: function (e) {
                                        return e
                                    }
                                }
                            },
                            fill: {
                                opacity: 1
                            },
                            states: {
                                normal: {
                                    filter: {
                                        type: "none",
                                        value: 0
                                    }
                                },
                                hover: {
                                    filter: {
                                        type: "none",
                                        value: 0
                                    }
                                },
                                active: {
                                    allowMultipleDataPointsSelection: !1,
                                    filter: {
                                        type: "none",
                                        value: 0
                                    }
                                }
                            },
                            tooltip: {
                                style: {
                                    fontSize: "12px"
                                },
                                y: {
                                    formatter: function (e) {
                                        return +e
                                    }
                                }
                            },
                            colors: [KTUtil.getCssVariableValue("--bs-primary"), KTUtil.getCssVariableValue("--bs-primary-light")],
                            grid: {
                                borderColor: r,
                                strokeDashArray: 4,
                                yaxis: {
                                    lines: {
                                        show: !0
                                    }
                                }
                            }
                        };
                    e.self = new ApexCharts(t, o), setTimeout((function () {
                        e.self.render(), e.rendered = !0
                    }), 200)
                }
            };
        return {
            init: function () {
                t(e), KTThemeMode.on("kt.thememode.change", (function () {
                    e.rendered && e.self.destroy(), t(e)
                }))
            }
        }
    }();
    "undefined" != typeof module && (module.exports = KTChartsWidget18), KTUtil.onDOMContentLoaded((function () {
        KTChartsWidget18.init()
    }));
    </script>
@endif
@endpush
