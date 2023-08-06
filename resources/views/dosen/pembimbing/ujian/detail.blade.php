@extends('layouts.master')
@php
    use App\Constant\Keterangan;
    use App\Constant\BimbinganStatus;
    use App\Constant\HasilUjian;
@endphp
@section('content')
@section('title', 'Jadwal Ujian Skripsi')
<style>
    .head span {
        font-size: 15px;
    }

    table {
        font-size: 15px;
    }

    table th {
        font-weight: 500;
    }

    tr {
        line-height: 11px;
    }

    .content {
        box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
    }
</style>
<div id="" class="container-xxl">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header" style="display: flex; align-items:center">
                    <div class="col-md-12 text-center">
                        <h1 class="text-center mt-5">Jadwal Ujian Pra Skripsi Periode
                        </h1>
                    </div>
                </div>
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success"> <span class="fa fa-check-circle"></span>
                            <button type="button" class="close" data-bs-dismiss="alert">×</button>
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
                    <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bold">
                        <div class="col-md-6">
                            <div class="flex-column">
                                <table class="table table-borderless">
                                    <tr>
                                        <th class="text-muted">NIM</th>
                                        <td class="pl-2 pr-2">:</td>
                                        <td>{{ optional($ujian->bimbingan->pendaftaran)->nim ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Nama</th>
                                        <td class="pl-2 pr-2">:</td>
                                        <td>{{ optional($ujian->bimbingan->pendaftaran->mahasiswa)->nama_mahasiswa ?? '-' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="text-muted">Jumlah SKS</th>
                                        <td class="pl-2 pr-2">:</td>
                                        <td>{{ optional($ujian->bimbingan->pendaftaran->mahasiswa)->sks ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Status Bimbingan</th>
                                        <td class="pl-2 pr-2">:</td>
                                        @if (empty($ujian->bimbingan))
                                            <td>Belum Validasi</td>
                                        @else
                                            <td>{{ BimbinganStatus::label($ujian->bimbingan->status) }}</td>
                                        @endif
                                    </tr>
                                </table>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="flex-column">
                                <table class="table table-borderless">
                                    <tr>
                                        <th class="text-muted">NIDN</th>
                                        <td class="pl-2 pr-2">:</td>
                                        <td>{{ optional($ujian->bimbingan->pendaftaran->dosen)->nidn ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Pembimbing</th>
                                        <td class="pl-2 pr-2">:</td>
                                        <td>{{ optional($ujian->bimbingan->pendaftaran->dosen)->nama_dosen ?? 'Belum Ada' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">No. Hp Pemb</th>
                                        <td class="pl-2 pr-2">:</td>
                                        <td>{{ optional($ujian->bimbingan->pendaftaran->dosen)->no_tlpn ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Status Ujian</th>
                                        <td class="pl-2 pr-2">:</td>
                                        @if (empty($ujian->keterangan))
                                            <td>Belum Validasi</td>
                                        @else
                                            <td>{{ Keterangan::label($ujian->keterangan) }}</td>
                                        @endif
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="separator mt-4 mb-6"></div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card content">
                                <div class="card-body py-0">
                                    <span class="card-title">Hari/Tanggal</span>
                                    <p class="card-text fs-2 fw-bolder">
                                        {{ is_null($ujian->tanggal) ? 'Belum ada jadwal' : Carbon\Carbon::parse($ujian->tanggal)->isoformat('dddd, D MMMM Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card content">
                                <div class="card-body py-0">
                                    <span class="card-title">Pukul</span>
                                    <p class="card-text fs-2 fw-bolder">
                                        {{ is_null($ujian->jam) ? 'Belum ada jadwal' : Carbon\Carbon::parse($ujian->jam)->format('H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card content">
                                <div class="card-body py-0">
                                    <span class="card-title">Ruangan</span>
                                    <p class="card-text fs-2 fw-bolder">
                                        {{ $ujian->ruangan ?? 'Belum ada ruang' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-5">
                        <div class="col-md-4">
                            <div class="card content">
                                <div class="card-body py-0">
                                    <span class="card-title">Ketua Penguji</span>
                                    <p class="card-text fs-2 fw-bolder">
                                        {{ optional($ujian->detailUjian->ketuaPenguji)->nama_dosen ?? '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card content">
                                <div class="card-body py-0">
                                    <span class="card-title">Anggota Penguji</span>
                                    <p class="card-text fs-2 fw-bolder">
                                        {{ optional($ujian->detailUjian->anggotaPenguji)->nama_dosen ?? '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card content">
                                <div class="card-body py-0">
                                    <span class="card-title">Hasil Ujian</span>
                                    <p class="card-text fs-2 fw-bolder">
                                        @if (!empty($ujian->hasil_ujian))
                                            {!! HasilUjian::toHTML($ujian->hasil_ujian) !!}
                                        @else
                                            -
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" row mt-5">
                        <div class="col-md-12">
                            <div class="card content">
                                <div class="card-body py-0">
                                    <span class="card-title">Judul</span>
                                    <p class="card-text fs-2 fw-bolder">
                                        {{ optional($ujian->bimbingan->pendaftaran)->judul }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('dosen.akademik.ujian.acc')
<script>
    $('.no-hp').click(function(e) {
        e.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'No Hp Pembimbing Kosong',
            showConfirmButton: true,
            confirmButtonColor: '#DC3545',
        })
    });
</script>
@endsection
