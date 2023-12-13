@extends('layouts.master')
@php
    use App\Constant\StatusValidasi;
@endphp
@section('content')
@section('title', 'Pra Skripsi')
<style>
    /* .img span {
    position: absolute;
    left: 100px;
    visibility: hidden;
}

.img:hover,
.img:hover span {
    visibility: visible;
    top: 0;
    left: 100px;
    z-index: 1;
} */
    .table td {
        vertical-align: middle;
    }

    #kt_content_container .modal-body .card-body {
        min-height: auto;
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
                                    <table class="table table-dashed gs-7" id="datatable">
                                        <thead>
                                            <tr class="fw-bolder fs-6 text-gray-800">
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
                                            @forelse ($details as $data)
                                                <tr>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#detail{{ $data->id_pendaftaran }}"
                                                                class="btn btn-sm btn-primary"><i
                                                                    class="fa fa-eye"></i></a>
                                                            @if ($acc == false)
                                                                @if ($data->status == StatusValidasi::BELUM_VALIDASI)
                                                                    <a href="" data-bs-toggle="modal"
                                                                        data-bs-target="#accJudul{{ $data->id_pendaftaran }}"
                                                                        class="btn btn-sm btn-success confirm"><i
                                                                            class="fa fa-check-circle"></i></a>
                                                                @endif
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
                                        <div class="col-md-12 d-flex justify-content-between">

                                            {!! $details->links() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('dosen.pembimbing.pra.index') }}" class="btn btn-sm btn-danger ml-10"><i
                                    class="fa fa-arrow-alt-circle-left"></i>Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($details as $row)
    @include('dosen.pembimbing.modal')
    @include('dosen.pembimbing.acc')
@endforeach
{{-- <script>
    $('.confirm').click(function(e) {
        e.preventDefault();
        let ids = $(this).attr('data-id')
        Swal.fire({
            title: 'Yakin ?',
            text: "Acc Judul ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28A745',
            cancelButtonColor: '#DC3545',
            confirmButtonText: 'Ya, Acc!',
            cancelButtonText: 'Tidak, Cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('resource.acc-judul') }}",
                    data: {
                        id: ids
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
        });
    });
</script> --}}
@endsection
