@extends('layouts.MasterView')
{{-- @stack('scripts') --}}
@section('menu_home', 'active')
@section('content')
	{{-- <div class="main-container"> --}}
		{{-- <div class="xs-pd-20-10 pd-ltr-20"> --}}
            @livewire('dashboard-detail',['idmqtt' => $idmqtt])
		{{-- </div> --}}
	{{-- </div> --}}
    @include('Dashboard.PageMaps')
@endsection
