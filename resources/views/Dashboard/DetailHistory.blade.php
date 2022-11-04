@extends('layouts.MasterView')
{{-- @stack('scripts') --}}
@section('menu_history', 'active')
@section('content')
	{{-- <div class="main-container"> --}}
		{{-- <div class="xs-pd-20-10 pd-ltr-20"> --}}
			<div class="page-header">
				<div class="row">
					<div class="col-md-8 col-sm-12">
						<div class="title">
							<h4>History Dashboard</h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href={{ url('/history') }}>History</a></li>
								<li class="breadcrumb-item" aria-current="page">{{$name->topic}}</li>
							</ol>
						</nav>
					</div>
					<div class="col-md-4 col-sm-12 pull-right">
                        {{-- @foreach($mqtt as $data) --}}
                        <select class="custom-select2 form-control" onchange="location = this.value;" style="width: 100%">
                            <option>Pilih Container</option>
                            @foreach ($mqtt as $data)
                            <option value="{{ route('show.history', $data->id) }}">{{ $data->topic }}</option>
                            @endforeach
                        </select>
                        {{-- @endforeach --}}
					</div>
				</div>
			</div>
			<!-- Temperature dan Humidity -->
            <div class="card-white mb-30">
                <div class="pd-20">
                    <h4 class="h4">History Data Temperature dan Humidity</h4>
                </div>
                <div id="chart" class="chart"></div>
                <div class="pb-20">
                    <table class="data-table table hover multiple-select-row nowrap">
                        <thead>
                            <tr>
                                <th class="table-plus datatable-nosort">Date & Time</th>
                                <th>Supply Air (°C)</th>
                                <th>Return Air (°C)</th>
                                <th>Humidity (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mqtt_history as $data)
                            <tr>
                                <td class="table-plus">{{ $data->value['TIME_STR'] }}</td>
                                <td>{{ $data->value['TMP1'] }}</td>
                                <td>{{ $data->value['TMP2'] }}</td>
                                <td>{{ $data->value['AVG_HMD'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Temperature dan Humidity End -->
            <!-- History AC Control -->
			<div class="card-white mb-30">
				<div class="pd-20">
					<h4 class="h4">History Status AC Control</h4>
				</div>
				<div class="pb-20">
					<table class="data-table table hover multiple-select-row nowrap">
						<thead>
							<tr>
								<th class="table-plus datatable-nosort">Date & Time</th>
								<th>Evaporator</th>
								<th>Condensor</th>
								<th>Compressor</th>
								<th>Heater</th>
							</tr>
						</thead>
						<tbody>
                            @foreach ($mqtt_history as $data)
							<tr>
								<td class="table-plus">{{ $data->value['TIME_STR'] }}</td>
                                @if ( $data->value['EVAP'] == 1)
								<td>ON</td>
                                @else
                                <td>OFF</td>
                                @endif
								@if ( $data->value['COND'] == 1)
								<td>ON</td>
                                @else
                                <td>OFF</td>
                                @endif
                                @if ( $data->value['COMP'] == 1)
								<td>ON</td>
                                @else
                                <td>OFF</td>
                                @endif
                                @if ( $data->value['HEAT'] == 1)
								<td>ON</td>
                                @else
                                <td>OFF</td>
                                @endif
							</tr>
                            @endforeach
						</tbody>
					</table>
				</div>
			</div>
			<!-- AC Control End -->
            <!-- History Tracking Lokasi -->
			<div class="card-white mb-30">
				<div class="pd-20">
					<h4 class="h4">History Tracking Location</h4>
				</div>
				<div class="pb-20">
					<table class="data-table table hover multiple-select-row nowrap">
						<thead>
							<tr>
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
			<!-- Tracking Lokasi End -->
		{{-- </div> --}}
	{{-- </div> --}}
@endsection
@section('scriptPage')
<script>
    Highcharts.chart('chart', {
        chart: {
            type: 'line'
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: [
                @foreach ($mqtt_history as $data)
                    '{{ $data->value['TIME_STR'] }}',
                @endforeach
            ],
            labels: {
                style: {
                    color: '#1b00ff',
                    fontSize: '12px',
                }
            }
        },
        yAxis: {
            labels: {
                formatter: function () {
                    return this.value;
                },
                style: {
                    color: '#1b00ff',
                    fontSize: '14px'
                }
            },
            title: {
                text: ''
            },
        },
        credits: {
            enabled: false
        },
        tooltip: {
            crosshairs: true,
            shared: true
        },
        plotOptions: {
            spline: {
                marker: {
                    radius: 10,
                    lineColor: '#1b00ff',
                    lineWidth: 2
                }
            }
        },
        legend: {
            align: 'center',
            x: 0,
            y: 0
        },
        series: [{
            name: 'Supply Air (°C)',
            color: '#00789c',
            marker: {
                symbol: 'circle'
            },
            data: [
                @foreach ($mqtt_history as $data)
                    {{ $data->value['TMP1'] }},
                @endforeach
            ]
        },
        {
            name: 'Return Air (°C)',
            color: '#ff686b',
            marker: {
                symbol: 'circle'
            },
            data: [
                @foreach ($mqtt_history as $data)
                    {{ $data->value['TMP2'] }},
                @endforeach
            ]
        }]
    });
</script>
@endsection
