@extends('layouts.master')
@php
    use App\Constant\StatusValidasi;
@endphp
@section('content')
@section('title', 'Pra Skripsi')
<style>
    /* .img span {
    position: absolute;
    left: 100px;
    visibility: hidden;
}

.img:hover,
.img:hover span {
    visibility: visible;
    top: 0;
    left: 100px;
    z-index: 1;
} */
    .table td {
        vertical-align: middle;
    }
</style>
<div id="kt_content_container" class="container-xxl">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header" style="display: flex; align-items:center; justify-content:space-between;">
                    <h1 class="text-dark">Pengajuan Pra Skripsi</h1>
                </div>

                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col">
                            <div class="" style="display: flex; align-items:center; justify-content:end;">
                                <form action="">
                                    <div class="d-flex align-items-center justify-content-end">
                                        <input type="text" name="q" class="form-control"
                                            placeholder="Cari NIM/Nama" value="{{ Request::get('q') }}">
                                        <button class="btn btn-sm btn-primary ml-2" type="submit">
                                            <i class="fa fa-filter"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success"><span class="fa fa-check-circle"></span>
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col">
                            <div class="table-outer shadow-sm p-3 mb-5 bg-white ">
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-dashed gs-7" id="datatable">
                                        <thead>
                                            <tr class="fw-bolder fs-6 text-gray-800">
                                                <th width="50px"></th>
                                                <th>NIM</th>
                                                <th>Nama Mahasiswa</th>
                                                <th>Jumlah Pengajuan</th>
                                                <th>Pembimbing</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i = 1; @endphp
                                            @forelse ($pendaftarans as $data)
                                                <tr>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="{{ route('dosen.pembimbing.pra.detail', $data->nim) }}"
                                                                class="btn btn-sm btn-primary"><i
                                                                    class="fa fa-eye"></i></a>
                                                        </div>
                                                    </td>
                                                    <td>{{ $data->nim }}</td>
                                                    <td>{{ optional($data->mahasiswa)->nama_mahasiswa ?? '-' }}</td>
                                                    <td>{{ $data->total ?? 0 }} Judul</td>
                                                    <td>{{ optional($data->dosen)->nama_dosen ?? '-' }}</td>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">Belum Ada Data</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-start">
                                            {!! $pendaftarans->links() !!}
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
@endsection
