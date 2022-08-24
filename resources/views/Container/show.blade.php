@extends('layouts.MasterView')
@section('menu_container', 'active')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Show Detail Container Barang</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('container.index') }}">Container</a></li>
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
<div class="pd-20 card-box mb-30">
	<form>
		<div class="form-group row">
			<label for="kode_container" class="col-sm-12 col-md-2 col-form-label text-white">Kode Container</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="kode_container" id="kode_container"
                value="{{ $container->kode_container }}" aria-describedby="kode_container" placeholder="Disabled input" disabled="">
			</div>
		</div>
		<div class="form-group row">
			<label for="nama_container" class="col-sm-12 col-md-2 col-form-label text-white">Nama Container</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="nama_container" id="nama_container"
                value="{{ $container->nama_container }}" aria-describedby="nama_container" placeholder="Disabled input" disabled="">
			</div>
		</div>
		<div class="form-group row">
			<label for="keterangan" class="col-sm-12 col-md-2 col-form-label text-white">Keterangan</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="keterangan" id="keterangan"
                value="{{ $container->keterangan }}" aria-describedby="keterangan" placeholder="Disabled input" disabled="">
			</div>
		</div>
        <div class="pull-right">
            <a href="{{route('container.index')}}" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff">
                <i class="icon-copy fa fa-arrow-left" aria-hidden="true"></i>
                Kembali
            </a>
        </div>
        <br><br>
    </form>

</div>
@endsection
