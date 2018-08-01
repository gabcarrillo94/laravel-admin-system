@extends('layouts.app')

@push('styles')
    <link href="../css/questionnaire.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="../js/login.js" type="text/javascript"></script>
@endpush

@section('content')
<div class="form-style-5">
    {{ Form::open(['route' => 'questionnaire.store']) }}
        {{ csrf_field() }}
		
		@if(session()->has('success'))
			<div class="alert alert-info">
				{{ session()->get('success') }}
			</div>
		@endif
		
		@if(session()->has('error'))
			<div class="alert alert-warning alert-dismissable">
				 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				{{ session()->get('error') }}
			</div>
		@endif
		
		<h3 style="margin-bottom: 3%;text-align: center;font-size: 2.3em;">
			Knowing you!
		</h3>
        
        <fieldset>
            <legend><span class="number">1</span> ¿Cómo te describes a ti mismo(a)? Escribe una
breve reseña.</legend>
            <input id="qst_1" type="text"
                name="qst_1"
                value="{{ old('qst_1') }}"
                >
                
            <legend><span class="number">2</span>¿Tienes algún objetivo en específico el cual te
gustaría llegar? </legend>
            <input id="qst_2" type="text"
                name="qst_2"
                value="{{ old('qst_2') }}"
                >
                
            <legend><span class="number">3</span>¿Cuál de estos objetivos es más importante para ti a
nivel personal? Usa un puntaje del 1 al 10 para cada
una en orden de importancia para ti.  </legend>
            
            <div>
                <label style="width:22%" for="qst_3_1">Mejorar tu salud.</label>
                <input style="width:19%"
                    id="qst_3_1" type="number"
                    name="qst_3_1"  min="1" max="10"
                    value="{{ old('qst_3_1') }}"
                    >
                    
                <label style="width:22%" for="qst_3_2">Mejorar tu resistencia.</label>
                <input style="width:19%"
                    id="qst_3_2" type="number"
                    name="qst_3_2"  min="1" max="10"
                    value="{{ old('qst_3_2') }}"
                    >
                    
                <label style="width:22%" for="qst_3_3">Incrementar masa muscular.</label>
                <input style="width:19%"
                    id="qst_3_3" type="number"
                    name="qst_3_3"  min="1" max="10"
                    value="{{ old('qst_3_3') }}"
                    >
                    
                <label style="width:22%" for="qst_3_4">Perder grasa.</label>
                <input style="width:19%"
                    id="qst_3_4" type="number"
                    name="qst_3_4"  min="1" max="10"
                    value="{{ old('qst_3_4') }}"
                    >
                    
                <label style="width:22%" for="qst_3_5">Aumentar de peso. </label>
                <input style="width:19%"
                    id="qst_3_5" type="number"
                    name="qst_3_5"  min="1" max="10"
                    value="{{ old('qst_3_5') }}"
                    >
                    
                <label style="width:22%" for="qst_3_6">Incrementar fuerza. </label>
                <input style="width:19%"
                    id="qst_3_6" type="number"
                    name="qst_3_6"  min="1" max="10"
                    value="{{ old('qst_3_6') }}"
                    >
            </div>
            
            <div style="display:inline-block;width: 100%;">
                <legend><span class="number">4</span>Si tuvieras que escoger entre las siguientes 2
opciones, ¿Cual escogerías y por qué? </legend>
                    
                <div>
                    <label for="rdo-1" class="btn-radio">
                        <input type="radio" id="rdo-1" name="qst_4" value="Llegar a tu objetivo rápidamente. " >
                        <svg width="20px" height="20px" viewBox="0 0 20 20">
                            <circle cx="10" cy="10" r="9"></circle>
                            <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
                            <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                        </svg>
                        <span> Llegar a tu objetivo rápidamente. </span>
                    </label>
                    <label style="margin-left: 0px;" for="rdo-2" class="btn-radio">
                        <input type="radio" id="rdo-2" name="qst_4" value="Llegar a tu objetivo lentamente pero de una forma
