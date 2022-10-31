@extends('layouts.MasterView')
@section('menu_container', 'active')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Edit Container Data Master</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('masterContainer.index') }}">Container Master</a></li>
                    <li class="breadcrumb-item" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <i class="icon-copy fa fa-pencil-square-o fa-3x" aria-hidden="true"></i>
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
	<form method="POST" action="{{ route('masterContainer.update', $masterContainer->no_container) }}" id="myForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group row">
			<label for="no_container" class="col-sm-12 col-md-2 col-form-label text-white">No Container</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="no_container" id="no_container" aria-describedby="no_container" placeholder="" value="{{ $masterContainer->no_container }}">
			</div>
		</div>
        <div class="form-group row">
			<label for="jenis" class="col-sm-12 col-md-2 col-form-label text-white">Type</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="jenis" id="jenis" aria-describedby="jenis" placeholder="" value="{{ $masterContainer->jenis }}">
			</div>
		</div>
        <div class="form-group row">
			<label for="ukuran" class="col-sm-12 col-md-2 col-form-label text-white">Size (feet)</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="number" name="ukuran" id="ukuran" aria-describedby="ukuran" placeholder="" value="{{ $masterContainer->ukuran }}">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary">Submit</button>
				<button type="reset" class="btn btn-danger">Reset</button>
                <div class="pull-right">
                    <a href="{{route('container.index')}}" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff">
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
