@extends('layouts.master')
@php
    use App\Constant\JenisKelamin;
    use App\Constant\Jurusan;
@endphp
@section('content')
@section('title', 'Daftar Dosen')
<style>
    .table td {
        vertical-align: middle;
    }
</style>
<div id="kt_content_container" class="container-xxl">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header" style="min-height: 10px">
                    <h1 class="text-dark">Daftar Dosen</h1>
                </div>

                <div class="card-body pt-0">
                    <div class="row mb-3">
                        <div class="col">
                            <div class="" style="display: flex; align-items:center; justify-content:end;">
                                {{-- <a href="{{ route('dosen.prodi.create') }}" class="btn btn-sm btn-primary"><i
                                        class="fas fa-user-plus"></i>Tambah</a> --}}
                                <form action="">
                                    <div class="row table-filter align-items-center justify-content-between">
                                        <div class="col pl-0">
                                            <input type="text" name="q" class="form-control"
                                                placeholder="Cari NIDN/Nama" value="{{ Request::get('q') }}">
                                        </div>
                                        <div class="col mr-4" style="max-width: 50px">
                                            <button class="btn btn-sm btn-primary " type="submit">
                                                <i class="fa fa-filter"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="table-outer shadow-sm p-3 mb-5 bg-white ">
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-row-bordered gs-7" id="datatable">
                                        <thead>
                                            <tr>
                                                {{-- <th width="50px"></th> --}}
                                                <th>NIDN</th>
                                                <th>Nama</th>
                                                <th>No. HP</th>
                                                <th>Role</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($dosens as $data)
                                                <tr>
                                                    {{-- <td>
                                                        <div class="btn-group m-0 p-0">
                                                            <a class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                                data-bs-target="#detail{{ $data->id_pendaftaran }}"><i
                                                                    class="fa fa-eye"></i></a>
                                                        </div>
                                                    </td> --}}
                                                    <td>{{ $data->nidn }}</td>
                                                    <td>{{ $data->nama_dosen ?? '-' }}</td>
                                                    <td>{{ $data->no_tlpn ?? '-' }}</td>
                                                    <td>{{ $data->role ?? '-' }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">Belum Ada Data</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-12">
                                            {!! $dosens->links() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('') }}assets/js/ujs.min.js"></script>
@endsection
