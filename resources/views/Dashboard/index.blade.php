@extends('layouts.MasterView')
{{-- @stack('scripts') --}}
@section('menu_home', 'active')
@section('content')
	{{-- <div class="main-container"> --}}
		{{-- <div class="xs-pd-20-10 pd-ltr-20"> --}}
			<div class="page-header">
				<div class="row">
					<div class="col-md-8 col-sm-12">
						<div class="title">
							<h4>Dashboard </h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href={{ url('/') }}>Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
							</ol>
						</nav>
					</div>
					<div class="col-md-4 col-sm-12 pull-right">
                        {{-- @foreach($mqtt as $data) --}}
                        <select class="custom-select2 form-control" aria-placeholder="Pilih Container" name="state" onchange="location = this.value;" style="width: 100%;">
                            <option>Pilih Container</option>
                            @foreach ($mqtt as $data)
                            <option value="{{ route('dashboard.show', $data->id) }}">{{ $data->topic }}</option>
                            @endforeach
                        </select>
                        {{-- <a class="btn btn-secondary" href="{{ route('dashboard.show', $data->id) }}">Pilih</a> --}}
                        {{-- @endforeach --}}
					</div>
				</div>
			</div>

            <div class="card-white pd-20 height-100-p mb-30">
				<div class="row align-items-center">
					{{-- <div class="col-md-4">
						<img src="vendors/images/banner-img.png" alt="">
					</div> --}}
					<div class="col-md-12">
						<h4 class="font-20 weight-500 mb-10 text-capitalize">
							Welcome <div class="weight-600 font-30 text-blue">{{Auth::user()->name}}</div>
						</h4>
						<p class="font-18">Silahkan pilih container terlebih dahulu untuk melakukan monitoring & controlling!</p>
					</div>
				</div>
			</div>
		{{-- </div> --}}
	{{-- </div> --}}
@endsection
