<style>
    .content {
        box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
    }

    .modal-body .row {
        display: flex;
        flex-wrap: wrap;
    }

    .modal-body .row>div {
        margin-top: 10px;
    }
</style>
@php
    use App\Constant\TahunAjaran;
    use App\Constant\StatusValidasi;
@endphp
<div class="modal fade" tabindex="-1" id="detail{{ $row->id_pendaftaran }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pra Skripsi</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <div class="modal-body pt-0">
                {{-- <div class="row">
                    <div class="col-md-4">
                        <div class="card content">
                            <div class="card-body py-0">
                                <h5 class="card-title">NIM</h5>
                                <p class="card-text">
                                    {{ $row->nim ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card content">
                            <div class="card-body py-0">
                                <h5 class="card-title">Nama</h5>
                                <p class="card-text">
                                    {{ optional($row->mahasiswa)->nama_mahasiswa ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card content">
                            <div class="card-body py-0">
                                <h5 class="card-title">Semester / Ajaran</h5>
                                <p class="card-text">
                                    {{ $row->semester }} / {{ TahunAjaran::label($row->tahun_ajaran) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card content">
                            <div class="card-body py-0 m-0">
                                <h5 class=" card-title">Pembimbing</h5>
                                <p class="card-text">{{ optional($row->dosen)->nama_dosen ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card content">
                            <div class="card-body py-0 m-0">
                                <h5 class="card-title">Tanggal Daftar</h5>
                                <p class="card-text">
                                    {{ Carbon\Carbon::parse($row->tanggal)->isoFormat('D MMMM Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card content">
                            <div class="card-body py-0 m-0">
                                <h5 class=" card-title">Status</h5>
                                <p class="card-text">
                                    {!! StatusValidasi::toHTML($row->status) !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" row mt-5">
                    <div class="col-md-12">
                        <div class="card content">
                            <div class="card-body py-0">
                                <h5 class="card-title">Judul</h5>
                                <p class="card-text" style="text-transform: uppercase">
                                    {{ $row->judul ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div> --}}
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
                                                <td>{{ $row->nim ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-muted">Nama</th>
                                                <td class="pl-2 pr-2">:</td>
                                                <td>{{ optional($row->mahasiswa)->nama_mahasiswa ?? '-' }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <th class="text-muted">Jumlah SKS</th>
                                                <td class="pl-2 pr-2">:</td>
                                                <td>{{ optional($row->mahasiswa)->sks ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-muted">Status Daftar</th>
                                                <td class="pl-2 pr-2">:</td>
                                                <td>{{ StatusValidasi::label($row->status) }}</td>
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
                                                <td>{{ optional($row->dosen)->nidn ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-muted">Pembimbing</th>
                                                <td class="pl-2 pr-2">:</td>
                                                <td>{{ optional($row->dosen)->nama_dosen ?? 'Belum Ada' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-muted">No. Hp Pemb</th>
                                                <td class="pl-2 pr-2">:</td>
                                                <td>{{ optional($row->dosen)->no_tlpn ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-muted">Status Bimbingan</th>
                                                <td class="pl-2 pr-2">:</td>
                                                @if (empty($pendaftaran->bimbingan))
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
                                    <h3>Semester</h3>
                                    <span>{{ $row->semester ?? '-' }}</span>
                                </div>
                                <div class="col">
                                    <h3>Tahun Ajaran</h3>
                                    <span>{{ TahunAjaran::label($row->tahun_ajaran) ?? '-' }}</span>
                                </div>
                                <div class="col">
                                    <h3>Tanggal Daftar</h3>
                                    <span>{{ Carbon\Carbon::parse($row->tanggal)->isoFormat('D MMMM Y') ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="separator mt-10 mb-10"></div>
                            <div class="row">
                                <h3>Judul</h3>
                                <span class="fs-4" style="text-transform: uppercase">{{ $row->judul }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
