@extends('layouts.app')
@section('content')
<head>
    <meta charset="utf-8">
    <title>@section('title', 'ログイン')</title>
</head>
<body>
    <div class="container login-page auth-page">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="auth-page-logo text-center">
                    <img src="{{ asset('han-il-jil-mun_logo.PNG') }}" alt="website logo" class="logo" width="250">
                </div>
                <div class="card h-auto">
                    <div class="card-header">
                        {{ __('Login') }}
                    </div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
    
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                    @if (Route::has('register'))
                                        <a class="btn btn-link" href="{{ route('register') }}">{{ __('Register') }}ページ</a>
                                    @endif
                                    <a href="/login/google" class="btn btn-secondary" role="button">
                                        Google Login
                                    </a>
    
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a class="auth-page-link" href="/">トップページへ</a>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
