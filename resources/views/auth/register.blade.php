@extends('main')
@section('title','Register')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 d-flex justify-content-center">
            <div class="card shadow" style="width: 100%; padding: 10px; border: none; border-top: 2px solid coral;">
                <div class="card-header" style="background-color: #413f3d; color: white; border-bottom: 2px solid coral; text-align: center; font-family: Rowdies; font-size: 40px">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-4 d-flex">
                            <div class="col-6">
                                <label for="name" class="col-md-8 col-form-label text-md-end" style="background-color: coral; color: white; margin-bottom: 10px; font-weight: bold; border-radius: 60px 140px 60px 140px">{{ __('Name') }}</label>

                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="email" class="col-md-8 col-form-label text-md-end" style="background-color: coral; color: white; margin-bottom: 10px; font-weight: bold; border-radius: 60px 140px 60px 140px">{{ __('Email Address') }}</label>

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-6">
                                <label for="password" class="col-md-8 col-form-label text-md-end" style="background-color: coral; color: white; margin-bottom: 10px; font-weight: bold; border-radius: 60px 140px 60px 140px">{{ __('Password') }}</label>

                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="password-confirm" class="col-md-8 col-form-label text-md-end" style="background-color: coral; color: white; margin-bottom: 10px; font-weight: bold; border-radius: 60px 140px 60px 140px">{{ __('Confirm Password') }}</label>

                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12 d-flex justify-content-start align-items-center">
                                <button type="submit" class="btn" style="margin-left: 20px; background-color: coral; color: white">
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
