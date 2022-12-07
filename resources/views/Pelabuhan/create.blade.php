@extends('layouts.MasterView')
@section('menu_pelabuhan', 'active')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Create Port Master</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('pelabuhan.index') }}">Port</a></li>
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
	<form method="POST" action="{{ route('pelabuhan.store') }}" id="myForm" enctype="multipart/form-data">
        @csrf
		<div class="form-group row">
			<label for="kode_pelabuhan" class="col-sm-12 col-md-2 col-form-label text-white">Port Code</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="kode_pelabuhan" id="kode_pelabuhan" aria-describedby="kode_pelabuhan" placeholder="">
			</div>
		</div>
        <div class="form-group row">
			<label for="nama_pelabuhan" class="col-sm-12 col-md-2 col-form-label text-white">Port Name</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="nama_pelabuhan" id="nama_pelabuhan" aria-describedby="nama_pelabuhan" placeholder="">
			</div>
		</div>
        <div class="form-group row">
			<label for="alamat" class="col-sm-12 col-md-2 col-form-label text-white">Address</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="alamat" id="alamat" aria-describedby="alamat" placeholder="">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary">Submit</button>
				<button type="reset" class="btn btn-danger">Reset</button>
                <div class="pull-right">
                    <a href="{{route('pelabuhan.index')}}" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff">
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
