<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Sistem Inventory Sekolah</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{asset('vendors/images/apple-touch-icon.png')}}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{asset('vendors/images/favicon-32x32.png')}}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('vendors/images/favicon-16x16.png')}}">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('vendors/styles/core.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('vendors/styles/icon-font.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatables/css/dataTables.bootstrap4.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatables/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/jvectormap/jquery-jvectormap-2.0.3.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/jquery-steps/jquery.steps.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/switchery/switchery.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('vendors/styles/style.css')}}">


	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>

<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<img src="{{asset('vendors/images/logo-login.PNG')}}" alt="">
			</div>
			<div class="login-menu">
				<ul>
					<li><a href="{{ route('login') }}">Login</a></li>
				</ul>
			</div>
		</div>
	</div>
	{{-- <div class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center"> --}}
    <div class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center">
		{{-- <div class="container">
			<div class="row align-items-center"> --}}
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
                                            <th class="table-plus datatable-nosort">Name</th>
                                            <th>Age</th>
                                            <th>Office</th>
                                            <th>Address</th>
                                            <th>Start Date</th>
                                            <th>Salart</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="table-plus">Gloria F. Mead</td>
                                            <td>25</td>
                                            <td>Sagittarius</td>
                                            <td>2829 Trainer Avenue Peoria, IL 61602 </td>
                                            <td>29-03-2018</td>
                                            <td>$162,700</td>
                                        </tr>
                                        <tr>
                                            <td class="table-plus">Andrea J. Cagle</td>
                                            <td>30</td>
                                            <td>Gemini</td>
                                            <td>1280 Prospect Valley Road Long Beach, CA 90802 </td>
                                            <td>29-03-2018</td>
                                            <td>$162,700</td>
                                        </tr>
                                        <tr>
                                            <td class="table-plus">Andrea J. Cagle</td>
                                            <td>20</td>
                                            <td>Gemini</td>
                                            <td>2829 Trainer Avenue Peoria, IL 61602 </td>
                                            <td>29-03-2018</td>
                                            <td>$162,700</td>
                                        </tr>
                                        <tr>
                                            <td class="table-plus">Andrea J. Cagle</td>
                                            <td>30</td>
                                            <td>Sagittarius</td>
                                            <td>1280 Prospect Valley Road Long Beach, CA 90802 </td>
                                            <td>29-03-2018</td>
                                            <td>$162,700</td>
                                        </tr>
                                        <tr>
                                            <td class="table-plus">Andrea J. Cagle</td>
                                            <td>25</td>
                                            <td>Gemini</td>
                                            <td>2829 Trainer Avenue Peoria, IL 61602 </td>
                                            <td>29-03-2018</td>
                                            <td>$162,700</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
			{{-- </div>
		</div> --}}
	</div>
	<!-- success Popup html Start -->
	<button type="button" id="success-modal-btn" hidden data-toggle="modal" data-target="#success-modal" data-backdrop="static">Launch modal</button>
	<div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered max-width-400" role="document">
			<div class="modal-content">
				<div class="modal-body text-center font-18">
					<h3 class="mb-20">Form Submitted!</h3>
					<div class="mb-30 text-center"><img src="vendors/images/success.png"></div>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				</div>
				<div class="modal-footer justify-content-center">
					<a href="login.html" class="btn btn-primary">Done</a>
				</div>
			</div>
		</div>
	</div>
	<!-- success Popup html End -->
	<!-- js -->
	<script src="{{asset('vendors/scripts/core.js')}}"></script>
	<script src="{{asset('vendors/scripts/script.min.js')}}"></script>
	<script src="{{asset('vendors/scripts/process.js')}}"></script>
	<script src="{{asset('vendors/scripts/layout-settings.js')}}"></script>
    {{-- High Charts --}}
    <script src="{{asset('src/plugins/highcharts-6.0.7/code/highcharts.js')}}"></script>
	<script src="{{asset('https://code.highcharts.com/highcharts-3d.js')}}"></script>
	<script src="{{asset('src/plugins/highcharts-6.0.7/code/highcharts-more.js')}}"></script>
	<script src="{{asset('vendors/scripts/highchart-setting.js')}}"></script>

	<script src="{{asset('src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
	<script src="{{asset('src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{asset('src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('vendors/scripts/datatable-setting.js')}}"></script>
	<script src="{{asset('vendors/scripts/dashboard.js')}}"></script>
    <script src="{{asset('src/plugins/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('src/plugins/jQuery-Knob-master/jquery.knob.min.js')}}"></script>
	<script src="{{asset('src/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js')}}"></script>
	<script src="{{asset('src/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
	<script src="{{asset('vendors/scripts/dashboard2.js')}}"></script>
    <script src="{{asset('src/plugins/jquery-steps/jquery.steps.js')}}"></script>
	<script src="{{asset('vendors/scripts/steps-setting.js')}}"></script>
    <!-- switchery js -->
	<script src="{{asset('src/plugins/switchery/switchery.min.js')}}"></script>
    <script src="{{asset('vendors/scripts/advanced-components.js')}}"></script>
</body>

</html>
