@extends('layouts.MasterView')
@section('menu_jenis_barang', 'active')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Create Types of Products</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('JenisBarang.index') }}">Types of Products</a></li>
                    <li class="breadcrumb-item" aria-current="page">Create</li>
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
	<form method="POST" action="{{ route('JenisBarang.store') }}" id="myForm" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
			<label for="jneis_barang" class="col-sm-12 col-md-2 col-form-label text-white">Jenis Barang</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="jenis_barang" id="jenis_barang" aria-describedby="jenis_barang" placeholder="">
			</div>
		</div>
        <div class="form-group row">
			<label for="suhu" class="col-sm-12 col-md-2 col-form-label text-white">Suhu</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="number" name="suhu" id="suhu" aria-describedby="suhu" placeholder="">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary">Submit</button>
				<button type="reset" class="btn btn-danger">Reset</button>
                <div class="pull-right">
                    <a href="{{route('JenisBarang.index')}}" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff">
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
