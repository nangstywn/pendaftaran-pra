@extends('layouts.master')
@php
    use App\Constant\StatusValidasi;
@endphp
@section('content')
@section('title', 'Pra Skripsi')
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
                <div class="card-header" style="display: flex; align-items:center; justify-content:space-between;">
                    <h1 class="text-dark">Pengajuan Pra Skripsi</h1>
                </div>

                <div class="card-body pt-0">
                    <div class="row mb-3">
                        <div class="col">
                            <div class=""
                                style="display: flex; align-items:center; justify-content:space-between;">
                                @if ($acc == false)
                                    <a href="{{ route('mahasiswa.pendaftaran.create') }}"
                                        class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i>Tambah</a>
                                @else
                                    @if ($ujianDitolak > 0)
                                        <a href="{{ route('mahasiswa.pendaftaran.create') }}"
                                            class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i>Tambah</a>
                                    @else
                                        <a href="" class="btn btn-sm btn-primary error"><i
                                                class="fa fa-plus-circle"></i>Tambah</a>
                                    @endif
                                @endif
                                <form action="">
                                    <div class="d-flex align-items-center justify-content-end">
                                        <div class="col pl-0" style="min-width: 200px">
                                            <select name="status" class="form-select" data-control="select2"
                                                data-allow-clear="true" data-placeholder="Pilih Status ...">
                                                <option value=""></option>
                                                @foreach (StatusValidasi::labels() as $key => $val)
                                                    @if (Request::has('status'))
                                                        <option value="{{ $key }}"
                                                            {{ Request::get('status') == $key ? 'selected' : '' }}>
                                                            {{ $val }}</option>
                                                    @else
                                                        <option value="{{ $key }}">{{ $val }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
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
                                    <table class="table table-row-bordered gs-7" id="datatable">
                                        <thead>
                                            <tr>
                                                <th width="50px"></th>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Semester</th>
                                                <th>Pembimbing</th>
                                                <th>Tanggal</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i = 1; @endphp
                                            @forelse ($pendaftarans as $data)
                                                <tr>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a data-bs-toggle="modal"
                                                                data-bs-target="#detail{{ $data->id_pendaftaran }}"
                                                                class="btn btn-sm btn-primary" "><i
                                                                    class="fa fa-eye"></i></a>
                                                            {{-- <a class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                                data-bs-target="#detail{{ $data->id_pendaftaran }}"><i
                                                                    class="fa fa-eye"></i></a> --}}
                                                                            @if ($data->status == StatusValidasi::BELUM_VALIDASI)
                                                                <a href="{{ route('mahasiswa.pendaftaran.edit', $data->id_pendaftaran) }}"
                                                                    class="btn btn-sm btn-warning"><i
                                                                        class="fa fa-edit"></i></a>
                                                                <a href="#" class="btn btn-sm btn-danger delete"
                                                                    data-id="{{ $data->id_pendaftaran }}"><i
                                                                        class="fa fa-trash"></i></a>
                                            @endif
                                </div>
                                </td>
                                <td>{{ $data->nim }}</td>
                                <td>{{ optional($data->mahasiswa)->nama_mahasiswa ?? '-' }}</td>
                                <td>{{ $data->semester ?? '-' }}</td>
                                <td>{{ optional($data->dosen)->nama_dosen ?? '-' }}</td>
                                <td>{{ Carbon\Carbon::parse($data->tanggal)->isoFormat('D MMMM Y') ?? '-' }}
                                </td>
                                <td>{!! StatusValidasi::toHTML($data->status) !!}</td>
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
@foreach ($pendaftarans as $row)
    @include('dosen.pembimbing.modal')
@endforeach
<script>
    $('.error').click(function(e) {
        e.preventDefault();
        Swal.fire(
            'Gagal menambahkan!',
            'Sudah ada judul yang diterima!',
            'error'
        )
    })
    $('.delete').click(function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        var token = $("meta[name='csrf-token']").attr("content");
        Swal.fire({
            title: 'Yakin ?',
            text: "Ingin menghapus data ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28A745',
            cancelButtonColor: '#DC3545',
            cancelButtonText: 'Tidak, Cancel!',
            confirmButtonText: 'Ya, Hapus Aja!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: `/resource/delete-judul/${id}`,
                    data: {
                        "_token": token
                    },
                    success: function(data) {
                        console.log(data)
                        Swal.fire({
                            icon: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            location.reload()
                        })
                    }
                });
            }
        })
    });
</script>
@endsection
