<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Some Random Title</title>
    <style>
        body{
            /* font-family: "Courier New", Courier, "Lucida Sans Typewriter", "Lucida Typewriter", monospace !important; */
            letter-spacing: -0.3px;
        }
        .invoice-wrapper{ width: 700px; margin: auto; }
        .nav-sidebar .nav-header:not(:first-of-type){ padding: 1.7rem 0rem .5rem; }
        .logo{ font-size: 50px; }
        .sidebar-collapse .brand-link .brand-image{ margin-top: -33px; }
        .content-wrapper{ margin: auto !important; }
        .billing-company-image { width: 50px; }
        .billing_name { text-transform: uppercase; }
        .billing_address { text-transform: capitalize; }
        .table{ width: 65%; border-collapse: collapse;}
        th{ text-align: left; padding: 10px; }
        td{ padding: 10px; vertical-align: top;}
        .row{ display: block; clear: both; }
        .text-right{ text-align: right; }
        .table-hover thead tr{ background: #eee; }
        .table-hover tbody tr:nth-child(even){ background: #fbf9f9; }
        address{ font-style: normal; }
    </style>
</head>
<body>
    <form>
    <div class="row invoice-wrapper">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <tr>
                            <td>
                                <div class="col-md-6">
                                    <img src="{{ltrim(public_path('vendors/images/logo-inventory-3b.png'))}}" alt="" style="height:55px; padding-top:5px; padding-bottom:5px;">
                                </div>
                            </td>
                            <td>
                                <div class="col-md-6">
                                    <div class="text-right">
                                        <h2 class="mb-15">INVOICE</h5>
                                        <p class="font-14 mb-5">No Resi: <strong class="weight-600">{{$transaksi->no_resi}}</strong></p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            {{-- <br><br> --}}
            <div class="row invoice-info">
                <div class="col-md-12">
                    <table class="table">
                        <tr>
                            <td>
                                <div class="">
                                    <strong>From</strong>
                                    <p class="font-14 mb-5">Pengirim: <strong class="weight-600">{{$transaksi->name}}</strong></p>
                                    <p class="font-14 mb-5">No Telp : <strong class="weight-600">{{$transaksi->no_telp}}</strong></p>
							        <p class="font-14 mb-5">Email : <strong class="weight-600">{{$transaksi->email}}</strong></p>
                                </div>
                            </td>
                            <td>
                                <div class="text-right">
                                    <strong>To</strong>
                                    <p class="font-14 mb-5">Penerima: <strong class="weight-600">{{$transaksi->nama_penerima}}</strong></p>
                                    <p class="font-14 mb-5">No Telp: <strong class="weight-600">{{$transaksi->telp_penerima}}</strong></p>
                                    <p class="font-14 mb-5">Alamat: <strong class="weight-600">{{$transaksi->alamat_penerima}}</strong></p>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <tr>
                            <td>
                                <div class="col-md-4">
                                    <h5 class="mb-15">Nama Barang </h5>
                                    <p class="font-14 mb-5">{{$transaksi->nama_barang}}</p>
                                </div>
                            </td>
                            <td>
                                <div class="col-md-4" style="text-align: center">
                                    <h5 class="mb-15">Berat </h5>
                                    <p class="font-14 mb-5">{{$transaksi->berat_barang}} kg</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-right">
                                    <h5 class="mb-15">Biaya</h5>
                                    <p class="font-14 mb-5">Rp.{{$transaksi->harga}}</p>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <tr>
                            <td>
                                <div class="col-md-4">
                                    <h5 class="mb-15">Detail Perjalanan</h5>
                                    <p class="font-14 mb-5">Kapal: {{$transaksi->nama_kapal}}</p>
                                </div>
                            </td>
                            <td>
                                <div class="col-md-4" style="text-align: center">
                                    <h5 class="mb-15">Pelabuhan</h5>
                                    <p class="font-14 mb-5">{{$transaksi->asal}}</p>
                                    <p class="font-14 mb-5">{{$transaksi->tujuan}}</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-right">
                                    <h5 class="mb-15">ETD/ETA</h5>
                                        <p class="font-14 mb-5">{{$transaksi->ETD_awal}}</p>
                                        <p class="font-14 mb-5">{{$transaksi->ETA_tujuan}}</p>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <tr>
                            <td>
                                <div class="col-md-6">
                                    <img src="{{ltrim(public_path('vendors/images/logo-inventory-3b.png'))}}" alt="" style="height:55px; padding-top:5px; padding-bottom:5px;">
                                </div>
                            </td>
                            <td>
                                <div class="col-md-6">
                                    <div class="text-right">
                                        <h2 class="mb-15">INVOICE</h5>
                                        <p class="font-14 mb-5">No Resi: <strong class="weight-600">{{$transaksi->no_resi}}</strong></p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table">
                    <tr>
                        <td>
                            <div class="">
                                <strong>From</strong>
                                <p class="font-14 mb-5">Pengirim: <strong class="weight-600">{{$transaksi->name}}</strong></p>
                                <p class="font-14 mb-5">No Telp : <strong class="weight-600">{{$transaksi->no_telp}}</strong></p>
                                <p class="font-14 mb-5">Email : <strong class="weight-600">{{$transaksi->email}}</strong></p>
                            </div>
                        </td>
                        <td>
                            <div class="text-right">
                                <strong>To</strong>
                                <p class="font-14 mb-5">Penerima: <strong class="weight-600">{{$transaksi->nama_penerima}}</strong></p>
                                <p class="font-14 mb-5">No Telp: <strong class="weight-600">{{$transaksi->telp_penerima}}</strong></p>
                                <p class="font-14 mb-5">Alamat: <strong class="weight-600">{{$transaksi->alamat_penerima}}</strong></p>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th>Detail Perjalanan</th>
                                <th>Barang</th>
                                <th>Barcode</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <p class="font-14 mb-5">Kapal: <strong class="weight-600">{{$transaksi->nama_kapal}}</strong></p>
                                    <p class="font-14 mb-5">Asal: <strong class="weight-600">{{$transaksi->asal}}</strong></p>
                                    <p class="font-14 mb-5">Tujuan: <strong class="weight-600">{{$transaksi->tujuan}}</strong></p>
                                    <p class="font-14 mb-5">ETD: <strong class="weight-600">{{$transaksi->ETD_awal}}</strong></p>
                                    <p class="font-14 mb-5">ETA: <strong class="weight-600">{{$transaksi->ETA_tujuan}}</strong></p>
                                </td>
                                <td>
                                    <p class="font-14 mb-5">Nama barang: <strong class="weight-600">{{$transaksi->nama_barang}}</strong></p>
								<p class="font-14 mb-5">Berat: <strong class="weight-600">{{$transaksi->berat_barang}} KG</strong></p>
                                </td>
                                <td>
                                    <img src="data:image/png;base64,{{ base64_encode(SimpleSoftwareIO\QrCode\Facades\QrCode::size(160)->format('png')->generate($transaksi->id_booking) ) }}">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            {{-- <br><br><br> --}}
        </div>
    </div>
</form>
</body>
</html>
