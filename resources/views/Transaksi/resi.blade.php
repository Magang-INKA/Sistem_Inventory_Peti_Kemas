<!DOCTYPE html>
<html>
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
                {{-- Resi --}}
				<div class="invoice-wrap">
					<div class="invoice-box">
						<div class="invoice-header">
							<div class="logo text-center">

							</div>
						</div>
						<div class="row pb-30">
							<div class="col-md-6">
								<img src="{{asset('vendors/images/logo-inventory-3b.png')}}" alt="" style="height:75px; padding-top:5px; padding-bottom:5px;">
							</div>
							<div class="col-md-6">
								<div class="text-right">
									<h4 class="mb-15">INVOICE</h5>
								</div>
							</div>
						</div>

						<div class="row pb-30">
							<div class="col-md-6">
								<h5 class="mb-15">From</h5>
								@foreach ($transaksi as $data)
                                <p class="font-14 mb-5">Pengirim: <strong class="weight-600">{{$data->no_resi}}</strong></p>
                                <p class="font-14 mb-5">No Telp : <strong class="weight-600">{{$data->no_telp}}</strong></p>
								<p class="font-14 mb-5">Email : <strong class="weight-600">{{$data->email}}</strong></p>
                                @endforeach
								{{-- <p class="font-14 mb-5">Invoice No: <strong class="weight-600">{{$transaksi->no_resi}}</strong></p> --}}
							</div>
							<div class="col-md-6">
								<div class="text-right">
									<h5 class="mb-15">To</h5>
									@foreach ($transaksi as $data)
									<p class="font-14 mb-5">Penerima: <strong class="weight-600">{{$data->nama_penerima}}</strong></p>
									<p class="font-14 mb-5">No Telp: <strong class="weight-600">{{$data->telp_penerima}}</strong></p>
									<p class="font-14 mb-5">Alamat: <strong class="weight-600">{{$data->alamat_penerima}}</strong></p>
									@endforeach
								</div>
							</div>
						</div>
						<div class="row pb-30">
							<div class="col-md-4">
								@foreach ($transaksi as $data)
								<h5 class="mb-15">{{$data->nama_barang}}</h5>
                                @endforeach
							</div>
							<div class="col-md-4">
								@foreach ($transaksi as $data)
                                <p class="font-14 mb-5">Berat: <strong class="weight-600">{{$data->nama_barang}}</strong></p>
                                @endforeach
							</div>
							<div class="col-md-4">
								@foreach ($transaksi as $data)
                                <p class="font-14 mb-5">Biaya: <strong class="weight-600">{{$data->harga}}</strong></p>
                                @endforeach
							</div>

						</div>
						<div class="row pb-30">
							<div class="col-md-4">
								<h5 class="mb-15">Detail Perjalanan</h5>
								@foreach ($transaksi as $data)
                                <p class="font-14 mb-5"><strong class="weight-600">{{$data->nama_kapal}}</strong></p>
                                <p class="font-14 mb-5">{{$data->no_kapal}}<strong class="weight-600"></strong></p>
                                @endforeach
								{{-- <p class="font-14 mb-5">Invoice No: <strong class="weight-600">{{$transaksi->no_resi}}</strong></p> --}}
							</div>
							<div class="col-md-4">
								<h5 class="mb-15">Pelabuhan</h5>
								@foreach ($transaksi as $data)
                                <p class="font-14 mb-5"><strong class="weight-600">{{$data->asal}}</strong></p>
                                <p class="font-14 mb-5">{{$data->tujuan}}<strong class="weight-600"></strong></p>
                                @endforeach
								{{-- <p class="font-14 mb-5">Invoice No: <strong class="weight-600">{{$transaksi->no_resi}}</strong></p> --}}
							</div>
							<div class="col-md-4">
								<h5 class="mb-15">ETA/ETD</h5>
								@foreach ($transaksi as $data)
                                <p class="font-14 mb-5"><strong class="weight-600">{{$data->ETA}}</strong></p>
                                <p class="font-14 mb-5">{{$data->ETD}}<strong class="weight-600"></strong></p>
                                @endforeach
								{{-- <p class="font-14 mb-5">Invoice No: <strong class="weight-600">{{$transaksi->no_resi}}</strong></p> --}}
							</div>
						</div>
						<div class="invoice-desc pb-30">
							<div class="invoice-desc-footer">
								<div class="invoice-desc-head clearfix">
									<div class="invoice-sub">Detail Perjalanan</div>
									<div class="invoice-rate">Barang</div>
									<div class="invoice-subtotal">Barcode</div>
								</div>
								<div class="invoice-desc-body">
									<ul>
										<li class="clearfix">
											<div class="invoice-sub">
												@foreach ($transaksi as $data)
												<p class="font-14 mb-5">Kapal: <strong class="weight-600">{{$data->nama_kapal}}</strong></p>
												<p class="font-14 mb-5">Asal: <strong class="weight-600">{{$data->asal}}</strong></p>
												<p class="font-14 mb-5">Tujuan:<strong class="weight-600">{{$data->tujuan}}</strong></p>
												<p class="font-14 mb-5">ETA: <strong class="weight-600">{{$data->ETA}}</strong></p>
												<p class="font-14 mb-5">ETD:<strong class="weight-600">{{$data->ETD}}</strong></p>
												@endforeach
											</div>
											<div class="invoice-rate font-20 weight-600">
												@foreach ($transaksi as $data)
												<p class="font-14 mb-5"><strong class="weight-600">{{$data->nama_barang}}</strong></p>
												<p class="font-14 mb-5"><strong class="weight-600">{{$data->berat_barang}} KG</strong></p>
												@endforeach
											</div>
											<div class="invoice-subtotal">
												@foreach ($transaksi as $data)
												<img src="data:image/png;base64,{{ base64_encode(SimpleSoftwareIO\QrCode\Facades\QrCode::size(300)->format('png')->generate($data->id_booking) ) }}">
												@endforeach
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<h4 class="text-center pb-20">Thank You!!</h4>
					</div>
				</div>
			{{-- </div>

		</div>
	</div> --}}
	<!-- js -->
	<script src="{{asset('vendors/scripts/core.js')}}"></script>
	<script src="{{asset('vendors/scripts/script.min.js')}}"></script>
	<script src="{{asset('vendors/scripts/process.js')}}"></script>
	<script src="{{asset('vendors/scripts/layout-settings.js')}}"></script>
</body>
</html>
