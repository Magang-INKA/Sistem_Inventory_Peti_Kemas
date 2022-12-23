@extends('layouts.MasterView')
@section('menu_jenis_barang', 'active')
@section('content')
<div >
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Types of Products Data</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('JenisBarang.index') }}">Types of Products</a></li>
                        <li class="breadcrumb-item" aria-current="page">Index</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- multiple select row Datatable start -->
    <div class="page-header mb-30">
        <div class="pb-20">
            <div class="header-left">
                <div class="">
                    <div class="col-md-40 col-sm-12 text-right">
                        <a class="btn btn-success" href="{{ route('JenisBarang.create') }}"> Create Data </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-20">
            <table class="data-table table hover multiple-select-row nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">No</th>
                        <th>Jenis Barang</th>
                        <th>Suhu</th>
                        @can('manage-MasterData')
                        <th class="datatable-nosort">Action</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($JenisBarang as $br => $data)
                    <tr>
                        <td class="table-plus">{{ $loop->iteration }}</td>
                        <td>{{ $data->jenis_barang}}</td>
                        <td>{{ $data->suhu }}</td>
                        @can('manage-MasterData')
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <form action="{{ route('JenisBarang.destroy', $data->id) }}" method="POST">
                                        <a class="dropdown-item" href="{{ route('JenisBarang.edit', $data->id) }}"><i class="dw dw-edit2"></i> Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button class="dropdown-item" onclick="return confirm('Anda yakin ingin meghapus data ini ?')" type="submit">
                                            <i class="dw dw-delete-3"></i> Delete
                                    </form>
                                </div>
                            </div>
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <div class="col-md-40 col-sm-12 text-left">
                {{$JenisBarang->links()}}
            </div> --}}
        </div>
    </div>
</div>
<!-- multiple select row Datatable End -->
@endsection
