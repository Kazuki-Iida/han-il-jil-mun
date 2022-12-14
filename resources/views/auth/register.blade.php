@extends('layouts.app')
@section('content')
<head>
    <meta charset="utf-8">
    <title>@section('title', 'ユーザー登録')</title>
</head>
<body>
    <div class="container register-page auth-page">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="auth-page-logo text-center">
                    <img src="{{ asset('han-il-jil-mun_logo.PNG') }}" alt="website logo" class="logo" width="250">
                </div>
                
                <div class="card h-auto">
                    <div class="card-header">
                        {{-- __('Register') --}}
                        ユーザー仮登録
                    </div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
    
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
    
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
    
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
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{-- __('Register') --}}仮登録
                                    </button>
                                    @if (Route::has('login'))
                                        <a class="btn btn-link" href="{{ route('login') }}">{{ __('Login') }}ページ</a>
                                    @endif
                                </div>
                                <p class="text-center col-12 mx-auto">※送信後、本登録用のメールをご確認ください。</p>
                            </div>
                            <div class="">
                                <a href="/login/google" class="google-login-btn my-3 mx-auto" role="button">
                                        
                                </a>
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
