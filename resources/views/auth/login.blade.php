<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Login</title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" sizes="32x32">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            overflow: hidden;
        }
    </style>
</head>

<body class="bg-primary mt-5">
    <div class="row">
        <div class="col-md-12 d-flex flex-column align-items-center justify-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="section text-center">
                            <img src="{{ asset('assets/images/login.png') }}" width="200" alt="image"
                                class="form-image">
                        </div>
                        <div class="section mt-1">
                            <h3>Selamat Datang</h3>
                            <h4>Silahkan log in</h4>
                        </div>
                    </div>

                    <div class="section mt-1 m-2">
                        @php
                            $message = Session::get('warning');
                        @endphp
                        @if (Session::get('warning'))
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <input id="nim" type="text"
                                        class="form-control @error('nim') is-invalid @enderror" name="nim"
                                        value="{{ old('nim') }}" required autocomplete="nim"
                                        placeholder="NIM / NIDN">

                                    @error('nim')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="form-group p-0">
                                    <div class="input-wrapper">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password" placeholder="Password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary">Log in</button><br>
                                    <span>Belum punya akun ? <a href="{{ route('register') }}">Daftar</a></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
