@extends('layouts.MasterView')
@section('menu_booking', 'active')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Menu Detail Booking</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('booking.index') }}">Booking</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Show</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <i class="icon-copy fa fa-info-circle fa-3x" aria-hidden="true"></i>
        </div>
    </div>
</div>
<!-- Default Basic Forms Start -->
<div class="pd-20 card-white mb-30">
	<form method="POST" action="{{ route('booking.update', $booking->id) }}" id="myForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
		<div class="form-group row">
			<label for="no_telp" class="col-sm-12 col-md-2 col-form-label">No Resi</label>
			<div class="col-sm-12 col-md-10">
            <input name="no_resi" value="{{ $booking->no_resi }}" type="text" class="form-control" disabled>
			</div>
		</div>
        <div class="form-group row">
			<label for="no_telp" class="col-sm-12 col-md-2 col-form-label">Pengirim</label>
			<div class="col-sm-12 col-md-10">
            <input name="id_user" value="{{ $booking->user->name }}" type="text" class="form-control" disabled>
			</div>
		</div>
		<div class="form-group row">
            <label for="jadwal" class="col-sm-12 col-md-2 col-form-label">Jadwal</label>
			<div class="col-sm-12 col-md-10">
                <table id="lookup" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID Jadwal</th>
                            <th>Asal</th>
                            <th>Tujuan</th>
                            <th>ETA</th>
                            <th>ETD</th>
                            <th>Nama Kapal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwal as $data)
                        <tr>
                            <td>{{$data->id_jadwal}}</td>
                            <td>{{$data->asal}}</td>
                            <td>{{$data->tujuan}}</td>
                            <td>{{$data->ETA}}</td>
                            <td>{{$data->ETD}}</td>
                            <td>{{$data->nama_kapal}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
		</div>
        <div class="form-group row">
			<label for="role" class="col-sm-12 col-md-2 col-form-label">Container</label>
			<div class="col-sm-12 col-md-10">
                @foreach($container as $data)
				<input name="address" class="form-control" rows="3" value="{{ $data->no_container }}" disabled>
                @endforeach
			</div>
		</div>

      <div class="form-group row">
			<label for="gambar" class="col-sm-12 col-md-2 col-form-label">Jenis Barang</label>
			<div class="col-sm-12 col-md-10">
                <input name="jenis_barang" class="form-control" rows="3" value="{{ $barang->JenisBarang->jenis_barang }}" disabled>
			</div>
		</div>
      <div class="form-group row">
			<label for="gambar" class="col-sm-12 col-md-2 col-form-label">Nama Barang</label>
			<div class="col-sm-12 col-md-10">
            <input id="nama_barang" class="form-control" name="nama_barang" value="{{ $barang->nama_barang }}" disabled>
			</div>
		</div>
      <div class="form-group row">
			<label for="gambar" class="col-sm-12 col-md-2 col-form-label">Berat Barang</label>
			<div class="col-sm-12 col-md-10">
            <input id="nama_barang" class="form-control" name="berat_barang" value="{{ $barang->berat_barang }}" disabled>
			</div>
		</div>
      <div class="form-group row">
			<label for="gambar" class="col-sm-12 col-md-2 col-form-label">Nama Penerima</label>
			<div class="col-sm-12 col-md-10">
            <input id="nama_barang" class="form-control" name="nama_penerima" value="{{ $booking->nama_penerima }}" disabled>
			</div>
		</div>
      <div class="form-group row">
			<label for="gambar" class="col-sm-12 col-md-2 col-form-label">Telepon Penerima</label>
			<div class="col-sm-12 col-md-10">
            <input id="nama_barang" class="form-control" name="telp_penerima" value="{{ $booking->telp_penerima }}" disabled>
			</div>
		</div>
      <div class="form-group row">
			<label for="gambar" class="col-sm-12 col-md-2 col-form-label">Alamat Penerima</label>
			<div class="col-sm-12 col-md-10">
            <input id="nama_barang" class="form-control" name="alamat_penerima" value="{{ $booking->alamat_penerima }}" disabled>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-10">
				{{-- <button type="submit" class="btn btn-primary">Submit</button>
				<button type="reset" class="btn btn-danger">Reset</button> --}}
                <div class="pull-right">
                    <a href="{{route('booking.index')}}" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff">
                        <i class="icon-copy fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali
                    </a>
                </div>
			</div>
		</div>
	</form>
</div>
@endsection
