@extends('layouts.MasterView')
{{-- @stack('scripts') --}}
@section('menu_home', 'active')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="title">
                    <h4>Dashboard</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ url('/') }}>Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">{{$mqtt->topic}}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-4 col-sm-12 pull-right">
                {{-- @foreach($mqtt as $data) --}}
                <select class="custom-select2 form-control" aria-placeholder="Pilih Container" name="state" onchange="location = this.value;" style="width: 100%;">
                    <option>Pilih Container</option>
                    @foreach ($mqtt_all as $data)
                    <option value="{{ route('dashboard.show', $data->id) }}">{{ $data->topic }}</option>
                    @endforeach
                </select>
                {{-- <a class="btn btn-secondary" href="{{ route('dashboard.show', $data->id) }}">Pilih</a> --}}
                {{-- @endforeach --}}
            </div>
        </div>
    </div>
    @include('Dashboard.PageMaps')
	{{-- <div class="main-container"> --}}
		{{-- <div class="xs-pd-20-10 pd-ltr-20"> --}}
            @livewire('dashboard-detail',['idmqtt' => $idmqtt])
		{{-- </div> --}}
	{{-- </div> --}}
@endsection
