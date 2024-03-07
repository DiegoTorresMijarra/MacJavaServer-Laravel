@extends('main')

@section('title','LogIn')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 d-flex justify-content-center">
            <div class="card shadow" style="width: 70%; padding: 10px; border: none; border-top: 2px solid coral;">
                <div class="card-header" style="background-color: #413f3d; color: white; border-bottom: 2px solid coral; text-align: center; font-family: Rowdies; font-size: 40px">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3 d-flex flex-column">
                            <label for="email" class="col-md-6 col-form-label text-md-end" style="background-color: coral; color: white; margin-bottom: 10px; font-weight: bold; border-radius: 60px 140px 60px 140px">{{ __('Email Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 d-flex flex-column">
                            <label for="password" class="col-md-6 col-form-label text-md-end" style="background-color: coral; color: white; margin-bottom: 10px; font-weight: bold; border-radius: 60px 140px 60px 140px">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-12 ">
                                <div class="form-check d-flex align-items-center justify-content-between">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn" style="background-color: coral; color: white">
                                    {{ __('Login') }}
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
