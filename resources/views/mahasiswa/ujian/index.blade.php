@extends('layouts.master')
@php
    use App\Constant\BimbinganStatus;
    use App\Constant\HasilUjian;
    use App\Constant\Keterangan;
@endphp
@section('content')
@section('title', 'Daftar Jadwal Ujian')
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
                    <h1 class="text-dark">Daftar Jadwal Ujian</h1>
                </div>

                <div class="card-body pt-3">
                    <div class="row">
                        <div class="col">
                            <div class="table-outer shadow-sm p-3 mb-5 bg-white ">
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-row-bordered gs-7" id="datatable">
                                        <thead>
                                            <tr>
                                                <th width="50px"></th>
                                                <th>NIM</th>
                                                <th>Nama Mahasiswa</th>
                                                <th>Pembimbing</th>
                                                <th>Waktu Ujian</th>
                                                <th>Hasil</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($ujians as $data)
                                                <tr>
                                                    <td>
                                                        <div class="btn-group m-0 p-0">
                                                            <a href="{{ route('mahasiswa.ujian.detail', $data->id_jadwal_ujian) }}"
                                                                class="btn btn-sm btn-primary"><i
                                                                    class="fa fa-eye"></i></a>
                                                        </div>
                                                    </td>
                                                    <td>{{ optional($data->bimbingan->pendaftaran)->nim }}</td>
                                                    <td>{{ optional($data->bimbingan->pendaftaran->mahasiswa)->nama_mahasiswa ?? '-' }}
                                                    </td>
                                                    <td>{{ optional($data->bimbingan->pendaftaran->dosen)->nama_dosen ?? '-' }}
                                                    </td>
                                                    <td>{{ is_null($data->tanggal) ? '-' : Carbon\Carbon::parse($data->tanggal)->isoFormat('D MMMM Y') }}
                                                        {{ Carbon\Carbon::parse($data->jam)->isoFormat('HH:mm') }}
                                                    </td>
                                                    <td>
                                                        @if (!empty($data->hasil_ujian))
                                                            {!! HasilUjian::toHTML($data->hasil_ujian) !!}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>{!! Keterangan::toHTML($data->keterangan) !!}</td>
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
                                            {!! $ujians->links() !!}
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