fácil de mantener. ">
                            <svg width="20px" height="20px" viewBox="0 0 20 20">
                                <circle cx="10" cy="10" r="9"></circle>
                                <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
                                <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                            </svg>
                        <span>Llegar a tu objetivo lentamente pero de una forma
fácil de mantener. </span>
                    </label>
                </div>
            </div>
                
            <legend style="margin-top: 3%;"><span class="number">5</span>Crees que hay algún tipo de impedimento que
pueda separarte de lograr tu objetivo con el
programa?</legend>
            <input id="qst_5" type="text"
                name="qst_5"
                value="{{ old('qst_5') }}"
                >
                
            <legend><span class="number">6</span>En caso de responder si a la pregunta anterior. ¿Qué
crees que podemos hacer para superarlo?</legend>
            <input id="qst_6" type="text"
                name="qst_6"
                value="{{ old('qst_6') }}"
                >
                
            <legend><span class="number">7</span>¿Cómo describirías tus hábitos alimenticios?</legend>
            <input id="qst_7" type="text"
                name="qst_7"
                value="{{ old('qst_7') }}"
                >
                
            <legend><span class="number">8</span>¿Sufres de ansiedad por comida y/o atracones
frecuentemente?</legend>
            <input id="qst_8" type="text"
                name="qst_8"
                value="{{ old('qst_8') }}"
                >
                
            <legend><span class="number">9</span>¿A que te dedicas? ¿Cómo es tu horario de trabajo?</legend>
            <input id="qst_9" type="text"
                name="qst_9"
                value="{{ old('qst_9') }}"
                >
                
            <legend><span class="number">10</span>¿Crees que tu familia, amigos, esposo, hijos,
colegas te apoyarán en el proceso de mejorar tus
hábitos alimenticios? </legend>
            <input id="qst_10" type="text"
                name="qst_10"
                value="{{ old('qst_10') }}"
                >
                
            <legend><span class="number">11</span>¿Estás tomando algún tipo de medicamento
actualmente? </legend>
            <input id="qst_11" type="text"
                name="qst_11"
                value="{{ old('qst_11') }}"
                >
                
            <legend><span class="number">12</span>¿Eres alérgico(a) algún tipo de alimento? </legend>
            <input id="qst_12" type="text"
                name="qst_12"
                value="{{ old('qst_12') }}"
                >
                
            <legend><span class="number">13</span>¿Actualmente consumes algún tipo de suplemento?</legend>
            <input id="qst_13" type="text"
                name="qst_13"
                value="{{ old('qst_13') }}"
                >
                
            <legend><span class="number">14</span>¿Cuántas horas de sueño tienes normalmente? </legend>
            <input id="qst_14" type="number"
                name="qst_14" min="1" max="24"
                value="{{ old('qst_14') }}"
                >
                
            <legend><span class="number">15</span>¿Cuántos días a la semana te ejercitas y a qué hora
del día?</legend>
            <input id="qst_15" type="text"
                name="qst_15"
                value="{{ old('qst_15') }}"
                >
                
            <legend><span class="number">16</span>¿Cuánto tiempo dura tu entrenamiento? ¿Y que tipo
de ejercicios realizas?</legend>
            <input id="qst_16" type="text"
                name="qst_16"
                value="{{ old('qst_16') }}"
                >
				
            @if (Auth::user()->sex == 'F')
				<legend><span class="number">17</span>¿Aproximadamente qué día tendrás siguiente período?</legend>
				<input id="qst_17" type="date"
					name="qst_17" min="{{ date('Y-m-d') }}"
					value="{{ old('qst_17') }}"
					>
			@endif
                
            <input
			type="submit"
			value="Enviar" id="submit"/>
		</fieldset>
		
    {{ Form::close() }}
</div>

@endsection
