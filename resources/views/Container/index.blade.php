@extends('layouts.MasterView')
@section('menu_container', 'active')
@section('content')
<div >
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Container Data</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('container.index') }}">Container</a></li>
                        <li class="breadcrumb-item" aria-current="page">Index</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <a href="#" type="button" class="btn btn-primary" data-toggle="dropdown" data-color="#ffffff">
                    <i class="icon-copy fa fa-download" aria-hidden="true"></i>
                    Report Download
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{url('/laporan/container')}}">PDF</a>
                    <a class="dropdown-item" href="{{url('/laporan/container/excel')}}">Excel</a>
                </div>
            </div>
        </div>
    </div>

    <!-- multiple select row Datatable start -->
    <div class="page-header mb-30">
        <div class="pb-20">
            <div class="header-left">
                <div class="">
                    <div class="col-md-40 col-sm-12 text-right">
                        <a class="btn btn-success" href="{{ route('container.create') }}"> Create Data </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-20">
            <table class="data-table table hover multiple-select-row nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">No</th>
                        <th>No Container</th>
                        <th>Vessel Name</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($container as $ct => $data)
                    <tr>
                        <td class="table-plus">{{ $ct + $container->firstitem() }}</td>
                        <td>{{ $data->no_container }}</td>
                        <td>{{ $data->kapal->nama_kapal }}</td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <form action="{{ route('container.destroy', $data->id) }}" method="POST">
                                        <a class="dropdown-item" href="{{ route('container.edit', $data->id) }}"><i class="dw dw-edit2"></i> Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button class="dropdown-item" onclick="return confirm('Anda yakin ingin meghapus data ini ?')" type="submit">
                                            <i class="dw dw-delete-3"></i> Delete
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col-md-40 col-sm-12 text-left">
                {{$container->links()}}
            </div>
        </div>
    </div>
</div>
<!-- multiple select row Datatable End -->
@endsection
