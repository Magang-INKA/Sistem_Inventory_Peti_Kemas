@extends('layouts.MasterView')
{{-- @stack('scripts') --}}
@section('menu_home', 'active')
@section('content')
	{{-- <div class="main-container"> --}}
		{{-- <div class="xs-pd-20-10 pd-ltr-20"> --}}
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
					<div class="card-white pd-20 height-50-p">
						<div class="progress-box text-center">
                            <h5 class="padding-top-10 h4">Temperature</h5>
                            <div id="chart_sup" style="margin-top: -25px;"></div>
                            {{-- <div id="chart_ret" style="margin-top: -25px;"></div> --}}
                            {{-- @foreach ($mqtt as $data)
							<input type="text" class="knob dial1" value="{{ $data->value['AVG_TMP'] }}" data-width="120" data-height="120" data-linecap="round" data-thickness="0.2" data-bgColor="#fff" data-fgColor="#1b00ff" data-angleOffset="180" readonly>
                             <span class="d-block">{{ $data->value['AVG_TMP'] }}° Celcius</span>
                            @endforeach --}}
						</div>
					</div>
				</div>
                <div class="col-lg-4 col-md-12 col-sm-12 mb-30">
					<div class="card-white pd-20 height-50-p">
						<div class="progress-box text-center">
                            <h5 class="padding-top-10 h4">Return Air</h5>
                            <div id="chart_ret" style="margin-top: -25px;"></div>
                            {{-- <div id="chart_ret" style="margin-top: -25px;"></div> --}}
                            {{-- @foreach ($mqtt as $data)
							<input type="text" class="knob dial1" value="{{ $data->value['AVG_TMP'] }}" data-width="120" data-height="120" data-linecap="round" data-thickness="0.2" data-bgColor="#fff" data-fgColor="#1b00ff" data-angleOffset="180" readonly>
                             <span class="d-block">{{ $data->value['AVG_TMP'] }}° Celcius</span>
                            @endforeach --}}
						</div>
					</div>
				</div>
                <div class="col-lg-4 col-md-12 col-sm-12 mb-30">
					<div class="card-white pd-20 height-50-p">
						<div class="progress-box text-center">
                            <h5 class="padding-top-10 h4">Humidity</h5>
                            <div id="chart_hum" style="margin-top: -25px;"></div>
                            {{-- @foreach ($mqtt as $data)
							<input type="text" class="knob dial1" value="{{ $data->value['AVG_TMP'] }}" data-width="120" data-height="120" data-linecap="round" data-thickness="0.2" data-bgColor="#fff" data-fgColor="#1b00ff" data-angleOffset="180" readonly>
                             <span class="d-block">{{ $data->value['AVG_TMP'] }}° Celcius</span>
                            @endforeach --}}
						</div>
					</div>
				</div>
				<div class="col-lg-7 col-md-12 col-sm-12 mb-30">
					<div class="card-white pd-20 height-100-p">
						<div class="progress-box text-center">
                            <h5 class="padding-top-10 h4">Status AC Control</h5>
                            {{-- @foreach ($mqtt as $data) --}}
                            <div class="row clearfix">
                                <div class="col-md-3 col-sm-12 mb-30">
                                    <div class="card text-white bg-info card-box" style="margin-bottom: -20px">
                                        <div class="card-header">Evaporator<br>
                                            @if ( $mqtt->value['EVAP'] == 1)
                                                <img src="{{asset('vendors/images/on.png')}}" alt="" width="70px">
                                            @else
                                                <img src="{{asset('vendors/images/off.png')}}" alt="" width="70px">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="card text-white bg-secondary card-box">
                                        <div class="card-header">Condensor<br>
                                            {{-- <input type="checkbox" name="COND" id="COND" value="{{ $data->value['COND'] }}" {{ $data->value['COND'] == 1 ? 'checked' : null }} class="switch-btn" data-size="small" data-color="#41ccba" disabled> --}}
                                            {{-- <i class="fa fa-solid fa-toggle-off"></i> --}}
                                            @if ( $mqtt->value['COND'] == 1)
                                                <img src="{{asset('vendors/images/on.png')}}" alt="" width="70px">
                                            @else
                                                <img src="{{asset('vendors/images/off.png')}}" alt="" width="70px">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="card text-white bg-info card-box">
                                        <div class="card-header">Compressor<br>
                                            {{-- <input type="checkbox" name="COMP" is="COMP" value="{{ $data->value['COMP'] }}" {{ $data->value['COMP'] == 1 ? 'checked' : null }} class="switch-btn" data-size="small" data-color="#0059b2"> --}}
                                            @if ( $mqtt->value['COMP'] == 1)
                                                <img src="{{asset('vendors/images/on.png')}}" alt="" width="70px">
                                            @else
                                                <img src="{{asset('vendors/images/off.png')}}" alt="" width="70px">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="card text-white bg-secondary card-box">
                                        <div class="card-header">Heater<br>
                                            {{-- <input type="checkbox" name="HEAT" id="HEAT" value="{{ $data->value['HEAT'] }}" {{ $data->value['HEAT'] == 1 ? 'checked' : null }} class="switch-btn" data-size="small" data-color="#41ccba"> --}}
                                            @if ( $mqtt->value['HEAT'] == 1)
                                                <img src="{{asset('vendors/images/on.png')}}" alt="" width="70px">
                                            @else
                                                <img src="{{asset('vendors/images/off.png')}}" alt="" width="70px">
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
                <div class="col-lg-5 col-md-12 col-sm-12 mb-30">
					<div class="card-white posisi-card pd-20 height-100-p">
						<div class="progress-box text-center">
                            <h5 class="padding-top-10 h4">Capacity</h5>
							{{-- <span class="d-block">75% Allocated</i></span> --}}
                            <div class="progress">
								<div class="progress-bar bg-info" role="progressbar" style="width: 75%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">75%</div>
							</div>
							{{-- <input type="text" class="knob dial2" value="75" data-width="120" data-height="120" data-linecap="round" data-thickness="0.12" data-bgColor="#fff" data-fgColor="#00e091" data-angleOffset="180" readonly> --}}
						</div>
                        <br>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Allocated</td>
                                    <td>1200 ton</td>
                                </tr>
                                <tr>
                                    <td>Free</td>
                                    <td>800 ton</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>2000 ton</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
				</div>
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
			</div>
		{{-- </div> --}}
	{{-- </div> --}}
