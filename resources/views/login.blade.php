<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Horus | Faculty of Engineering</title>
	<link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}"> 
	<link rel="stylesheet" href="{{ asset('assets/css/demo_1/style.css') }}">
    <link rel="icon" href="{{ asset('assets/images/cropped-Logo-e1723368648315-32x32.png') }}" sizes="32x32" />
    <link rel="icon" href="{{ asset('assets/images/cropped-Logo-e1723368648315-192x192.png') }}" sizes="192x192" />
    <link rel="apple-touch-icon" href="{{ asset('assets/images/cropped-Logo-e1723368648315-180x180.png') }}" />
    <style>
        .page-wrapper.full-page {
            background-image: url('{{ asset('assets/images/landscape-faculty.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .background-overlay {
            position: fixed;
            opacity: 0.5;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #00294c;
            z-index: 1;
        }
        .auth-page .auth-left-wrapper {
            background-position: center;
            height: 100%;
            background-image: url('{{ asset('assets/images/bg-m.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;    
            filter: opacity(0.9);
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <div class="background-overlay"></div>
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">
                
                <div class="row w-100 mx-0 auth-page" style="z-index: 2;">
                    
                    <div class="col-md-8 col-xl-6 mx-auto">
                        <div class="card" style="border:none">
                            <div class="row">
                                <div class="col-md-4 pr-md-0">
                                    <div class="auth-left-wrapper"></div>
                                </div>
                                <div class="col-md-8 pl-md-0">
                                    <div class="auth-form-wrapper px-4 py-5">
                                        <a href="#" class="noble-ui-logo d-block mb-5">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <img src="{{ asset('assets/images/faculty-logo.png') }}" alt="logo" width="75px">
                                                <div class="text-center">
                                                    &nbsp;<span>Faculty of</span>&nbsp;Engineering&nbsp;
                                                </div>
                                                <img src="{{ asset('assets/images/mecha-logo.png') }}" alt="logo" width="75px">
                                            </div>
                                        </a>
                                        <form class="forms-sample" method="POST" action="{{ route('authentication.login') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="email">Email address</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                    id="email" name="email" value="{{ old('email') }}" required autofocus
                                                    placeholder="Email">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                                    id="password" name="password" required
                                                    autocomplete="current-password" placeholder="Password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" name="remember" 
                                                        id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    Remember me
                                                </label>
                                            </div>
                                            <div class="mt-3">
                                                <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0 text-white">Login</button>
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
        <div style="position: fixed; bottom: 0; width: 100%; background: rgba(0, 41, 76, 0.4); color: white; padding: 0; z-index: 1000;">
            <x-marquee text="<span style='font-size: 12px;'>Supervised by : </span><b>Assoc. Prof. Dr. Mohammed Kamal&nbsp;-&nbsp;Prof. Dr. Hatem Khater</b> - <span style='font-size: 12px;'>Developed by : </span><span style='color: #e7a706; font-weight: bold;'>Ahmed Emad, Hamed Ashraf, Mohamed Gomaa, Eslam Saad, Ahmed Fathy, Haneen Ahmed, Zeyad Shehta</span>&nbsp;&nbsp;|&nbsp;&nbsp;Level 4 Mechatronics Engineering Students - Faculty of Engineering © 2025" speed="30s" />
        </div>
    </div>
	<script src="{{ asset('assets/vendors/core/core.js') }}"></script>
	<script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
	<script src="{{ asset('assets/js/template.js') }}"></script>
</body>

</html>



