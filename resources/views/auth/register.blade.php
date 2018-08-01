@extends('layouts.app')

@push('styles')
    <link href="../css/login.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="../js/login.js" type="text/javascript"></script>
@endpush

@section('content')
<div class="form-style-5">
    <form method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
        
        <fieldset>
            <legend><span class="number">1</span> Información de Usuario</legend>
                
            <input id="product_code" type="text"
                name="product_code"
                value="{{ old('product_code') }}"
                placeholder="Código del Producto *"
                required autofocus>
                
                @if ($errors->has('product_code'))
                    <span class="help-block">
                        <strong>{{ $errors->first('product_code') }}</strong>
                    </span>
                @endif
                
            <input id="email" type="text"
                name="email"
                value="{{ old('email') }}"
                placeholder="Email *"
                required>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                
            <input id="password" type="password"
                name="password"
                placeholder="Contraseña *"
                required>
                
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                
            <input id="password-confirm" type="password"
                name="password_confirmation"
                placeholder="Confirmar Contraseña *"
                required>
                
            <label for="birthdate" style="width: 28%;">Fecha de Nacimiento:</label>
            <input id="birthdate" type="date" value="{{ old('birthdate') }}"
                name="birthdate" required>
                
                @if ($errors->has('birthdate'))
                    <span class="help-block">
                        <strong>{{ $errors->first('birthdate') }}</strong>
                    </span>
                @endif
        
        </fieldset>
            
        <fieldset>
            <legend><span class="number">2</span> Información Adicional</legend>
            
            <div style="display:inline-block;width: 100%;">
                <label for="sex">Sexo:</label>
                    
                <div style="padding-left: 5%;">
                    <label for="rdo-1" class="btn-radio">
                        <input type="radio" id="rdo-1" name="sex" value="M"
                            @if(old('sex') == 'M') checked @endif>
                        <svg width="20px" height="20px" viewBox="0 0 20 20">
                            <circle cx="10" cy="10" r="9"></circle>
                            <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
                            <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                        </svg>
                        <span>Hombre</span>
                    </label>
                    <label for="rdo-2" class="btn-radio">
                        <input type="radio" id="rdo-2" name="sex" value="F"
                            @if(old('sex') == 'F') checked @endif>
                            <svg width="20px" height="20px" viewBox="0 0 20 20">
                                <circle cx="10" cy="10" r="9"></circle>
                                <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
                                <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                            </svg>
                        <span>Mujer</span>
                    </label>
                </div>
                @if ($errors->has('sex'))
                    <span class="help-block">
                        <strong>{{ $errors->first('sex') }}</strong>
                    </span>
                @endif
            </div>
            
            <br>
            <!--
            <div style="display:inline-block;width: 100%;">
                <label for="body_type">Tipo de Cuerpo:</label>
                    
                <div class="row" style="margin-top: 3%;margin-bottom: 3%;">
                    <div class="col-md-4 col-sm-12" style="text-align:center;">
                        <div class="wrapper">
                            <div class="wrapper-img">
                                <input class="input-hidden" @if(old('body_type') == 'Mesomorph') checked @endif
                                    type="radio" id="rdo-3" name="body_type" value="Mesomorph" >
                                <img class="img_body_type" onClick="checkBodyType('rdo-3')"
                                    src="/img/meso_m.png">
                                <span style="display: inline-block;vertical-align: middle;color: #626a6f;font-size: 1.3em;font-weight: bold;">
                                    Mesomorfo
                                </span>
                                <div class="tooltip">
                                    <b>Mesomorfo</b> <br> Tienden a ser musculosos y atléticos por naturaleza. Este tipo de personas tienen un cuerpo en forma de V (hombres) o de reloj de arena (mujeres).
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    <div class="col-md-4 col-sm-12" style="text-align:center;">
                        <div class="wrapper">
                            <div class="wrapper-img">
                                <input class="input-hidden"
                                    type="radio" id="rdo-4" @if(old('body_type') == 'Endomorph') checked @endif
                                    name="body_type" value="Endomorph" >
                                <img class="img_body_type" onClick="checkBodyType('rdo-4')"
                                    src="/img/endo_m.png">
                                <span style="display: inline-block;vertical-align: middle;color: #626a6f;font-size: 1.3em;font-weight: bold;">
                                    Endomorfo
                                </span>
                                <div class="tooltip">
                                    <b>Endomorfo</b> <br> Se caracteriza por la estructura gruesa de los huesos, la cintura ancha y el exceso de grasa. El metabolismo tiende a ser lento. Su figura tiende a ser redonda o tener forma de pera
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    <div class="col-md-4 col-sm-12" style="text-align:center;">
                        <div class="wrapper">
                            <div class="wrapper-img">
                                <input class="input-hidden"
                                    type="radio" id="rdo-5" @if(old('body_type') == 'Ectomorph') checked @endif
                                    name="body_type" value="Ectomorph" >
                                <img class="img_body_type" onClick="checkBodyType('rdo-5')"
                                    src="/img/ecto_m.png">
                                <span style="display: inline-block;vertical-align: middle;color: #626a6f;font-size: 1.3em;font-weight: bold;">
                                    Ectomorfo
                                </span>
                                <div class="tooltip">
                                    <b>Ectomorfo</b> <br> Se caracteriza por la delgadez y por la dificultad para aumentar el volumen de la masa corporal. Tienen extremidades largas, igualmente su estructura osea es delgada.
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                @if ($errors->has('body_type'))
                    <span class="help-block">
                        <strong>{{ $errors->first('body_type') }}</strong>
                    </span>
                @endif
            </div>
            -->
                
            <input id="whatsapp" type="text"
                name="whatsapp" style="margin-top: 2%;"
                value="{{ old('whatsapp') }}"
                placeholder="Nro. WhatsApp">
                
                @if ($errors->has('whatsapp'))
                    <span class="help-block">
                        <strong>{{ $errors->first('whatsapp') }}</strong>
                    </span>
                @endif
                
            <input id="instagram" type="text"
                name="instagram"
                value="{{ old('instagram') }}"
                placeholder="Usuario de Instagram">
                
                @if ($errors->has('instagram'))
                    <span class="help-block">
                        <strong>{{ $errors->first('instagram') }}</strong>
                    </span>
                @endif
            
            <br>
            <br>
            
        </fieldset>
        <input type="submit" value="Registrar" />
        
        <p>
            <a href="{{ route('login') }}" >
                Ya tienes una cuenta ?
            </a>
        </p>
    </form>
</div>
@endsection
