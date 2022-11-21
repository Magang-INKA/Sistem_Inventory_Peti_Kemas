<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Sistem Inventory Peti Kemas</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="200x200" href="{{asset('vendors/images/round-2.png')}}">
	<link rel="icon" type="image/png" sizes="35x35" href="{{asset('vendors/images/round-2.png')}}">
	<link rel="icon" type="image/png" sizes="20x20" href="{{asset('vendors/images/round-2.png')}}">

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
			<div class="" style="padding-left: 50px;">
				<img src="{{asset('vendors/images/logo-inventory-3b.png')}}" alt="" style="height:75px; padding-top:5px; padding-bottom:5px;">
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
				{{-- <div class="row"> --}}
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                        <div class="card-white pd-30 height-100-p">
                            <h2 class="mb-30 h4">Tracking Location</h2>
                            {{-- <div id="browservisit" style="width:100%!important; height:380px"></div> --}}
                            {{-- <br> --}}
                            <div class="pb-20">
                                <form class="form" method="GET" action="{{ url('/tracking') }}">
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-6">
                                            <input class="form-control search-input" type="text" name="search" id="search" placeholder="Masukkan Kode Pesanan">
                                        </div>
                                        <div class="col-sm-12 col-md-3 pull-right">
                                            {{-- <a type="submit" class="btn" data-bgcolor="#3b5998" data-color="#ffffff">
                                                Tracking
                                            </a> --}}
                                            <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i> Tracking</button>
                                        </div>
                                    </div>
                                </form>
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success">
                                        <p>{{ $message }}</p>
                                    </div>
                                @endif
                                <table class="data-table table hover multiple-select-row nowrap">
                                    <thead>
                                        <tr class="table-primary">
                                            <th class="table-plus datatable-nosort">Date & Time</th>
                                            <th>Drop Point</th>
                                            <th>Alamat</th>
                                            {{-- <th>Nama Kapal</th>
                                            <th>Nama Container</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach ($mqtt_history as $data)
                                            <tr>
                                                <td class="table-plus">{{ $data->value['TIME_STR'] }}</td>
                                                {{-- <td>{{ $data->id }}</td>
                                                <td>{{ $data->mqtt->topic }}</td> --}}
                                                <td>{{ $data->value['LAT_STRING'] }}</td>
                                                <td>{{ $data->value['LON_STRING'] }}</td>
                                            </tr>
                                            @endforeach
                                        {{-- <tr>
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
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                {{-- </div> --}}
			{{-- </div>
		</div> --}}
	</div>
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
