<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Register</title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" sizes="32x32">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <link rel="stylesheet" href="{{ asset('assets/js/select2/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            overflow: hidden;
        }
    </style>
</head>

<body class="bg-primary mt-5">
    @php
        use App\Constant\Jurusan;
        use App\Constant\JenisKelamin;
    @endphp
    <div class="row">
        <div class="col-md-12 d-flex flex-column align-items-center justify-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="section text-center">
                            <img src="{{ asset('assets/images/login.png') }}" width="200" alt="image"
                                class="form-image">
                        </div>
                        <div class="section mt-1">
                            <h3>Selamat Datang</h3>
                            <h4>Silahkan Mendaftar</h4>
                        </div>
                    </div>

                    <div class="section mt-1 m-2">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="card-body">

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="nim"
                                            class="col-md-4 col-form-label text-md-end">{{ __('NIM') }}</label>
                                        <div class="col">

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

                                    <div class="col-md-6">
                                        <label for="nama"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>

                                        <div class="col">
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
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="jk"
                                            class="col col-form-label text-md-end">{{ __('Jenis Kelamin') }}</label>
                                        <div class="col">
                                            <select name="jk" id="" data-placeholder="Jenis Kelamin"
                                                class="form-control select2">
                                                <option value=""></option>
                                                @foreach (JenisKelamin::labels() as $key => $val)
                                                    <option value="{{ $key }}">{{ $val }}</option>
                                                @endforeach
                                            </select>

                                            @error('jk')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="jurusan"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Jurusan') }}</label>

                                        <div class="col">
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
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="sks"
                                            class="col col-form-label text-md-end">{{ __('Sks') }}</label>
                                        <div class="col">
                                            <input id="sks" type="number"
                                                class="form-control @error('sks') is-invalid @enderror" name="sks"
                                                min="1" value="{{ old('sks') }}" required
                                                autocomplete="sks">

                                            @error('sks')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="ipk"
                                            class="col col-form-label text-md-end">{{ __('Ipk') }}</label>

                                        <div class="col">
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
                                    <div class="col">
                                        <label for="tahun_angkatan"
                                            class="col col-form-label text-md-end">{{ __('Tahun Angkatan') }}</label>

                                        <div class="col">
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
                                </div>

                                <div class="row mb-3">

                                    <div class="col">
                                        <label for="password"
                                            class="col col-form-label text-md-end">{{ __('Password') }}</label>

                                        <div class="col">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="password-confirm"
                                            class="col col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                        <div class="col">
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-flex flex-column ml-1">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                    <div class="col">
                                        <span>Sudah punya akun ? <a href="{{ route('login') }}">Login</a></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    <script>
        $('.select2').select2();
    </script>
</body>

</html>
