<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>SimocoRC</title>

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

<body>
    <div class="login-header box-shadow fixed-top">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="" style="padding-left: 50px;">
				<img src="{{asset('vendors/images/logo-inventory-3b.png')}}" alt="" style="height:75px; padding-top:5px; padding-bottom:5px;">
			</div>
            <div class="tab">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link text-blue" href="{{ url('tracking') }}" role="tab" aria-selected="true" >Tracking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-blue" href="{{ route('register') }}"  role="tab" aria-selected="false">Register</a>
                    </li>
                </ul>
            </div>
		</div>
	</div>
    @include('ContentLanding')
    <script src="{{asset('vendors/scripts/core.js')}}"></script>
	<script src="{{asset('vendors/scripts/script.min.js')}}"></script>
	<script src="{{asset('vendors/scripts/process.js')}}"></script>
	<script src="{{asset('vendors/scripts/layout-settings.js')}}"></script>
</body>
</html>
