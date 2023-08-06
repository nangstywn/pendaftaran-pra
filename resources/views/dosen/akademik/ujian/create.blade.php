@extends('layouts.master')
@php
    use App\Constant\TahunAjaran;
@endphp
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/js/datetimepicker/jquery.datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/timepicker/TimePicki-master/css/timepicki.css') }}">

    <style>
        .datepicker {
            z-index: 999999 !important;

        }

        .datepicker-days {
            width: 250px;
            font-size: 18px;
            z-index: 999999 !important;

        }

        table {
            width: 100%;
        }

        .form-control,
        .form-select {
            border: 1px solid #bdbdbd !important;
            border-radius: 10px !important;
        }
    </style>
@endpush
@section('content')
@section('title', 'Pengajuan Pra Skripsi')
<div id="kt_content_container" class="container-xxl">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header" style="display: flex; align-items:center">
                    <div class="col-md-12 text-center">
                        <h1 class="mt-5">Tambah Jadwal Ujian
                        </h1>
                    </div>
                </div>
                <form action="{{ route('dosen.akademik.ujian.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-body">
                            <div class="row no-gutters">
                                <div class="d-flex flex-column mb-5 fv-row">
                                    <div class="row">
                                        <div class="col-md-3 fv-row">
                                            <div class="form-group">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2"
                                                    for="nim">NIM</label>
                                                <select name="nim" id="nim" class="form-select"
                                                    data-control="select2" data-placeholder="Pilih NIM">
                                                    <option value="{{ old('nim') }}">{{ old('old_nim') }}</option>
                                                </select>
                                                <input type="hidden" name="old_nim" class="old_nim"
                                                    value="{{ old('old_nim') }}">
                                                @error('nim')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 fv-row">
                                            <div class="form-group">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2"
                                                    for="nama">Nama Mahasiswa</label>
                                                <input type="text" name="nama" id="nama" class="form-control"
                                                    value="{{ old('nama') }}" placeholder="Nama Mahasiswa" readonly>
                                                @error('nama')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 fv-row">
                                            <div class="form-group">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2"
                                                    for="pembimbing">Dosen Pembimbing</label>
                                                <input type="text" name="pembimbing" id="pembimbing"
                                                    value="{{ old('pembimbing') }}" class="form-control"
                                                    placeholder="Pembimbing" readonly>
                                                </input>
                                                @error('pembimbing')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 fv-row">
                                            <div class="form-group">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2"
                                                    for="ruangan">Ruangan</label>
                                                <input type="text" name="ruangan" class="form-control"
                                                    value="{{ old('ruangan') }}" placeholder="Masukkan Ruangan...">
                                                </input>
                                                @error('ruangan')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column mb-5 fv-row">
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="fs-5 fw-bold mb-2" for=" judul">Judul Skripsi</label>
                                            <textarea name="judul" id="judul" class="form-control" placeholder="Judul Skripsi" readonly>{{ old('judul') }}</textarea>
                                            @error('judul')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column mb-5 fv-row">
                                    <div class="row">
                                        <div class="col-md-3 fv-row">
                                            <div class="form-group">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2"
                                                    for="tanggal">Tanggal Ujian</label>
                                                <input type="text" name="tanggal" id="tanggal"
                                                    class="form-control datepicker" value="{{ old('tanggal') }}"
                                                    placeholder="Tanggal Ujian">
                                                @error('tanggal')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 fv-row">
                                            <div class="form-group">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2"
                                                    for="jam">Jam Ujian</label>
                                                <input type="text" name="jam" id="jam"
                                                    class="form-control timepicker" value="{{ old('jam') }}"
                                                    placeholder="Jam Ujian">
                                                @error('jam')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 fv-row">
                                            <div class="form-group">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2"
                                                    for="nama">Ketua Penguji</label>
                                                <select name="ketua_penguji" id="ketua" class="form-select"
                                                    data-control="select2" data-placeholder="Pilih Ketua Penguji...">
                                                    <option></option>
                                                    <option value="{{ old('ketua_penguji') }}" selected>
                                                        {{ old('old_ketua_penguji') }}</option>
                                                </select>
                                                <input type="hidden" name="old_ketua_penguji"
                                                    class="old_ketua_penguji" value="{{ old('old_ketua_penguji') }}">
                                                @error('ketua_penguji')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 fv-row">
                                            <div class="form-group">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2"
                                                    for="nama">Anggota Penguji</label>
                                                <select name="anggota_penguji" class="form-select"
                                                    data-control="select2" id="anggota"
                                                    data-placeholder="Pilih Anggota Penguji...">
                                                    <option></option>
                                                    <option value="{{ old('anggota_penguji') }}" selected>
                                                        {{ old('old_anggota_penguji') }}</option>
                                                </select>
                                                <input type="hidden" name="old_anggota_penguji"
                                                    class="old_anggota_penguji"
                                                    value="{{ old('old_anggota_penguji') }}">
                                                @error('anggota_penguji')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id_pendaftaran" id="id_pendaftaran"
                                    value="{{ old('id_pendaftaran') }}">
                                <input type="hidden" name="id_dosen" id="id_dosen" value="{{ old('id_dosen') }}">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit <i
                                            class="fa fa-arrow-alt-circle-up"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('assets/js/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/timepicker/TimePicki-master/js/timepicki.js') }}"></script>


<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            language: 'id',
            // format: 'd M Y H:i',
            format: 'dd MM yyyy',
            autoclose: true,
        });
        $('.timepicker').timepicki({
            start_time: ["08", "00"],
            show_meridian: false,
            min_hour_value: 0,
            max_hour_value: 23,
            overflow_minutes: true,
            increase_direction: 'up',
            disable_keyboard_mobile: false
        });

        costumSelect2Paginate('...', $('#nim'),
            `{{ route('resource.nim') }}`);
        $('#nim').on('select2:select', function(e) {
            let data = $(this).select2('data')
            let nim = data[0].text
            let id_dosen = data[0].id_dosen
            $('.old_nim').val(nim)
            $('#id_dosen').val(id_dosen)
            $.ajax({
                type: "GET",
                url: "{{ route('resource.pendaftaran') }}",
                data: {
                    nim: nim
                },
                success: function(response) {
                    $('#nama').val(response.mahasiswa.nama_mahasiswa)
                    $('#pembimbing').val(response.dosen.nama_dosen)
                    $('#judul').val(response.judul)
                    $('#id_pendaftaran').val(response.id_pendaftaran)
                }
            });
        });

        $('#nim').on('select2:select', function() {
            let data = $('#nim').select2('data')
            let pembimbing = data[0].id_dosen
            costumSelect2Paginate('...', $('#ketua', ),
                `{{ route('resource.penguji') }}`, `{"id_dosen": ${pembimbing}}`);
            costumSelect2Paginate('...', $('#anggota', ),
                `{{ route('resource.penguji') }}`, `{"id_dosen": ${pembimbing}}`);
        })
        $('#ketua').on('select2:select', function(e) {
            $('.old_ketua_penguji').val(e.params.data.text)
        })
        $('#anggota').on('select2:select', function(e) {
            $('.old_anggota_penguji').val(e.params.data.text)
        })
        let id_dosen = `{{ old('id_dosen') }}`
        if (id_dosen) {
            costumSelect2Paginate('...', $('#ketua', ),
                `{{ route('resource.penguji') }}`, `{"id_dosen": ${id_dosen}}`);
        }
    });
</script>
@endpush
