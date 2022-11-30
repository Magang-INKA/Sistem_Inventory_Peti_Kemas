@extends('layouts.MasterView')
@section('menu_container', 'active')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Create Container Master</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('masterContainer.index') }}">Container Master</a></li>
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
	<form method="POST" action="{{ route('masterContainer.store') }}" id="myForm">
        @csrf
		<div class="form-group row">
			<label for="no_container" class="col-sm-12 col-md-2 col-form-label text-white">No Container</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="no_container" id="no_container" aria-describedby="no_container" placeholder="">
			</div>
		</div>
        <div class="form-group row">
			<label for="jenis_container" class="col-sm-12 col-md-2 col-form-label text-white">Type</label>
            {{-- <label for="role" class="col-sm-12 col-md-2 col-form-label text-white">Role</label> --}}
            <div class="col-sm-12 col-md-10">
                <select class="custom-select col-12" type="jenis_container" name="jenis_container" id="jenis_container">
                    <option value="">Choose Container</option>
                    <option value="20 feet">20 feet</option>
                    <option value="40 feet">40 feet</option>
                </select>
            </div>
			{{-- <div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="jenis_container" id="jenis_container" aria-describedby="jenis_container" placeholder="">
			</div> --}}
		</div>
        <div class="form-group row">
			<label for="kapasitas" class="col-sm-12 col-md-2 col-form-label text-white">Kapasitas</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="number" name="kapasitas" id="kapasitas" aria-describedby="kapasitas" placeholder="">
			</div>
		</div>
        <div class="form-group row">
			<label for="suhu_ketetapan" class="col-sm-12 col-md-2 col-form-label text-white">Suhu Ketetapan</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="number" name="suhu_ketetapan" id="suhu_ketetapan" aria-describedby="kapasitas" placeholder="">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary">Submit</button>
				<button type="reset" class="btn btn-danger">Reset</button>
                <div class="pull-right">
                    <a href="{{route('masterContainer.index')}}" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff">
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
