@extends('layouts.MasterView')
@section('menu_user', 'active')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Edit Drop Point</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('droppoint.index') }}">Drop Point</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <i class="icon-copy dw dw-add-file-1 fa-3x" aria-hidden="true"></i>
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
	<form method="POST" action="{{ route('droppoint.update', $dp->id) }}" id="myForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group row">
			<label for="no_telp" class="col-sm-12 col-md-2 col-form-label">ID Transaksi</label>
			<div class="col-sm-12 col-md-10">
            <input name="id_user" value="{{ $dp->id_transaksi }}" type="text" class="form-control" >
			</div>
		</div>
      <div class="form-group row">
			<label for="gambar" class="col-sm-12 col-md-2 col-form-label">Pelabuhan</label>
			<div class="col-sm-12 col-md-10">
            <input id="id_container" type="hidden" class="form-control" name="id_barang" value="{{ $dp->id_barang }}" required readonly="">
            <select name="pelabuhan" class="form-control custom-select">
                @foreach ($pelabuhan as $jenisbarang)
                    <option value="{{ $jenisbarang->kode_pelabuhan }}" {{ $jenisbarang->kode_pelabuhan == $dp->nama_pelabuhan ? 'selected' : '' }}>{{ $jenisbarang->nama_pelabuhan }}</option>
                @endforeach
              </select>
			</div>
		</div>
      <div class="form-group row">
			<label for="gambar" class="col-sm-12 col-md-2 col-form-label">Keterangan</label>
			<div class="col-sm-12 col-md-10">
            <input id="nama_barang" class="form-control" name="keterangan" value="{{ $dp->keterangan }}" required >
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-10">
				<button type="submit" name="action" class="btn btn-primary" value="save">Submit</button>
                <div class="pull-right">
                    <a href="{{route('droppoint.index')}}" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff">
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
