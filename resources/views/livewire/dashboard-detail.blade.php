<div wire:click="$emit('some-event')">
    <div class="page-header">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="title">
                    <h4>Dashboard</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ url('/') }}>Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">{{$name->topic}}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-4 col-sm-12 pull-right">
                {{-- @foreach($mqtt as $data) --}}
                <select class="custom-select2 form-control" aria-placeholder="Pilih Container" name="state" onchange="location = this.value;" style="width: 100%;">
                    <option>Pilih Container</option>
                    @foreach ($mqtt_all as $data)
                    <option value="{{ route('dashboard.show', $data->id) }}">{{ $data->topic }}</option>
                    @endforeach
                </select>
                {{-- <a class="btn btn-secondary" href="{{ route('dashboard.show', $data->id) }}">Pilih</a> --}}
                {{-- @endforeach --}}
            </div>
        </div>
    </div>
    <div class="row clearfix progress-box">
        <div class="col-lg-4 col-md-12 col-sm-12 mb-30">
            <div class="card-white pd-20 height-100-p">
                <div class="progress-box text-center">
                    <h5>Temperature</h5><br>
                    <div class="row clearfix progress-box">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            {{-- <div id="chart_sup"></div> --}}
                            <div class="highcharts-temp">
                                <div id="chart_sup" class="chart-temp" style="display: block; margin: auto;"></div>
                                <p class="highcharts-description">Supply Air</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            {{-- <div id="chart_ret"></div> --}}
                            <div class="highcharts-temp">
                                <div id="chart_ret" class="chart-temp" style="display: block; margin: auto;"></div>
                                <p class="highcharts-description">Return Air</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-12 col-sm-12 mb-30">
            <div class="card-white pd-20 height-100-p">
                <div class="progress-box text-center">
                    <h5>Humidity</h5>
                    <div class="row clearfix progress-box">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div id="chart_hum"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 mb-30">
            <div class="row clearfix progress-box">
                <div class="col-lg-12 col-md-12 mb-30">
                    <div class="card-white pd-20 height-50-p">
                        <div class="progress-box text-center">
                            <h5 style="padding-bottom: 6px">Status AC Control</h5>
                            {{-- @foreach ($mqtt as $data) --}}
                            <div class="row clearfix">
                                <div class="col-md-3 col-sm-12">
                                    <div class="card text-white bg-info card-box">
                                        <div class="card-header" style="font-size: 14px; padding: 0.2rem 1rem;">Evaporator<br>
                                            @if ( $mqtt->value['EVAP'] == 1)
                                                <img src="{{asset('vendors/images/on.png')}}" alt="" width="60px">
                                            @else
                                                <img src="{{asset('vendors/images/off.png')}}" alt="" width="60px">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="card text-white bg-secondary card-box">
                                        <div class="card-header" style="font-size: 14px; padding: 0.2rem 1rem;">Condensor<br>
                                            {{-- <input type="checkbox" name="COND" id="COND" value="{{ $data->value['COND'] }}" {{ $data->value['COND'] == 1 ? 'checked' : null }} class="switch-btn" data-size="small" data-color="#41ccba" disabled> --}}
                                            {{-- <i class="fa fa-solid fa-toggle-off"></i> --}}
                                            @if ( $mqtt->value['COND'] == 1)
                                                <img src="{{asset('vendors/images/on.png')}}" alt="" width="60px">
                                            @else
                                                <img src="{{asset('vendors/images/off.png')}}" alt="" width="60px">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="card text-white bg-info card-box">
                                        <div class="card-header" style="font-size: 14px; padding: 0.2rem 1rem;">Compressor<br>
                                            {{-- <input type="checkbox" name="COMP" is="COMP" value="{{ $data->value['COMP'] }}" {{ $data->value['COMP'] == 1 ? 'checked' : null }} class="switch-btn" data-size="small" data-color="#0059b2"> --}}
                                            @if ( $mqtt->value['COMP'] == 1)
                                                <img src="{{asset('vendors/images/on.png')}}" alt="" width="60px">
                                            @else
                                                <img src="{{asset('vendors/images/off.png')}}" alt="" width="60px">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="card text-white bg-secondary card-box">
                                        <div class="card-header" style="font-size: 14px; padding: 0.2rem 1rem;">Heater<br>
                                            {{-- <input type="checkbox" name="HEAT" id="HEAT" value="{{ $data->value['HEAT'] }}" {{ $data->value['HEAT'] == 1 ? 'checked' : null }} class="switch-btn" data-size="small" data-color="#41ccba"> --}}
                                            @if ( $mqtt->value['HEAT'] == 1)
                                                <img src="{{asset('vendors/images/on.png')}}" alt="" width="60px">
                                            @else
                                                <img src="{{asset('vendors/images/off.png')}}" alt="" width="60px">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- @endforeach --}}
                            </div>
                            {{-- <span class="d-block">90% Average</span> --}}
                            {{-- <input type="text" class="knob dial3" value="90" data-width="120" data-height="120" data-linecap="round" data-thickness="0.12" data-bgColor="#fff" data-fgColor="#f56767" data-angleOffset="180" readonly> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="card-white posisi-card pd-20 height-50-p">
                        <div class="progress-box text-center">
                            <h5 style="padding-bottom: 6px">Capacity</h5>
                            <div class="row clearfix progress-box">
                                <div class="col-lg-6 col-md-12 col-sm-12" style="display: block; margin: auto;">
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: {{$persen}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$persen}}%</div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td style="padding: 0.3rem;">Allocated</td>
                                                <td style="padding: 0.3rem;">{{$allocated}} kg</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 0.3rem;">Free</td>
                                                <td style="padding: 0.3rem;">{{$free}} kg</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 0.3rem;">Total</td>
                                                {{-- @foreach ($container as $con) --}}
                                                <td style="padding: 0.3rem;">{{$kapasitas}} kg</td>
                                                {{-- @endforeach --}}
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-5 col-md-12 col-sm-12 mb-30">

        </div> --}}
        {{-- <div class="col-lg-3 col-md-12 col-sm-12 mb-30">
            <div class="card-white pd-20 height-50-p">
                <div class="progress-box text-center">
                    <h5 class="padding-top-10 h4" style="padding-bottom: 10px">Door Status</h5>
                    <a href="#" class="btn btn-success btn-lg disabled" role="button" aria-disabled="true"><i class="icon-copy dw dw-door"></i> Close</a>
                </div><br>
            </div>
        </div> --}}
    </div>
    {{-- <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
            <div class="card-white pd-30 height-100-p">
                <h4 class="mb-30 h4">Speed Monitoring</h4>
                <div id="chart-speed"></div>
            </div>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
            <div class="pd-20 card-white height-100-p">
                <h2 class="mb-30 h4">Notification</h2>
                {{-- @foreach ($container as $con) --}}
                <?php
                $kondisi1 = $mqtt->value['AVG_TMP'] > $container->suhu_ketetapan;
                $kondisi2 = $mqtt->value['EVAP'] == 0 && $mqtt->value['COND'] == 0 && $mqtt->value['COMP'] == 0 && $mqtt->value['HEAT'] == 0;
                ?>

                @if ($kondisi1 == 1 && $kondisi2 == 0)
                    <div class="alert alert-dark alert-dismissible fade show" role="alert">
                        <strong>Suhu melebihi threshold!</strong> Atur suhu menjadi dibawah {{$container->suhu_ketetapan}} °C
                        {{-- <form action="" method="POST"> --}}
                        <button type="submit" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{-- </form> --}}
                    </div>
                {{-- @endif --}}
                @elseif ($kondisi1 == 0 && $kondisi2 == 1)
                    <div class="alert alert-dark alert-dismissible fade show" role="alert">
                        <strong>AC turn off!</strong> Nyalakan komponen AC
                        {{-- <form action="" method="POST"> --}}
                        <button type="submit" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{-- </form> --}}
                    </div>
                {{-- @endif --}}
                @elseif ($kondisi1 == 1 && $kondisi2 == 1)
                    <div class="alert alert-dark alert-dismissible fade show" role="alert">
                        <strong>Suhu melebihi threshold!</strong> Atur suhu menjadi dibawah {{$container->suhu_ketetapan}} °C
                        {{-- <form action="" method="POST"> --}}
                        <button type="submit" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{-- </form> --}}
                    </div>
                    <div class="alert alert-dark alert-dismissible fade show" role="alert">
                        <strong>AC turn off!</strong> Nyalakan komponen AC
                        {{-- <form action="" method="POST"> --}}
                        <button type="submit" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{-- </form> --}}
                    </div>
                {{-- @endif --}}
                @elseif ($kondisi1 == 0 && $kondisi2 == 0)
                    <p>Nothing notification.</p>
                @endif
                {{-- @endforeach --}}
            </div>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
            <div class="card-white pd-30 height-100-p">
                <h2 class="mb-30 h4">Tracking Location</h2>
                <div id="map" style="width:100%!important; height:380px"></div>
                <br>
                <div class="pb-20">
                    <table class="data-table table hover multiple-select-row nowrap">
                        <thead>
                            <tr class="table-primary">
                                <th class="table-plus datatable-nosort">Date & Time</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mqtt_history as $data)
                            <tr>
                                <td class="table-plus">{{ $data->value['TIME_STR'] }}</td>
                                <td>{{ $data->value['LAT_STRING'] }}</td>
                                <td>{{ $data->value['LON_STRING'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}

    @section('scriptPage')

    <script>
        setInterval(() => Livewire.emit('ubahData'),3000);

        // $(document).ready(function() {
        //     var t = Math.abs({{ $mqtt->value['AVG_TMP'] }});
            // var supply = Math.abs({{ $mqtt->value['TMP1'] }});
            var nilai_sup = {{ $mqtt->value['TMP1'] }};
            // var return_air = Math.abs({{ $mqtt->value['TMP2'] }});
            var nilai_ret = {{ $mqtt->value['TMP2'] }};
            var hum = Math.abs({{ $mqtt->value['AVG_HMD'] }});
            var nilai_hum = {{ $mqtt->value['AVG_HMD'] }};
        //     $(".dial1").knob();
        //     $({animatedVal: 0}).animate({animatedVal: t }, {
        //         duration: 2000,
        //         easing: "swing",
        //         step: function() {
        //             $(".dial1").val(Math.ceil(this.animatedVal)).trigger("change");
        //         }
        //     });
        // });

        var gaugeOptions = {
            chart: {
                type: 'solidgauge',
                backgroundColor: 'none'
            },

            title: null,

            pane: {
                center: ['50%', '85%'],
                size: '140%',
                startAngle: -90,
                endAngle: 90,
                background: {
                    backgroundColor:
                    Highcharts.defaultOptions.legend.backgroundColor || '#EEE',
                    innerRadius: '60%',
                    outerRadius: '100%',
                    shape: 'arc'
                }
            },

            exporting: {
                enabled: false
            },

            tooltip: {
                enabled: false
            },

            // the value axis
            yAxis: {
                stops: [
                    [0.1, '#0b132b'], // green
                    [0.5, '#0b132b'], // yellow
                    [0.9, '#0b132b'] // red
                ],
                lineWidth: 0,
                tickWidth: 0,
                minorTickInterval: null,
                tickAmount: 2,
                title: {
                    y: -70
                },
                labels: {
                    y: 16
                }
            },

            plotOptions: {
                solidgauge: {
                    dataLabels: {
                    y: 5,
                    borderWidth: 0,
                    useHTML: true
                    }
                }
            }
        };

        // The speed gauge
        var chartSup = Highcharts.chart('chart_sup', Highcharts.merge(gaugeOptions, {
            yAxis: {
                min: -50,
                max: 50,
                title: {
                    text: ''
                }
            },

            credits: {
                enabled: false
            },

            series: [{
                name: 'Supply',
                data: [nilai_sup],
                dataLabels: {
                    format:
                    '<div style="text-align:center">' +
                    '<span style="font-size:12px">{y} °C</span><br/>' +
                    '<span style="font-size:12px;opacity:0.4"></span>' +
                    '</div>'
                },
                tooltip: {
                    valueSuffix: '°C'
                }
            }]

        }));

        // The RPM gauge
        var chartRet = Highcharts.chart('chart_ret', Highcharts.merge(gaugeOptions, {
            yAxis: {
            min: -50,
            max: 50,
            title: {
                text: ''
            }
            },

            credits: {
                enabled: false
            },

            series: [{
                name: 'Return',
                data: [nilai_ret],
                dataLabels: {
                    format:
                    '<div style="text-align:center">' +
                    '<span style="font-size:12px">{y} °C</span><br/>' +
                    '<span style="font-size:12px;opacity:0.4"></span>' +
                    '</div>'
                },
                tooltip: {
                    valueSuffix: '°C'
                }
            }]

        }));

        var options_hum = {
            series: [hum],
            chart: {
            height: 220,
            type: 'radialBar',
            offsetY: 0
            },
            colors: ['#0B132B', '#222222'],
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 135,
                    dataLabels: {
                        name: {
                            fontSize: '14px',
                            color: undefined,
                            offsetY: 90
                        },
                        value: {
                            offsetY: 50,
                            fontSize: '16px',
                            color: undefined,
                            formatter: function (val) {
                                return nilai_hum + " %";
                            }
                        }
                    }
                }
            },
            fill: {
            type: 'gradient',
            gradient: {
                shade: 'red',
                shadeIntensity: 0.15,
                inverseColors: false,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 50, 65, 91]
            },
            },
            // stroke: {
            // dashArray: 4
            // },
            labels: [' '],
        };

        var chart_hum = new ApexCharts(document.querySelector("#chart_hum"), options_hum);
        chart_hum.render();

        // $( "#evap" ).prop( "checked", {{ $mqtt->value['EVAP'] }} );
        // $(".evap").prop('checked', {{ $mqtt->value['EVAP'] }}).trigger("click");
        // $('#evap').attr('checked', true);
        $('#evap').val(false);
        $("#btn_3").click(function(){
            switchery["chk_3"].handleOnchange(true);
        });
        $("#chk_3").change(function(){
            alert("change here");
        });
        $( "#cond" ).prop( "checked", {{ $mqtt->value['COND'] }} );
        $( "#comp" ).prop( "checked", {{ $mqtt->value['COMP'] }} );
        $( "#heat" ).prop( "checked", {{ $mqtt->value['HEAT'] }} );
        Livewire.on('berhasilUpdate', event => {
            // var supply = event.Math.abs({{ $mqtt->value['TMP1'] }});
            var nilai_sup = event{{ $mqtt->value['TMP1'] }};
            // var return_air = event.Math.abs({{ $mqtt->value['TMP2'] }});
            var nilai_ret = event{{ $mqtt->value['TMP2'] }};
            var hum = event.Math.abs({{ $mqtt->value['AVG_HMD'] }});
            var nilai_hum = {{ $mqtt->value['AVG_HMD'] }};
            chartSup.value = nilai_sup;
            chartSup.labels = supply;
            chartSup.update();
            chartRet.value = nilai_ret;
            chartRet.labels = return_air;
            chartRet.update();
            chart_hum.value = nilai_hum;
            chart_hum.labels = hum;
            chart_hum.update();
            console.log(supply);
        })
    </script>
@endsection
</div>
