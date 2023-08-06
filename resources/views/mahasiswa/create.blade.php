@extends('layouts.master')
@php
    use App\Constant\TahunAjaran;
@endphp
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/js/datetimepicker/jquery.datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/js/select2/select2.min.css') }}"> --}}
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
                        <h1 class="text-center mt-5">Selamat Datang di Aplikasi Pengajuan Pra Skripsi
                        </h1>
                    </div>
                </div>
                <form action="{{ route('mahasiswa.pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-body">
                            <div class="row no-gutters">
                                <div class="d-flex flex-column mb-5 fv-row">
                                    <div class="row">
                                        <div class="col-md-4 fv-row">
                                            <div class="form-group">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2"
                                                    for="nim">NIM</label>
                                                <input type="text" name="nim" id="nim"
                                                    class="form-control form-control-solid " placeholder="Masukkan NIM"
                                                    value="{{ Auth::user()->nim }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <div class="form-group">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2"
                                                    for="semester">Semester</label>
                                                <input type="number" name="semester" id="semester" min="1"
                                                    class="form-control" value="{{ old('semester') }}"
                                                    placeholder="Semester...">
                                                @error('semester')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <div class="form-group">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2"
                                                    for="tahun_ajaran">Tahun Ajaran</label>
                                                <select name="tahun_ajaran" id="tahun_ajaran" class="form-select"
                                                    data-control="select2" data-placeholder="Tahun Ajaran...">
                                                    <option></option>
                                                    @foreach (TahunAjaran::labels() as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                                @error('tahun_ajaran')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column mb-5 fv-row">
                                    <div class="row">
                                        <div class="col-md-4 fv-row">
                                            <div class="form-group">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2"
                                                    for="tanggal">Tanggal</label>
                                                <input type="text" name="tanggal" id="tanggal"
                                                    class="form-control form-control-solid"
                                                    value="{{ Carbon\Carbon::now()->format('d M Y') }}"
                                                    placeholder="Tanggal daftar" readonly>
                                                @error('tanggal')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <div class="form-group">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2"
                                                    for="nama">Nama Dosen Pembimbing</label>
                                                <select name="dosen" id="dosen" class="form-select"
                                                    data-control="select2" data-placeholder="Pilih Dosen Pembimbing...">
                                                    <option></option>
                                                    @if (!empty(old('dosen')))
                                                        <option value="{{ old('dosen') }}" selected>
                                                            {{ old('old_dosen') }}</option>
                                                    @endif
                                                </select>
                                                <input type="hidden" name="old_dosen" class="old_dosen"
                                                    value="{{ old('old_dosen') }}">
                                                @error('dosen')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <div class="form-group">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2"
                                                    for="status">Status</label>
                                                <input type="text" name="status" value="Belum Validasi"
                                                    class="form-control form-control-solid" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column mb-5 fv-row">
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="fs-5 fw-bold mb-2" for=" judul">Judul Skripsi</label>
                                            <textarea name="judul" id="" class="form-control" placeholder="Masukkan Judul Skripsi...">{{ old('judul') }}</textarea>
                                            @error('judul')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary next">Submit <i
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

<script>
    $(document).ready(function() {
        // const thisDay = moment().format('dd M yyyy');
        // let req = $('#tanggal').val();
        // if (req == '') {
        //     req = thisDay
        // }
        // $('.datepicker').datepicker({
        //     // format: 'd M Y H:i',
        //     format: 'dd MM yyyy',
        //     autoclose: true,
        // }).datepicker('setDate', req).attr('readonly', 'readonly');

        $('#dosen').select2({
            ajax: {
                type: "GET",
                url: "{{ route('resource.pembimbing') }}",
                data: function(param) {
                    return {
                        search: param.term
                    }
                },
                processResults: function(data) {
                    return {
                        results: $.map(data.data, function(item) {
                            return item
                        })
                    };
                }
            }
        });
        $('#dosen').on('select2:select', function(e) {
            let data = e.params.data.text;
            $('.old_dosen').val(data);
        });
    });
</script>
@endpush
