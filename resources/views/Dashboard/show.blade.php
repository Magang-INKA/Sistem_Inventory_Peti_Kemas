@extends('layouts.MasterView')
{{-- @stack('scripts') --}}
@section('menu_home', 'active')
@section('content')
	{{-- <div class="main-container"> --}}
		{{-- <div class="xs-pd-20-10 pd-ltr-20"> --}}
            @livewire('dashboard-detail',['name' => $name, 'mqtt_all' => $mqtt_all, 'mqtt' => $mqtt, 'container' => $container, 'mqtt_history' => $mqtt_history])
		{{-- </div> --}}
	{{-- </div> --}}
@endsection
