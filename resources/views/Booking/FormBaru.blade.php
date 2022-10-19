@extends('layouts.MasterView')
@section('menu_booking', 'active')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Create Kapal</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('kapal.index') }}">Kapal</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
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
	<form method="POST" action="{{ route('booking.store') }}" id="myForm" >
        @csrf
        <div class="form-group row">
			<label for="date" class="col-sm-12 col-md-2 col-form-label text-white">Jadwal</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="date" name="date" id="date" aria-describedby="date" placeholder="">
			</div>
		</div>
        <div class="form row">
			<label for="id_container" class="col-sm-12 col-md-2 col-form-label text-white">Container</label>
            <div class="col-sm-12 col-md-10">
                <select class="form-control" name="id">
                @foreach ($containers as $container)
                    <option value="{{$container->id}}"selected>{{$container->nama_container}}</option>
                @endforeach
                </select>
            </div>
		</div>
        <div class="form-group row" hidden>
			<label for="id_kapal" class="col-sm-12 col-md-2 col-form-label text-white">ID Kapal</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="id_kapal" id="id_kapal" aria-describedby="id_kapal" placeholder="" value="{{$container->id_kapal}}">
			</div>
		</div>
        <div class="form-group row" hidden>
			<label for="id_pelabuhan" class="col-sm-12 col-md-2 col-form-label text-white">ID Pelabuhan</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="id_pelabuhan" id="id_pelabuhan" aria-describedby="id_pelabuhan" placeholder="" value="{{$container->id_pelabuhan}}">
			</div>
		</div>
        <div class="form-group row" hidden>
			<label for="id_user" class="col-sm-12 col-md-2 col-form-label text-white">ID User</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="id_user" id="id_user" aria-describedby="id_user" placeholder="" value="{{auth()->user()->id}}">
			</div>
		</div>
        <div class="form-group row" hidden>
			<label for="status" class="col-sm-12 col-md-2 col-form-label text-white">Status</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="status" id="status" aria-describedby="status" placeholder="" value="{{'on'}}" disabled>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary">Submit</button>
				<button type="reset" class="btn btn-danger">Reset</button>
                <div class="pull-right">
                    <a href="{{route('kapal.index')}}" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff">
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
