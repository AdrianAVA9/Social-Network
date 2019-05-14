@extends('layouts.master')

@section('content')
<div class="container register">
    <div class="row justify-content-center">
        <div class="">
            <div class="card register-container">
                <div class="card-body text-center">
                    <label class="m-auto header app-secondary-bg app-color-tertiary rounded-pill app-font-size-3">SOCIAL NETWORK</label>
                    <h5 class="heading">Crear una cuenta</h5>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror app-input-style-1" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Usuario">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror app-input-style-1" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Correo electrónico">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-12">
                                <input onfocus="(this.type='date')" name="birthdate" min="1900-01-01"
                                max="2100-12-31" class="form-control @error('birthdate') is-invalid @enderror app-input-style-1" value="{{ old('birthdate') }}" required autocomplete="birthdate" autofocus placeholder="Fecha de nacimiento">

                                @error('birthdate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <select name="gender" class="custom-select @error('gender') is-invalid @enderror custom-select-lg app-input-style-1 mb-3 app-font-size-4" value="{{ old('gender') }}" required autocomplete="gender" autofocus>
                                    <option value="" disabled selected hidden>Género</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror app-input-style-1" name="password" required autocomplete="new-password" placeholder="Contraseña">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control app-input-style-1" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmación de contraseña">
                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-5">
                            <div class="col-md-12">
                                <button type="submit" class="btn app-btn-primary app-btn-xlg rounded-pill">
                                    {{ __('Register') }}
                                </button>
                                
                                <a class="btn btn-link text-dark app-font-size-3" href="{{ route('login') }}">
                                    {{ __('¿Ya tienes una cuenta. Iniciar sesión?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
