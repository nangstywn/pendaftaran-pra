@extends('layouts.master')
@php
    use App\Constant\StatusValidasi;
    use App\Constant\TahunAjaran;
    use App\Constant\BimbinganStatus;
    
@endphp
@section('content')
@section('title', 'Laporan Bimbingan')
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
                        <div class="text-center">
                            <h1 class="text-center">Laporan Bimbingan Pra Skripsi
                        </div>
                        <div>
                            <a href="{{ route('mahasiswa.bimbingan.download') }}" class="btn btn-primary"><i
                                    class="fas fa-download"></i> Download PDF</a>
                        </div>
                    </div>
                    <div id="kt_docs_card_collapsible" class="collapse show">
                        <div class="card-body pt-3 ">
                            <div class="col-md-12">
                                <div class="d-flex flex-column ml-0 flex-sm-row gap-7 gap-md-10 fw-bold head">
                                    <div class="col-md-6">
                                        <div class="flex-column">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <th class="text-muted">NIM</th>
                                                    <td class="pl-2 pr-2">:</td>
                                                    <td>{{ auth()->user()->nim ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-muted">Nama</th>
                                                    <td class="pl-2 pr-2">:</td>
                                                    <td>{{ auth()->user()->nama_mahasiswa ?? '-' }}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th class="text-muted">Pembimbing</th>
                                                    <td class="pl-2 pr-2">:</td>
                                                    @if (!empty($report))
                                                        <td>{{ optional($report->pendaftaran->dosen)->nama_dosen ?? '-' }}
                                                        </td>
                                                    @else
                                                        <td> - </td>
                                                    @endif
                                                </tr>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                                <div class="separator mt-2 mb-10"></div>
                                <div class="row">
                                    <div class="col-md-12 table-responsive">
                                        <table class="table table-row-bordered gs-7" id="datatable">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Hari/Tanggal</th>
                                                    <th>Catatan Dosen</th>
                                                    {{-- <th>Ket</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = 1;
                                                    $datas = [];
                                                    if ($report) {
                                                        $datas = $report->detailBimbingan->where('auth', '!=', auth()->user()->nama_mahasiswa);
                                                    }
                                                @endphp
                                                @forelse ($datas ?? [] as $data)
                                                    @if ($data->auth != auth()->user()->nama_mahasiswa)
                                                        <tr>
                                                            <td>{{ $i++ }}</td>
                                                            <td>{{ Carbon\Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y') ?? '-' }}
                                                            <td>{{ $data->catatan ?? '-' }}</td>
                                                            </td>
                                                            {{-- <td>{{ $data->auth ?? '-' }}
                                                            </td> --}}
                                                        </tr>
                                                    @endif
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center">Belum Ada Data</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        {{-- <div class="row">
                                            <div class="col-md-12">
                                                {!! $detailBimbingans->links() !!}
                                            </div>
                                        </div> --}}
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
