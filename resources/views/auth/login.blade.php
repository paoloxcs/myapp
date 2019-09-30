@extends('layouts.front')
@section('title','Iniciar Sesión')
@section('content')
<div class="bg-fullwidth">
    <div class="auth-content">
        <div class="layout-form">
            <h4 class="mb-4">Iniciar Sesión</h4>
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">Correo electrónico</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="control-label">Contraseña</label>

                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordarme
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-orange btn-block">
                        Acceder
                    </button>
                    <hr>
                </div>
                <div class="form-group text-center">
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Olvidaste tu contraseña?
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
