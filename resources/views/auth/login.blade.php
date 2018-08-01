@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/login.js') }}"></script>
@endpush

@section('content')
    <div id="form">
        <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
                        
            <div class="logo">
                <img src="/img/logo.png" />
            </div>
                
            <div class="form-item">
                <p class="formLabel">Correo</p>
                <input id="email" type="email"
                    class="form-style" name="email"
                    value="{{ old('email') }}" required>
            </div>
                
            <div class="form-item">
                <p class="formLabel">Contraseña</p>
                <input id="password" type="password" class="form-style" name="password" required>
    
                <p><a href="{{ route('password.request') }}" ><small>Olvidaste tu Contraseña ?</small></a></p>	
            </div>
                
            <div class="form-item">
                <p class="pull-left"><a href="{{ route('register') }}"><small>Registrarse</small></a></p>
                <input type="submit" class="login pull-right" value="Acceder">
                <div class="clear-fix"></div>
            </div>
        </form>
    </div>
@endsection
