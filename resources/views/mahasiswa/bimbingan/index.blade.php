@extends('layouts.master')
@php
    use App\Constant\JenisKelamin;
    use App\Constant\Jurusan;
    use App\Constant\BimbinganStatus;
@endphp
@section('content')
@section('title', 'Daftar Bimbingan')
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
                    <h1 class="text-dark">Daftar Bimbingan</h1>
                </div>

                <div class="card-body pt-0">
                    <div class="row mb-3">
                        <div class="col">
                            <div class=""
                                style="display: flex; align-items:center; justify-content:space-between;">
                                @if ($acc)
                                    <a href="{{ route('mahasiswa.bimbingan.detail', $acc->id_pendaftaran) }}"
                                        class="btn btn-sm btn-primary"><i class="fas fa-user-plus"></i>Tambah</a>
                                @else
                                    <a class="btn btn-sm btn-primary error"><i class="fas fa-user-plus"></i>Tambah</a>
                                @endif
                                <form action="">
                                    <div class="row table-filter align-items-center justify-content-between">
                                        <div class="col pl-0" style="min-width: 250px">
                                            <select name="status" id="" data-control="select2"
                                                data-allow-clear="true" class="form-select"
                                                data-placeholder="Pilih Status">
                                                <option value=""></option>
                                                @foreach (BimbinganStatus::labels() as $key => $value)
                                                    <option value="{{ $key }}"
                                                        {{ $key == Request::get('status') ? 'selected' : '' }}>
                                                        {{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col pl-0">
                                            <input type="text" name="q" class="form-control"
                                                placeholder="Cari NIM/Nama" value="{{ Request::get('q') }}">
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
                                                <th width="50px"></th>
                                                <th>NIM</th>
                                                <th>Nama Mahasiswa</th>
                                                <th>Pembimbing</th>
                                                <th>Jumlah Bimbingan</th>
                                                <th>Status Bimbingan</th>
                                                <th>Bukti Acc Bimbingan</th>
                                                <th>Approver</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($bimbingans as $data)
                                                <tr>
                                                    <td>
                                                        <div class="btn-group m-0 p-0">
                                                            <a href="{{ route('mahasiswa.bimbingan.detail', $data->id_pendaftaran) }}"
                                                                class="btn btn-sm btn-primary"><i
                                                                    class="fa fa-eye"></i></a>
                                                        </div>
                                                    </td>
                                                    <td>{{ optional($data->pendaftaran)->nim }}</td>
                                                    <td>{{ optional($data->pendaftaran->mahasiswa)->nama_mahasiswa ?? '-' }}
                                                    </td>
                                                    <td>{{ optional($data->pendaftaran->dosen)->nama_dosen ?? '-' }}
                                                    </td>
                                                    <td>{{ $data->detail_bimbingan_count }}</td>
                                                    <td>{!! BimbinganStatus::toHTML($data->status) !!}</td>
                                                    <td>
                                                        @if (!empty($data->bukti_acc))
                                                            <a
                                                                href="{{ asset('assets/file/bimbingan/acc/' . $data->bukti_acc) }}">View</a>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (!empty($data->approver))
                                                            {{ optional($data->dosen)->nama_dosen ?? '-' }}
                                                        @else
                                                            -
                                                        @endif
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
                                        <div class="col-md-12">
                                            {!! $bimbingans->links() !!}
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
<script>
    $('.error').click(function(e) {
        Swal.fire(
            'Gagal menambahkan bimbingan!',
            'Belum ada judul yang diterima!',
            'error'
        )
    });
</script>
@endsection
