@extends('layouts.MasterView')
{{-- @stack('scripts') --}}
@section('menu_home', 'active')
@section('content')
	{{-- <div class="main-container"> --}}
		<div class="xs-pd-20-10 pd-ltr-20">
			<div class="page-header">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="title">
							<h4>Dashboard</h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
							</ol>
						</nav>
					</div>
					<div class="col-md-6 col-sm-12 text-right">
						{{-- <div class="dropdown">
							<a class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
								January 2018
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="#">Export List</a>
								<a class="dropdown-item" href="#">Policies</a>
								<a class="dropdown-item" href="#">View Assets</a>
							</div>
						</div> --}}
                        {{-- @foreach($mqtt as $data) --}}
                        <select class="custom-select2 form-control" name="state" style="width: 50%; height: 38px;">
                            <option value="">Pilih Container</option>
                            <option value="">rc-inka-awu-2022</option>
                        </select>
                        {{-- @endforeach --}}
					</div>
				</div>
			</div>
			<div class="row clearfix progress-box">
                <div class="col-lg-4 col-md-12 col-sm-12 mb-30">
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
				<div class="col-lg-4 col-md-12 col-sm-12 mb-30">
					<div class="card-white pd-20 height-50-p">
						<div class="progress-box text-center">
                            <h5 class="padding-top-10 h4">Temperature</h5>
                            <div id="chart6" style="margin-top: -25px;"></div>
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
                            <div id="chart7" style="margin-top: -25px;"></div>
                            {{-- @foreach ($mqtt as $data)
							<input type="text" class="knob dial1" value="{{ $data->value['AVG_TMP'] }}" data-width="120" data-height="120" data-linecap="round" data-thickness="0.2" data-bgColor="#fff" data-fgColor="#1b00ff" data-angleOffset="180" readonly>
                             <span class="d-block">{{ $data->value['AVG_TMP'] }}° Celcius</span>
                            @endforeach --}}
						</div>
					</div>
				</div>
				<div class="col-lg-9 col-md-12 col-sm-12 mb-30">
					<div class="card-white pd-20 height-100-p">
						<div class="progress-box text-center">
                            <h5 class="padding-top-10 h4">AC Control</h5>
                            <div class="row clearfix">
                                @foreach ($mqtt as $data)
                                <div class="col-md-3 col-sm-12">
                                    <div class="card text-white bg-info card-box">
                                        <div class="card-header">Evaporator<br>
                                            <input type="checkbox" id="evap" class="switch-btn" data-size="small" data-color="#0059b2">
                                        </div>

                                        {{-- <div class="card-body">
                                            <h5 class="card-title text-white">Primary card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="card text-white bg-secondary card-box">
                                        <div class="card-header">Condenser<br>
                                            <input type="checkbox" id="cond" class="switch-btn" data-size="small" data-color="#41ccba">
                                        </div>
                                        {{-- <div class="card-body">
                                            <h5 class="card-title text-white">Primary card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="card text-white bg-info card-box">
                                        <div class="card-header">Compressor<br>
                                            <input type="checkbox" id="comp" class="switch-btn" data-size="small" data-color="#0059b2">
                                        </div>
                                        {{-- <div class="card-body">
                                            <h5 class="card-title text-white">Primary card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="card text-white bg-secondary card-box">
                                        <div class="card-header">Heater<br>
                                            <input type="checkbox" id="heat" class="switch-btn" data-size="small" data-color="#41ccba">
                                        </div>
                                        {{-- <div class="card-body">
                                            <h5 class="card-title text-white">Primary card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div> --}}
                                    </div>
                                </div>
                                @endforeach
                            </div>
							{{-- <span class="d-block">90% Average</span> --}}
							 {{-- <input type="text" class="knob dial3" value="90" data-width="120" data-height="120" data-linecap="round" data-thickness="0.12" data-bgColor="#fff" data-fgColor="#f56767" data-angleOffset="180" readonly> --}}

						</div>
					</div>
				</div>
                <div class="col-lg-3 col-md-12 col-sm-12 mb-30">
                    <div class="card-white pd-20 height-50-p">
                        <div class="progress-box text-center">
                            <h5 class="padding-top-10 h4" style="padding-bottom: 10px">Door Status</h5>
                            {{-- <input type="text" class="knob dial1" value="80" data-width="120" data-height="120" data-linecap="round" data-thickness="0.12" data-bgColor="#fff" data-fgColor="#1b00ff" data-angleOffset="180" readonly> --}}
                            {{-- <span class="d-block">80° Celcius</span> --}}
                            {{-- <a href="#" class="btn btn-danger btn-lg disabled" role="button" aria-disabled="true"><i class="icon-copy dw dw-door"></i> Open</a> --}}
                            <a href="#" class="btn btn-success btn-lg disabled" role="button" aria-disabled="true"><i class="icon-copy dw dw-door"></i> Close</a>
                        </div><br>
                    </div>
                </div>
				{{-- <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
					<div class="card-white pd-30 height-100-p">
						<div class="progress-box text-center">
							 <input type="text" class="knob dial4" value="65" data-width="120" data-height="120" data-linecap="round" data-thickness="0.12" data-bgColor="#fff" data-fgColor="#a683eb" data-angleOffset="180" readonly>
							<h5 class="text-light-purple padding-top-10 h5">Panding Orders</h5>
							<span class="d-block">65% Average <i class="fa text-light-purple fa-line-chart"></i></span>
						</div>
					</div>
				</div> --}}
			</div>
            <div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 mb-30">
					<div class="card-white pd-30 height-100-p">
						<h4 class="mb-30 h4">Speed Monitoring</h4>
                        <div id="chart-speed"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 mb-30">
					<div class="card-white pd-30 height-100-p">
						<h2 class="mb-30 h4">Tracking Location</h2>
						<div id="browservisit" style="width:100%!important; height:380px"></div>
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
		</div>
	{{-- </div> --}}
@endsection
@section('scriptPage')
<!-- js -->
    <script>
        // console.log('tes');
        // $(document).ready(function() {
            @foreach ($mqtt as $data)
        //     var t = Math.abs({{ $data->value['AVG_TMP'] }});
            var num = Math.abs({{ $data->value['AVG_TMP'] }});
            var nilai = {{ $data->value['AVG_TMP'] }};
            var hum = Math.abs({{ $data->value['AVG_HMD'] }});
            var nilai_hum = {{ $data->value['AVG_HMD'] }};
            @endforeach
        //     $(".dial1").knob();
        //     $({animatedVal: 0}).animate({animatedVal: t }, {
        //         duration: 2000,
        //         easing: "swing",
        //         step: function() {
        //             $(".dial1").val(Math.ceil(this.animatedVal)).trigger("change");
        //         }
        //     });
        // });

        var options6 = {
            series: [num],
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
                        return nilai + "° Celcius";
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

        var options7 = {
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
                        return nilai_hum + " Humidity";
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

        var chart6 = new ApexCharts(document.querySelector("#chart6"), options6);
        chart6.render();

        var chart7 = new ApexCharts(document.querySelector("#chart7"), options7);
        chart7.render();

        // map
        jQuery('#browservisit').vectorMap({
            map: 'world_mill_en',
            backgroundColor: '#fff',
            borderWidth: 1,
            zoomOnScroll : false,
            color: '#ddd',
            regionStyle: {
                initial: {
                    fill: '#fff'
                }
            },
            enableZoom: true,
            normalizeFunction: 'linear',
            showTooltip: true
        });

        @foreach ($mqtt as $data)
        $( "#evap" ).prop( "checked", {{ $data->value['EVAP'] }} );
        $(".evap").prop('checked', {{ $data->value['EVAP'] }}).trigger("click");
        $( "#cond" ).prop( "checked", {{ $data->value['COND'] }} );
        $( "#comp" ).prop( "checked", {{ $data->value['COMP'] }} );
        $( "#heat" ).prop( "checked", {{ $data->value['HEAT'] }} );
        @endforeach
    </script>
@endsection
