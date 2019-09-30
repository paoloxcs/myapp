@extends('layouts.front')

@section('content')
<div class="bg-fullwidth">
    <div class="auth-content">
        <div class="layout-form">
            <h4 class="mb-4">Restablecer contraseña</h4>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
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

                <div class="form-group">
                    <button type="submit" class="btn btn-orange">
                        Enviar link de recuperación
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
