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
				<input class="form-control" type="text" name="nama" id="nama"
                value="{{ $transaksi->id_booking }}" aria-describedby="nama" placeholder="">
			</div>
		</div>
		<div class="form-group row">
			<label for="alamat" class="col-sm-12 col-md-2 col-form-label ">Harga</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="alamat" id="alamat"
                value="{{ $transaksi->harga }}" aria-describedby="alamat" placeholder="">
			</div>
		</div>
        <div class="form-group row">
			<label for="telp" class="col-sm-12 col-md-2 col-form-label ">QR</label>
			<div class="col-sm-12 col-md-10">
                {!! QrCode::size(250)->generate($transaksi->id_booking); !!}
			</div>
		</div>
        {{-- <div class="form-group row">
			<label for="telp" class="col-sm-12 col-md-2 col-form-label ">QR</label>
			<div class="col-sm-12 col-md-10">
                <input class="form-control" type="hidden" name="alamat" id="alamat"
                value="{{$var}}" aria-describedby="alamat" placeholder="">
                {!! QrCode::size(250)->generate('www.google.com'); !!}
			</div>
		</div> --}}

		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary">Submit</button>
				<button type="reset" class="btn btn-danger">Reset</button>
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
