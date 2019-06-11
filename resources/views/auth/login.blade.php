@extends('layouts.master')

@section('content')
<div class="container login">
    <div class="row justify-content-center">
        <div class="">
            <div class="card login-container">
                <div class="card-body text-center">
                    <label class="m-auto header app-secondary-bg app-color-tertiary rounded-pill app-font-size-3">SOCIAL NETWORK</label>
                    <h5 class="heading">Iniciar sesión</h5>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row mb-4">
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror app-input-style-1" name="email" value="adrian.vega@live.com" required autocomplete="email" autofocus placeholder="Correo electrónico">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror app-input-style-1" value="123" name="password" required autocomplete="current-password" placeholder="Contraseña">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row remember-me">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordar contraseña.') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn app-btn-primary app-btn-xlg rounded-pill mt-5">
                                    {{ __('Iniciar sesión') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link text-dark app-font-size-3" href="#">
                                        {{ __('Olvido su contraseña?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
