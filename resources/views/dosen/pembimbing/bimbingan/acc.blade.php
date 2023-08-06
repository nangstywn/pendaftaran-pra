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
    use App\Constant\BimbinganStatus;
@endphp
<div class="modal fade" tabindex="-1" id="accept">
    <div class="modal-dialog">
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
            <form action="{{ route('dosen.pembimbing.bimbingan.acc', $pendaftaran->id_pendaftaran) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body pt-0">
                    <div class="form-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Status Bimbingan</label>
                                    <select name="status" id="" class="form-select" data-control="select2"
                                        data-placeholder="Pilih Status" required>
                                        <option value=""></option>
                                        @foreach (BimbinganStatus::labels() as $key => $value)
                                            <option value="{{ $key }}" {{ $key == BimbinganStatus::DITERIMA }}
                                                selected>
                                                {{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Bukti Acc</label>
                                    <input type="file" name="file" class="form-control"
                                        accept="application/pdf, .doc,.docx,png,jpg" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