@endsection
@section('scriptPage')
<!-- js -->
<script>
    function initMap() {
        // membuat objek untuk titik koordinat'
        var lokasi_terkini = {lat: {{$mqtt->value['LAT']}}, lng: {{$mqtt->value['LON']}}};

        // membuat objek peta
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 7,
            center: lokasi_terkini
        });

        // mebuat konten untuk info window
        var contentString = '<span><b>{{ $mqtt->value['TIME_STR'] }}</b></span>';

        // membuat objek info window
        var infowindow = new google.maps.InfoWindow({
            content: contentString,
            position: lokasi_terkini
        });

        // membuat marker
        var marker = new google.maps.Marker({
            position: lokasi_terkini,
            map: map,
            title: 'Lokasi Terkini'
        });

        // event saat marker diklik
        marker.addListener('click', function() {
            // tampilkan info window di atas marker
            infowindow.open(map, marker);
        });

    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?callback=initMap"></script>

    <script>
        // console.log('tes');
        // $(document).ready(function() {
        //     var t = Math.abs({{ $mqtt->value['AVG_TMP'] }});
            var supply = Math.abs({{ $mqtt->value['TMP1'] }});
            var nilai_sup = {{ $mqtt->value['TMP1'] }};
            var return_air = Math.abs({{ $mqtt->value['TMP2'] }});
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

        var options_sup = {
            series: [supply],
            chart: {
            height: 250,
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
                            fontSize: '16px',
                            color: undefined,
                            offsetY: 120
                        },
                        value: {
                            offsetY: 76,
                            fontSize: '20px',
                            color: undefined,
                            formatter: function (val) {
                        return nilai_sup + " °C";
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
            labels: ['Supply Air'],
        };

        var options_ret = {
            series: [return_air],
            chart: {
            height: 250,
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
                            fontSize: '16px',
                            color: undefined,
                            offsetY: 120
                        },
                        value: {
                            offsetY: 76,
                            fontSize: '20px',
                            color: undefined,
                            formatter: function (val) {
                        return nilai_ret + " °C";
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
            labels: ['Return Air'],
        };

        var options_hum = {
            series: [hum],
            chart: {
            height: 250,
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
                            offsetY: 120
                        },
                        value: {
                            offsetY: 76,
                            fontSize: '20px',
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

        var chart_sup = new ApexCharts(document.querySelector("#chart_sup"), options_sup);
        chart_sup.render();

        var chart_ret = new ApexCharts(document.querySelector("#chart_ret"), options_ret);
        chart_ret.render();

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
    </script>

@endsection
