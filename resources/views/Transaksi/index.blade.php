@extends('layouts.MasterView')
@section('menu_transaksi', 'active')
@section('content')
<div >
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Transaction Data</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('transaksi.index') }}">Transaction</a></li>
                        <li class="breadcrumb-item" aria-current="page">Index</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <a href="#" type="button" class="btn btn-primary" data-toggle="dropdown" data-color="#ffffff">
                    <i class="icon-copy fa fa-download" aria-hidden="true"></i>
                    Report Download
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{url('/laporan/transaksi')}}">PDF</a>
                    <a class="dropdown-item" href="{{url('/laporan/transaksi/excel')}}">Excel</a>
                </div>
            </div>
        </div>
    </div>

    <!-- multiple select row Datatable start -->
    <div class="page-header mb-30">
        <div class="pb-20">
            <table class="data-table table hover multiple-select-row nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">No</th>
                        <th>QR Code</th>
                        <th>ID Booking</th>
                        <th>Harga</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $tr => $data)
                    <tr>
                        <td class="table-plus">{{++$tr}}</td>
                        <td><img src="data:image/png;base64,{{ base64_encode(SimpleSoftwareIO\QrCode\Facades\QrCode::size(75)->format('png')->generate($data->id_booking) ) }}"></td>
                        <td>{{ $data->id_booking }}</td>
                        <td>{{ $data->harga }}</td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <form action="{{ route('transaksi.destroy', $data->id) }}" method="POST">
                                        <a class="dropdown-item" href="{{ route('resi', $data->id) }}"><i class="dw dw-download"></i> Cetak Resi</a>
                                        <a class="dropdown-item" href="{{ route('transaksi.edit', $data->id) }}"><i class="dw dw-edit2"></i> Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button class="dropdown-item" onclick="return confirm('Anda yakin ingin meghapus data ini ?')" type="submit">
                                            <i class="dw dw-delete-3"></i> Delete
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- multiple select row Datatable End -->
@endsection
