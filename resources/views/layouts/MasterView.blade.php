<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
    {{-- <meta http-equiv="refresh" content="3" /> --}}
	<title>SimocoRC</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="200x200" href="{{asset('vendors/images/round-2.png')}}">
	<link rel="icon" type="image/png" sizes="35x35" href="{{asset('vendors/images/round-2.png')}}">
	<link rel="icon" type="image/png" sizes="20x20" href="{{asset('vendors/images/round-2.png')}}">

	<!-- Select2 CSS -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
    {{-- JS Filter --}}
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{-- End JS Filter --}}
    @livewireStyles
</head>
<style>

	/* Hide all steps by default: */
	.tab {
	  display: none;
	}

	button {
	  background-color: #04AA6D;
	  color: #ffffff;
	  border: none;
	  padding: 10px 20px;
	  font-size: 17px;
	  font-family: Raleway;
	  cursor: pointer;
	}

	button:hover {
	  opacity: 0.8;
	}

	#prevBtn {
	  background-color: #bbbbbb;
	}

	/* Make circles that indicate the steps of the form: */
	.step {
	  height: 15px;
	  width: 15px;
	  margin: 0 2px;
	  background-color: #bbbbbb;
	  border: none;
	  border-radius: 50%;
	  display: inline-block;
	  opacity: 0.5;
	}

	.step.active {
	  opacity: 1;
	}

	/* Mark the steps that are finished and valid: */
	.step.finish {
	  background-color: #04AA6D;
	}
	</style>

<body>

	{{--  Header  --}}
    @include('layouts.header')

	{{--  Setting Tema  --}}
    @include('layouts.SettingTema')

	{{--  Sidebar  --}}
    @include('layouts.sidebar')

	<div class="main-container">
		<div class="pd-ltr-20">

            {{--  Content  --}}
            @yield('content')

			{{--  Footer  --}}
            @include('layouts.footer')
		</div>
	</div>
    {{--  Alert  --}}
    @include('sweetalert::alert')
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
    {{-- <script src="{{asset('vendors/scripts/dashboard2.js')}}"></script> --}}
    <script src="{{asset('src/plugins/jquery-steps/jquery.steps.js')}}"></script>
	<script src="{{asset('vendors/scripts/steps-setting.js')}}"></script>
    <!-- switchery js -->
	<script src="{{asset('src/plugins/switchery/switchery.min.js')}}"></script>
    <script src="{{asset('vendors/scripts/advanced-components.js')}}"></script>

	<!-- Select2 -->
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Datatable Setting js -->
	 {{-- <script src="{{asset('vendors/scripts/datatable-setting.js')}}"></script>  --}}
	 @stack('javascript-internal')
    @yield('scriptPage')
    @livewireScripts
</body>
</html>
