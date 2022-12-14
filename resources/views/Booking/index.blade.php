@extends('layouts.MasterView')
@section('menu_booking', 'active')
@section('content')
<div >
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Booking Data</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('booking.index') }}">Booking</a></li>
                        <li class="breadcrumb-item" aria-current="page">Index</li>
                    </ol>
                </nav>
            </div>
            {{-- <div class="col-md-6 col-sm-12 text-right">
                <a href="#" type="button" class="btn btn-primary" data-toggle="dropdown" data-color="#ffffff">
                    <i class="icon-copy fa fa-download" aria-hidden="true"></i>
                    Report Download
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{url('/laporan/booking')}}">PDF</a>
                    <a class="dropdown-item" href="{{url('/laporan/booking/excel')}}">Excel</a>
                </div>
            </div> --}}
            {{-- <div class="col-md-6 col-sm-12 text-right">
                <a class="btn btn-primary" href="{{ url('/laporan/barang') }}">
                    Download Laporan
                </a>
            </div> --}}
        </div>
    </div>

    <!-- multiple select row Datatable start -->
    <div class="page-header mb-30">
        <div class="pb-20">
            <div class="header-left">
                <div class="header-search col-sm-12">
                    <form class="form" method="GET" action="{{ route('booking.index') }}">
                        <div class="form-group mb-0">
                            <input type="text" class="form-control search-input" name="search" placeholder="Search Here">
                            <div class="dropdown">
                                <a class="dropdown-toggle no-arrow" type="submit">
                                    <i class="dw dw-search2 search-icon"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- @can('manage-MasterData')
                <div class="col-md-40 col-sm-12 text-right">
                    <a class="btn btn-success" href="{{ route('barang.create') }}"> Create Data </a>
                </div>
                @endcan --}}
            </div>
        </div>
        <div class="pb-20">
            <table class="data-table table hover multiple-select-row nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">No</th>
                        <th>No Resi</th>
                        <th>Vessel Name</th>
                        <th>Departure</th>
                        <th>Booking State</th>
                        @can('manage-MasterData')
                        <th class="datatable-nosort">Action</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach($booking as $br => $data)
                    <tr>
                        <td class="table-plus">{{ $loop->iteration }}</td>
                        <td>{{ $data->no_resi }}</td>
                        <td>{{ $data->jadwalKapal->trip->kapal->nama_kapal }}</td>
                        <td>{{ $data->jadwalKapal->awal->nama_pelabuhan }}=>{{ $data->jadwalKapal->ETD_awal }}</td>
                        <td>{{ $data->status }}</td>
                        {{-- @can('manage-MasterData') --}}
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <form action="{{ route('booking.destroy', $data->id) }}" method="POST">
                                        <a class="dropdown-item" href="{{ route('booking.edit', $data->id) }}"><i class="dw dw-edit2"></i> Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button class="dropdown-item" onclick="return confirm('Anda yakin ingin meghapus data ini ?')" type="submit">
                                            <i class="dw dw-delete-3"></i> Delete
                                    </form>
                                </div>
                            </div>
                        </td>
                        {{-- @endcan --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- multiple select row Datatable End -->
@endsection
