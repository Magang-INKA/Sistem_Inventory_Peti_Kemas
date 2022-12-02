@extends('layouts.MasterView')
@section('menu_transaksi', 'active')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Edit Transaksi</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('transaksi.index') }}">Transaksi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <i class="icon-copy fa fa-pencil-square-o fa-3x" aria-hidden="true"></i>
        </div>
    </div>
</div>
<!-- Default Basic Forms Start -->
<div class="pd-20 card-white mb-30">
	@if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
	<form method="POST" action="{{ route('transaksi.update', $transaksi->id) }}" id="myForm">
        @csrf
        @method('PUT')
		<div class="form-group row">
			<label for="kode" class="col-sm-12 col-md-2 col-form-label ">ID Transaksi</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="kode" id="kode"
                value="{{ $transaksi->id }}" aria-describedby="kode" placeholder readonly="">
			</div>
		</div>
		<div class="form-group row">
			<label for="nama" class="col-sm-12 col-md-2 col-form-label ">ID Booking</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="id_booking" id="nama"
                value="{{ $transaksi->id_booking }}" readonly>
			</div>
		</div>
		<div class="form-group row">
			<label for="alamat" class="col-sm-12 col-md-2 col-form-label ">Harga</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="harga" id="alamat"
                value="{{ $transaksi->harga }}" aria-describedby="alamat" placeholder="">
			</div>
		</div>
        <div class="form-group row">
			<label for="telp" class="col-sm-12 col-md-2 col-form-label ">QR</label>
			<div class="col-sm-12 col-md-10">
                {{-- {!! QrCode::format('png')->generate($transaksi->id_booking); !!} --}}
                <img src="data:image/png;base64,{{ base64_encode(SimpleSoftwareIO\QrCode\Facades\QrCode::size(150)->format('png')->generate($transaksi->id_booking) ) }}">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-danger" href="{{url('/resi/'.$transaksi->id)}}">Print</a>
                <div class="pull-right">
                    <a href="{{route('transaksi.index')}}" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff">
                        <i class="icon-copy fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali
                    </a>
                </div>
			</div>
		</div>
	</form>
</div>
<!-- Default Basic Forms End -->
@endsection
