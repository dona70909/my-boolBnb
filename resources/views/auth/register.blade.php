@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8 my-auth-forms">
            
            <div class="card">

                {{-- # TITOLO FORM --}}
                <div class="card-header rounded-3 text-center"> Boolbnb </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif

                        {{-- # name --}}
                        <div class="form-group row m-2">
                            <label for="name" class="col-md-4 col-form-label text-md-right color">{{ __('Nome:') }} <span class='required'>*</span> </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- # surname --}}
                        <div class="form-group row m-2">
                            <label for="surname" class="col-md-4 col-form-label text-md-right color">Cognome: <span class="required">*</span></label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control" name="surname"  value="{{ old('surname') }}" required>
                            </div>
                        </div>

                        {{-- # date --}}
                        <div class="form-group row m-2">
                            <label for="date_of_birth" class="col-md-4 col-form-label text-md-right color">Data di nascita:</label>

                            <div class="col-md-6">
                                <input id="date_of_birth" type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth') }}">
                            </div>
                        </div>

                        {{-- # email --}}
                        <div class="form-group row m-2">
                            <label for="email" class="col-md-4 col-form-label text-md-right color">{{ __('E-Mail Address:') }} <span class="required">*</span> </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- # password --}}
                        <div class="form-group row m-2">
                            <label for="password" class="col-md-4 col-form-label text-md-right color">{{ __('Password:') }} <span class="required">*</span> </label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- # conf pass --}}
                        <div class="form-group row m-2">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right color">{{ __('Conferma Password:') }} <span class="required">*</span> </label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        {{-- # warn message --}}
                        <div class="row text-center m-3">
                            <p>I campi contrassegnati da un * sono obbligatori</p>
                        </div>

                        {{-- # btn register --}}
                        <div class="form-group d-flex justify-content-center align-items-center">
                            <div class="my-submit-btn col-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrati') }}
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


@section('style')
<link rel="stylesheet"  href="{{ asset('css/authforms.css') }}" >
@endsection