@extends('layouts.master')
@php
    use App\Constant\StatusValidasi;
    use App\Constant\TahunAjaran;
    use App\Constant\BimbinganStatus;
    
@endphp
@section('content')
@section('title', 'Detail Pendaftaran')
<style>
    .head span {
        font-size: 15px;
    }

    table {
        font-size: 15px;
    }

    tr {
        line-height: 11px;
    }

    table th {
        font-weight: 500;
    }

    .table-outer {
        max-width: 100%;
        overflow-x: auto;
        padding: 8px 15px;
        /* background: white; */
        background: #F4F6FE;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(1, 1, 1, 0.05);
        margin-bottom: 15px;
    }

    .card {
        background-color: #F4F6FE;
    }
</style>
<div class="container-xxl">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="table-outer shadow-sm  bg-white">
                    <div class="card-header" style="display: flex; align-items:center; justify-content:space-between">
                        <div class=" text-center">
                            <h1 class="text-center mt-5">Data Permohonan Pengajuan Pra Skripsi
                        </div>
                        <div class="collapsible cursor-pointer rotate" data-bs-toggle="collapse"
                            data-bs-target="#kt_docs_card_collapsible">
                            <div class="card-toolbar rotate-180">
                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Navigation/Angle-down.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24" />
                                            <path
                                                d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z"
                                                fill="#000000" fill-rule="nonzero"
                                                transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999) " />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="kt_docs_card_collapsible" class="collapse show">
                        <div class="card-body pt-3 ">
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
                            <div class="col-md-12">
                                <div class="d-flex flex-column ml-0 flex-sm-row gap-7 gap-md-10 fw-bold head">
                                    <div class="col-md-6">
                                        <div class="flex-column">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <th class="text-muted">NIM</th>
                                                    <td class="pl-2 pr-2">:</td>
                                                    <td>{{ $pendaftaran->nim ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-muted">Nama</th>
                                                    <td class="pl-2 pr-2">:</td>
                                                    <td>{{ optional($pendaftaran->mahasiswa)->nama_mahasiswa ?? '-' }}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th class="text-muted">Jumlah SKS</th>
                                                    <td class="pl-2 pr-2">:</td>
                                                    <td>{{ optional($pendaftaran->mahasiswa)->sks ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-muted">Status Pendaftaran</th>
                                                    <td class="pl-2 pr-2">:</td>
                                                    <td>{{ StatusValidasi::label($pendaftaran->status) }}</td>
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
                                                    <td>{{ optional($pendaftaran->dosen)->nidn ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-muted">Pembimbing</th>
                                                    <td class="pl-2 pr-2">:</td>
                                                    <td>{{ optional($pendaftaran->dosen)->nama_dosen ?? 'Belum Ada' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="text-muted">No. Hp Pemb</th>
                                                    <td class="pl-2 pr-2">:</td>
                                                    <td>{{ optional($pendaftaran->dosen)->no_tlpn ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-muted">Status Bimbingan</th>
                                                    <td class="pl-2 pr-2">:</td>
                                                    @if (empty($bimbingan))
                                                        <td>Belum Validasi</td>
                                                    @else
                                                        <td>{{ BimbinganStatus::label($bimbingan->status) }}</td>
                                                    @endif
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="separator mt-2 mb-10"></div>
                                <div class="row">
                                    <div class="col">
                                        <h2>Semester</h2>
                                        <span class="fs-4">{{ $pendaftaran->semester ?? '-' }}</span>
                                    </div>
                                    <div class="col">
                                        <h2>Tahun Ajaran</h2>
                                        <span
                                            class="fs-4">{{ TahunAjaran::label($pendaftaran->tahun_ajaran) ?? '-' }}</span>
                                    </div>
                                    <div class="col">
                                        <h2>Tanggal Daftar</h2>
                                        <span
                                            class="fs-4">{{ Carbon\Carbon::parse($pendaftaran->tanggal)->isoFormat('D MMMM Y') ?? '-' }}</span>
                                    </div>
                                    @if (Auth::guard('dosen')->check())
                                        @if (Auth::guard('dosen')->user()->role == 'akademik')
                                            <div class="col mr-4">
                                                <h2>Contact Pembimbing</h2>
                                                @if (!empty($pendaftaran->dosen->no_tlpn))
                                                    <a href="https://wa.me/{{ $pendaftaran->dosen->no_tlpn }}?text=Halo%20{{ $pendaftaran->dosen->nama_dosen }}%0AJadwal%20ujian%20skripsi%20mahasiswa%20atasnama%20{{ $pendaftaran->mahasiswa->nama_mahasiswa }}%20kapan%20ya%20?"
                                                        class="btn btn-success" target="_blank"><i
                                                            class=" fab
                                                fa-whatsapp fs-1"
                                                            style="border-radius:75px"></i></a>
                                                @endif
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                <div class="separator mt-10 mb-10"></div>
                                <div class="row">
                                    <h2>Judul</h2>
                                    <span class="fs-4"
                                        style="text-transform: uppercase">{{ $pendaftaran->judul }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($pendaftaran->status == StatusValidasi::VALIDASI)
                <div class="card">
                    <div class="table-outer shadow-sm  bg-white">
                        <div class="card-header">
                            <div class="title"
                                style=" display: flex; align-items:center; justify-content:space-between">
                                <h1>Riwayat Bimbingan</h1>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    {{-- <div class="table-outer shadow-sm p-3 mb-5 bg-white "> --}}
                                    <div class="col-md-12 table-responsive">
                                        <table class="table table-row-bordered gs-7" id="datatable">
                                            <thead>
                                                <tr>
                                                    <th>Nama File</th>
                                                    <th>File</th>
                                                    <th>Catatan</th>
                                                    <th>Tanggal</th>
                                                    <th>Pengirim</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($detailBimbingans as $data)
                                                    <tr>
                                                        <td>{{ $data->file }}</td>
                                                        <td>
                                                            @if (empty($data->file))
                                                                -
                                                            @else
                                                                <a
                                                                    href="{{ asset('assets/file/bimbingan/' . $data->file) }}">View</a>
                                                            @endif
                                                        </td>
                                                        <td>{{ $data->catatan ?? '-' }}</td>
                                                        <td>{{ Carbon\Carbon::parse($data->tanggal)->isoFormat('D MMMM Y H:mm') ?? '-' }}
                                                        </td>
                                                        <td>{{ $data->auth ?? '-' }}
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
                                                {!! $detailBimbingans->links() !!}
                                            </div>
                                        </div>
                                    </div>
                                    {{-- </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
