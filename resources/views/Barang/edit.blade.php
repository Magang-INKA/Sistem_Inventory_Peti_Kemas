@extends('layouts.MasterView')
@section('menu_barang', 'active')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Edit Barang</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('barang.index') }}">Barang</a></li>
                    <li class="breadcrumb-item" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <i class="icon-copy dw dw-add-file-1 fa-3x" aria-hidden="true"></i>
        </div>
    </div>
</div>
<!-- Default Basic Forms Start -->
<div class="pd-20 card-box mb-30">
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
	<form method="POST" action="{{ route('barang.update', $barang->id) }}" id="myForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
		<div class="form-group row">
			<label for="kode_barang" class="col-sm-12 col-md-2 col-form-label text-white">Jenis Barang</label>
			<div class="col-sm-12 col-md-10">
                <select class="form-control" id="jenis_barang" name="jenis_barang">
                    {{-- <option value="">{{ $barang->JenisBarang->jenis_barang}}</option> --}}
                    @foreach ($jb as $jenisbarang)
                    <option value="{{ $jenisbarang->id }}" {{ $jenisbarang->id == $barang->jenis_barang ? 'selected' : '' }}>{{ $jenisbarang->jenis_barang }}</option>
                       {{-- <option value="{{ $jenisbarang->id }}">{{ $jenisbarang->jenis_barang }}</option> --}}
                    @endforeach
                 </select>
				{{-- <input class="form-control" type="text" name="kode_barang" id="kode_barang" value="{{ $barang->JenisBarang->jenis_barang }}" aria-describedby="kode_barang" placeholder=""> --}}
			</div>
		</div>
        <div class="form-group row">
			<label for="nama_barang" class="col-sm-12 col-md-2 col-form-label text-white">Nama Barang</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="nama_barang" id="nama_barang" value="{{ $barang->nama_barang }}" aria-describedby="nama_barang" placeholder="">
			</div>
		</div>
        <div class="form-group row">
			<label for="berat_barang" class="col-sm-12 col-md-2 col-form-label text-white">Berat Barang (Kg)</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="number" name="berat_barang" id="berat_barang" value="{{ $barang->berat_barang }}" aria-describedby="berat_barang" placeholder="">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary">Submit</button>
				<button type="reset" class="btn btn-danger">Reset</button>
                <div class="pull-right">
                    <a href="{{route('barang.index')}}" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff">
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
