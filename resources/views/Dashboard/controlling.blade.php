@extends('layouts.MasterView')
{{-- @stack('scripts') --}}
@section('menu_controlling', 'active')
@section('content')
	{{-- <div class="main-container"> --}}
		{{-- <div class="xs-pd-20-10 pd-ltr-20"> --}}
			<div class="page-header">
				<div class="row">
					<div class="col-md-8 col-sm-12">
						<div class="title">
							<h4>Controlling Suhu </h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href={{ url('/') }}>Home</a></li>
								<li class="breadcrumb-item" aria-current="page">Controlling Suhu</li>
							</ol>
						</nav>
					</div>
					{{-- <div class="col-md-4 col-sm-12 pull-right">
                        <select class="custom-select2 form-control" aria-placeholder="Pilih Container" name="state" onchange="location = this.value;" style="width: 100%;">
                            <option>Pilih Container</option>
                            @foreach ($mqtt as $data)
                            <option value="{{ route('dashboard.show', $data->id) }}">{{ $data->topic }}</option>
                            @endforeach
                        </select>
					</div> --}}
				</div>
			</div>

            <div class="card-white pd-20 height-100-p mb-30">
				<div class="row align-items-center" style="justify-content: center">
                    <iframe src="http://168.138.6.144:1880/ui/#!/10?socketid=DFfjrh6XNf5W2OvlAAAD" title="Controlling System" height="400px" width="50%"></iframe>
				</div>
			</div>
		{{-- </div> --}}
	{{-- </div> --}}
@endsection
