@extends('layouts.app')

@section('content')
<div class="container my-cont">
    <div class="row justify-content-center">
        <div class="col-md-8 my-auth-forms">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- # email --}}
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right m-2 color">{{ __('E-Mail Address:') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- # password --}}
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right m-2 color">{{ __('Password:') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- # remember me --}}
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label fw-bolder m-0 p-0" for="remember">
                                        Seleziona {{ __('Remember Me') }} per ottenere un accesso più veloce .
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- # login --}}
                        <div class="form-group row justify-content-center">
                            <div class="col-2 my-submit-btn mb-2">
                                <button type="submit" class="btn btn-primary my-btn-submit">
                                    {{ __('Login') }}
                                </button>
                            </div>

                            @if (Route::has('password.request'))
                                <div class="col-12 d-flex justify-content-center">
                                    <a class="btn btn-link " href="{{ route('password.request') }}">
                                        {{ __('Password dimenticata?') }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<link rel="stylesheet"  href="{{ asset('css/authforms.css') }}" >
@endsection
