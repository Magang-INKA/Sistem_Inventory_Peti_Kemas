<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
    {{-- <meta http-equiv="refresh" content="3" /> --}}
	<title>Sistem Inventory Peti Kemas</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="200x200" href="{{asset('vendors/images/inka.png')}}">
	<link rel="icon" type="image/png" sizes="35x35" href="{{asset('vendors/images/inka.png')}}">
	<link rel="icon" type="image/png" sizes="20x20" href="{{asset('vendors/images/inka.png')}}">

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

    <!-- Datatable Setting js -->
	 {{-- <script src="{{asset('vendors/scripts/datatable-setting.js')}}"></script>  --}}
    @yield('scriptPage')
    @livewireScripts
</body>
</html>
