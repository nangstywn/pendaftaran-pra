@extends('layouts.app')
@php
    use App\Constant\Jurusan;
    use App\Constant\JenisKelamin;
@endphp
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="nim" class="col-md-4 col-form-label text-md-end">{{ __('NIM') }}</label>

                                <div class="col-md-6">
                                    <input id="nim" type="text"
                                        class="form-control @error('nim') is-invalid @enderror" name="nim"
                                        value="{{ old('nim') }}" required autocomplete="name" autofocus>

                                    @error('nim')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nama"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="nama" type="text"
                                        class="form-control @error('nama') is-invalid @enderror" name="nama"
                                        value="{{ old('nama') }}" required autocomplete="nama" autofocus>

                                    @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jk"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Jenis Kelamin') }}</label>

                                <div class="col-md-6 mt-2">
                                    <input id="jk" type="radio" name="jk"
                                        value="{{ JenisKelamin::LAKI_LAKI }}" required autocomplete="name"
                                        autofocus>Laki-Laki
                                    <input id="jk" type="radio" name="jk"
                                        value="{{ JenisKelamin::PEREMPUAN }}" required autocomplete="name"
                                        autofocus>Perempuan

                                    @error('jk')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jurusan"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Jurusan') }}</label>

                                <div class="col-md-6">
                                    <select name="jurusan" id="" data-placeholder="Pilih Jurusan"
                                        class="form-control select2">
                                        <option value=""></option>
                                        @foreach (Jurusan::labels() as $key => $val)
                                            <option value="{{ $key }}">{{ $val }}</option>
                                        @endforeach
                                    </select>

                                    @error('jurusan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="sks"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Sks') }}</label>

                                <div class="col-md-6">
                                    <input id="sks" type="number"
                                        class="form-control @error('sks') is-invalid @enderror" name="sks"
                                        value="{{ old('sks') }}" required autocomplete="sks">

                                    @error('sks')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="ipk"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Ipk') }}</label>

                                <div class="col-md-6">
                                    <input id="ipk" type="text"
                                        class="form-control @error('ipk') is-invalid @enderror" name="ipk"
                                        value="{{ old('ipk') }}" required autocomplete="ipk">

                                    @error('ipk')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tahun_angkatan"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Tahun Angkatan') }}</label>

                                <div class="col-md-6">
                                    <input id="tahun_angkatan" type="text"
                                        class="form-control yearpicker @error('tahun_angkatan') is-invalid @enderror"
                                        name="tahun_angkatan" value="{{ old('tahun_angkatan') }}" required
                                        autocomplete="tahun_angkatan">

                                    @error('tahun_angkatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            $(".yearpicker").yearpicker()
        });
    </script>
@endpush
