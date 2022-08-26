@extends('layouts.MasterView')
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
                        <select class="custom-select2 form-control" name="state" style="width: 50%; height: 38px;">
                            <option value="">Pilih Container</option>
                            <option value="AK">Alaska</option>
                            <option value="HI">Hawaii</option>
                            <option value="CA">California</option>
                            <option value="NV">Nevada</option>
                            <option value="OR">Oregon</option>
                            <option value="WA">Washington</option>
                        </select>
					</div>
				</div>
			</div>
			<div class="row clearfix progress-box">
                <div class="col-lg-4 col-md-12 col-sm-12 mb-30">
					<div class="card-white posisi-card pd-20 height-100-p">
						<div class="progress-box text-center">
                            <h5 class="padding-top-10 h4">Capacity</h5><br>
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
				<div class="col-lg-3 col-md-12 col-sm-12 mb-30">
					<div class="card-white pd-20 height-50-p">
						<div class="progress-box text-center">
                            <h5 class="padding-top-10 h4">Temperature</h5>
							<input type="text" class="knob dial1" value="80" data-width="120" data-height="120" data-linecap="round" data-thickness="0.12" data-bgColor="#fff" data-fgColor="#1b00ff" data-angleOffset="180" readonly>
                            <span class="d-block">80° Celcius</span>
						</div>
					</div><br>
                    <div class="card-white pd-20 height-50-p">
						<div class="progress-box text-center">
                            <h5 class="padding-top-10 h4">Door Status</h5>
							{{-- <input type="text" class="knob dial1" value="80" data-width="120" data-height="120" data-linecap="round" data-thickness="0.12" data-bgColor="#fff" data-fgColor="#1b00ff" data-angleOffset="180" readonly> --}}
                            {{-- <span class="d-block">80° Celcius</span> --}}
                            {{-- <a href="#" class="btn btn-danger btn-lg disabled" role="button" aria-disabled="true"><i class="icon-copy dw dw-door"></i> Open</a> --}}
                            <a href="#" class="btn btn-success btn-lg disabled" role="button" aria-disabled="true"><i class="icon-copy dw dw-door"></i> Close</a>
						</div>
					</div>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 mb-30">
					<div class="card-white pd-20 height-100-p">
						<div class="progress-box text-center">
                            <h5 class="padding-top-10 h4">AC Control</h5><br>
                            <div class="row clearfix">
                                <div class="col-md-6 col-sm-12 mb-30">
                                    <div class="card text-white bg-info card-box">
                                        <div class="card-header">Evaporator<br>
                                            <input type="checkbox" checked class="switch-btn" data-size="small" data-color="#0059b2">
                                        </div>

                                        {{-- <div class="card-body">
                                            <h5 class="card-title text-white">Primary card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 mb-30">
                                    <div class="card text-white bg-secondary card-box">
                                        <div class="card-header">Compressor<br>
                                            <input type="checkbox" checked class="switch-btn" data-size="small" data-color="#41ccba">
                                        </div>
                                        {{-- <div class="card-body">
                                            <h5 class="card-title text-white">Primary card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 mb-30">
                                    <div class="card text-white bg-secondary card-box">
                                        <div class="card-header">Condenser<br>
                                            <input type="checkbox" checked class="switch-btn" data-size="small" data-color="#41ccba">
                                        </div>
                                        {{-- <div class="card-body">
                                            <h5 class="card-title text-white">Primary card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 mb-30">
                                    <div class="card text-white bg-info card-box">
                                        <div class="card-header">Heater<br>
                                            <input type="checkbox" checked class="switch-btn" data-size="small" data-color="#0059b2">
                                        </div>
                                        {{-- <div class="card-body">
                                            <h5 class="card-title text-white">Primary card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
							{{-- <span class="d-block">90% Average</span> --}}
							 {{-- <input type="text" class="knob dial3" value="90" data-width="120" data-height="120" data-linecap="round" data-thickness="0.12" data-bgColor="#fff" data-fgColor="#f56767" data-angleOffset="180" readonly> --}}

						</div>
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
                            <table class="table hover multiple-select-row data-table-export nowrap">
                                <thead>
                                    <tr class="table-primary">
                                        <th class="table-plus datatable-nosort">Date & Time</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="table-plus">2022-08-24 07:58:59</td>
                                        <td>-6.193125</td>
                                        <td>106.821810</td>
                                    </tr>
                                    <tr>
                                        <td class="table-plus">2022-08-24 07:58:59</td>
                                        <td>-6.193125</td>
                                        <td>106.821810</td>
                                    </tr>
                                    <tr>
                                        <td class="table-plus">2022-08-24 07:58:59</td>
                                        <td>-6.193125</td>
                                        <td>106.821810</td>
                                    </tr>
                                    <tr>
                                        <td class="table-plus">2022-08-24 07:58:59</td>
                                        <td>-6.193125</td>
                                        <td>106.821810</td>
                                    </tr>
                                    <tr>
                                        <td class="table-plus">2022-08-24 07:58:59</td>
                                        <td>-6.193125</td>
                                        <td>106.821810</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
					</div>
				</div>
			</div>
		</div>
	{{-- </div> --}}
	<!-- js -->
	{{-- <script src="{{asset('vendors/scripts/core.js')}}"></script>
	<script src="{{asset('vendors/scripts/script.min.js')}}"></script>
	<script src="{{asset('vendors/scripts/process.js')}}"></script>
	<script src="{{asset('vendors/scripts/layout-settings.js')}}"></script>
	<script src="{{asset('src/plugins/jQuery-Knob-master/jquery.knob.min.js')}}"></script>
	<script src="{{asset('src/plugins/highcharts-6.0.7/code/highcharts.js')}}"></script>
	<script src="{{asset('src/plugins/highcharts-6.0.7/code/highcharts-more.js')}}"></script>
	<script src="{{asset('src/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js')}}"></script>
	<script src="{{asset('src/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
	<script src="{{asset('vendors/scripts/dashboard2.js')}}"></script> --}}
@endsection
