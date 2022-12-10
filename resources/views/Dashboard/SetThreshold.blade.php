@extends('layouts.MasterView')
{{-- @stack('scripts') --}}
@section('menu_controlling', 'active')
@section('content')
	{{-- <div class="main-container"> --}}
		{{-- <div class="xs-pd-20-10 pd-ltr-20"> --}}
			<div class="page-header">
				<div class="row">
					<div class="col-md-8 col-sm-12">
						<div class="title">
							<h4>Set Threshold Suhu</h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href={{ url('/') }}>Home</a></li>
								<li class="breadcrumb-item" aria-current="page">Set Threshold Suhu</li>
							</ol>
						</nav>
					</div>
					{{-- <div class="col-md-4 col-sm-12 pull-right">
                        <select class="custom-select2 form-control" aria-placeholder="Pilih Container" name="state" onchange="location = this.value;" style="width: 100%;">
                            <option>Pilih Container</option>
                            @foreach ($mqtt as $data)
                            <option value="{{ route('dashboard.show', $data->id) }}">{{ $data->topic }}</option>
                            @endforeach
                        </select>
					</div> --}}
				</div>
			</div>

            <div class="row clearfix progress-box">
                <div class="col-lg-6 col-md-12 col-sm-12 mb-30">
                    <div class="card-white pd-20 height-100-p">
                        <div class="progress-box">
                            <h5 class="text-center">Form Set Threshold</h5><br><br>
                            <form method="POST" action="{{ route('threshold-suhu.store') }}" id="myForm" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-3 col-form-label" for="no_container">Container</label>
                                    <div class="col-sm-12 col-md-9">
                                        <select class="custom-select col-12" id="no_container" name="no_container" required>
                                            <option selected="" disabled>Choose Container</option>
                                            @foreach ($container as $rc)
                                               <option value="{{ $rc->no_container }}">{{ $rc->no_container }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-3 col-form-label" for="suhu_ketetapan">Threshold (°C)</label>
                                    <div class="col-sm-12 col-md-9">
                                        <input class="form-control" type="number" name="suhu_ketetapan" id="suhu_ketetapan" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary">Set Threshold</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 mb-30">
                    <div class="card-white pd-20 height-100-p align-items-center">
                        <div class="progress-box text-center">
                            <h5>Result</h5>
                            {{-- <div class="row clearfix progress-box"> --}}
                                <div class="highcharts-figure" style="display: block; margin: auto;">
                                    <div id="container-speed" class="chart-container"></div>
                                    <p class="highcharts-description">
                                        <strong>Last Set Threshold:</strong> {{ $result->no_container}} => ({{ $result->suhu_ketetapan}} °C)
                                    </p>
                                {{-- </div> --}}
                                </div>
                        </div>
                    </div>
                </div>
            </div>
		{{-- </div> --}}
	{{-- </div> --}}
@endsection
@section('scriptPage')
<script>
    var gaugeOptions = {
        chart: {
            type: 'solidgauge'
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
    var chartSpeed = Highcharts.chart('container-speed', Highcharts.merge(gaugeOptions, {
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
            name: 'Speed',
            data: [{{ $result->suhu_ketetapan }}],
            dataLabels: {
            format:
                '<div style="text-align:center">' +
                '<span style="font-size:18px">{y} °C</span><br/>' +
                '<span style="font-size:12px;opacity:0.4"></span>' +
                '</div>'
            },
            tooltip: {
            valueSuffix: '°C'
            }
        }]

    }));

    // Bring life to the dials
    // setInterval(function () {
    //     // Speed
    //     var point,
    //         newVal,
    //         inc;

    //     if (chartSpeed) {
    //         point = chartSpeed.series[0].points[0];
    //         inc = Math.round((Math.random() - 0.5) * 100);
    //         newVal = point.y + inc;

    //         if (newVal < 0 || newVal > 200) {
    //             newVal = point.y - inc;
    //         }

    //         point.update(newVal);
    //     }

    // }, 2000);
</script>
@endsection
