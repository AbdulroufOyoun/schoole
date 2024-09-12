@extends('layouts.admin_panel.main')
@push('style')
    <link href="{{asset('admin_panel/assets/plugins/morris/morris.css')}}" rel="stylesheet">
@endpush
@section('content')
@if(auth()->user()->role_id != 10)
    <div class="row">
        <div class="col-xl-9 col-md-12 col-lg-12">
            <div class="row">
                {{--     total payment       --}}
                <div class="col-xl-4 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <div class="mt-0 text-left"> <span
                                            class="fs-14 font-weight-semibold">@lang('index.total_fees')</span>
                                        <h3 class="mb-0 mt-1  mb-2">${{$total_fees}}</h3>
                                    </div>
                                    <span class="text-muted">
                                    <span class="text-danger fs-12 mt-2 mr-1"><i
                                            class="feather feather-arrow-up-right mr-1 bg-success-transparent p-1 brround"></i>${{$total_payment}}
                                    </span>
                                        @lang('index.total_payment')
                                </span>
                                </div>
                                <div class="col-4">
                                    <div class="icon1 bg-secondary brround my-auto  float-right"><i
                                            class="feather feather-dollar-sign"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--            social media--}}
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <div class="mt-0 text-left"> <span
                                            class="fs-14 font-weight-semibold">@lang('index.total_posts')</span>
                                        <h3 class="mb-0 mt-1 mb-2">{{$total_posts}}</h3>
                                        <span class="text-muted">
                                        <span class="text-danger fs-12 mt-2 mr-1"><i
                                                class="feather feather-arrow-down-left mr-1 bg-danger-transparent p-1 brround"></i>{{$rejected_posts}}</span>
                                        @lang('index.posts_rejected')
                                    </span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="icon1 bg-yellow my-auto  float-right"><i
                                            class="feather feather-instagram"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--    total event    --}}
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <div class="mt-0 text-left"> <span
                                            class="fs-14 font-weight-semibold">@lang('index.total_school_event')</span>
                                        <h3 class="mb-0 mt-1 mb-2">{{$total_event}}</h3>
                                        <span class="text-muted">
                                        <span class="text-danger fs-12 mt-2 mr-1"><i
                                                class="feather feather-arrow-up-right mr-1 bg-success-transparent p-1 brround"></i></span>
                                    </span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="icon1 bg-primary my-auto  float-right"><i
                                            class="feather feather-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header border-0 responsive-header">
                            <h4 class="card-title">@lang('index.posts_each_month')</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="chartLine"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-12 col-lg-12">
            <div class="card overflow-hidden" style="height: 350px;">
                <div class="card-header border-bottom-0">
                    <div class="card-title">@lang('index.total_user',['number'=>$total_user])</div>
                </div>
                <div class="card-body">
                    <div class="chartjs-wrapper-demo">
                        <div id="chart4" class="h-300 mh-300"></div>
                    </div>
                </div>
            </div>
            <div class="card overflow-hidden" style="height: 350px;">
                <div class="card-header border-bottom-0">
                    <div class="card-title">@lang('index.percentage_promoted')</div>
                </div>
                <div class="card-body">
                    <div class="chartjs-wrapper-demo">
                        <div id="chart8" class="h-300 mh-300"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script src="{{asset('admin_panel')}}/assets/plugins/apexchart/apexcharts.js"></script>
        <script src="{{asset('admin_panel')}}/assets/js/apexchart-custom.js"></script>
        <script>
            new ApexCharts(document.querySelector("#chart4"), {
                series: [
                    @foreach ($accountTypes as $count)
                        {{ $count }},
                    @endforeach
                ],
                labels: [
                    @foreach ($accountTypes as $accountType => $count)
                        "{{ ucfirst($accountType) }}",
                    @endforeach
                ],
                colors: ["#3366ff", "#58f309", "#f6f30c", '#0ab092', "#fe7f00", "#f11541", '#3cb40e'],
                chart: {height: 300, type: "donut"},
                legend: {show: false},
                hover: {mode: null},
                tooltip: {
                    y: {
                        formatter: function (value) {
                            return "Count: " + value;
                        },
                    },
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {width: 200},
                        hover: {mode: null},
                        legend: {show: false, position: "bottom"},
                    },
                }],
            }).render();
            new ApexCharts(document.querySelector("#chart8"), {
                series: [{{$percentage}}],
                chart: {height: 300, type: "radialBar"},
                plotOptions: {radialBar: {hollow: {size: "70%"}}},
                labels: ["Promoted"],
                colors: ["#3366ff"],
                responsive: [{options: {legend: {show: !1}}}]
            }).render();
        </script>
        <script>
            var max_value = {{max($posts)}};
            var step = {{ ceil(max($posts)/10) }};
            var posts = [{{ implode(',', $posts) }}]; // Fix: Convert to array directly
            o = document.querySelector("#chartLine").getContext("2d");
            new Chart(o, {
                data: {
                    labels: ["@lang('index.Jan')", "@lang('index.Feb')", "@lang('index.Mar')", "@lang('index.Apr')", "@lang('index.May')", "@lang('index.Jun')", "@lang('index.Jul')", "@lang('index.Aug')", "@lang('index.Sep')", "@lang('index.Oct')", "@lang('index.Nov')", "@lang('index.Dec')"],
                    datasets: [{
                        label: "Total Budget",
                        data: posts, // Fix: Use the array directly, not [posts]
                        borderWidth: 3,
                        backgroundColor: "transparent",
                        borderColor: "#3366ff",
                        pointBackgroundColor: "#ffffff",
                        pointRadius: 0,
                        type: "line"
                    }]
                },
                options: {
                    responsive: !0,
                    maintainAspectRatio: !1,
                    layout: {padding: {left: 0, right: 0, top: 0, bottom: 0}},
                    tooltips: {enabled: !1},
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: !0,
                                drawBorder: !1,
                                zeroLineColor: "rgba(142, 156, 173,0.1)",
                                color: "rgba(142, 156, 173,0.1)"
                            },
                            scaleLabel: {display: !1},
                            ticks: {beginAtZero: !0, min: 0, max: max_value, stepSize: step, fontColor: "#8492a6"}
                        }],
                        xAxes: [{
                            ticks: {beginAtZero: !0, fontColor: "#8492a6"},
                            gridLines: {color: "rgba(142, 156, 173,0.1)", display: !1}
                        }]
                    },
                    legend: {display: !1},
                    elements: {point: {radius: 0}}
                }
            });
        </script>
    @endpush
@endif


@endsection
