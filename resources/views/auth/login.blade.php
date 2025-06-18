<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- PAGE TITLE HERE -->
    <title>Login Page</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{asset('')}}assets/images/favicon.png">
    <link href="{{asset('')}}assets/css/style.css" rel="stylesheet">

</head>

<body class="vh-100">
    <div class=" authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <a href="index.html"><img src="{{asset('')}}assets/images/logo/LOGO-AKP2I.png"
                                                alt=""></a>
                                    </div>
                                    {{-- <h4 class="text-center mb-4">Sign up your account</h4> --}}
                                    <form class=" dez-form pb-3" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <h3 class="form-title m-t0 text-center">Selamat Datang</h3>
                                        <div class="dez-separator-outer m-b5">
                                            <div class="dez-separator bg-primary style-liner"></div>
                                        </div>
                                        <p>Masukkan alamat e-mail dan kata sandi Anda.</p>
                                        <div class="form-group mb-3">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus
                                                placeholder="Email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password"
                                                placeholder="Password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="text-center bottom">
                                            <button class="btn btn-primary button-md btn-block" id="nav-sign-tab"
                                                type="submit">Login</button>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
	Scripts
***********************************-->
    <!-- Required vendors -->
    <script src="{{asset('')}}assets/vendor/global/global.min.js"></script>
    <script src="{{asset('')}}assets/js/custom.js"></script>
    <script src="{{asset('')}}assets/js/deznav-init.js"></script>
</body>

</html>