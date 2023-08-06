@extends('layouts.master')
@php
    use App\Constant\JenisKelamin;
    use App\Constant\Jurusan;
@endphp
@section('content')
@section('title', 'Daftar Mahasiswa')
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
                    <h1 class="text-dark">Daftar Mahasiswa</h1>

                </div>
                <div class="card-body pt-0">
                    <div class="row mb-3">
                        <div class="col">
                            <form action="">
                                <div class="" style="display: flex; align-items:center; justify-content:end;">
                                    <div class="col pl-0" style="max-width: 200px">
                                        <select name="jurusan" class="form-select" data-control="select2"
                                            data-allow-clear="true" data-placeholder="Pilih Jurusan ...">
                                            <option value=""></option>
                                            @foreach (Jurusan::labels() as $key => $val)
                                                @if (Request::has('jurusan'))
                                                    <option value="{{ $key }}"
                                                        {{ Request::get('jurusan') == $key ? 'selected' : '' }}>
                                                        {{ $val }}</option>
                                                @else
                                                    <option value="{{ $key }}">{{ $val }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col pl-0" style="max-width: 200px">
                                        <select name="jk" class="form-select" data-control="select2"
                                            data-allow-clear="true" data-placeholder="Jenis Kelamin...">
                                            <option value=""></option>
                                            @foreach (JenisKelamin::labels() as $key => $val)
                                                @if (Request::has('jk'))
                                                    <option value="{{ $key }}"
                                                        {{ Request::get('jk') == $key ? 'selected' : '' }}>
                                                        {{ $val }}</option>
                                                @else
                                                    <option value="{{ $key }}">{{ $val }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col pl-0" style="max-width: 200px">
                                        <input type="text" name="q" class="form-control"
                                            placeholder="Cari NIM/Nama" value="{{ Request::get('q') }}">
                                    </div>
                                    <div class="col pl-0" style="max-width: 50px">
                                        <button class="btn btn-sm btn-primary " type="submit">
                                            <i class="fa fa-filter"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
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
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Jurusan</th>
                                                <th>SKS</th>
                                                <th>IPK</th>
                                                <th>Angkatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($mahasiswas as $data)
                                                <tr>
                                                    {{-- <td>
                                                        <div class="btn-group">
                                                            <a class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                                data-bs-target="#detail{{ $data->id_pendaftaran }}"><i
                                                                    class="fa fa-eye"></i></a>
                                                        </div>
                                                    </td> --}}
                                                    <td>{{ $data->nim }}</td>
                                                    <td>{{ $data->nama_mahasiswa ?? '-' }}</td>
                                                    <td>{{ JenisKelamin::label($data->jenis_kelamin) ?? '-' }}</td>
                                                    <td>{{ Jurusan::label($data->jurusan) ?? '-' }}</td>
                                                    <td>{{ $data->sks ?? '-' }}</td>
                                                    <td>{{ $data->ipk ?? '-' }}</td>
                                                    <td>{{ $data->tahun_angkatan ?? '-' }}</td>
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
                                            {!! $mahasiswas->links() !!}
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
