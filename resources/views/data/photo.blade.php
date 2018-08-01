@extends('layouts.app')

@push('styles')
    <link href="../css/photo.css" rel="stylesheet">
@endpush

@push('scripts')
    <script type="text/javascript" src="../js/login.js"></script>
	<script type="text/javascript" src="../js/photo.js"></script>
@endpush

@section('content')
<div class="form-style-5">
	<fieldset>
        <legend style="font-size: 1.7em;text-align: center;">
            Evaluación visual
        </legend>
        
        <div>
            <p>
                A modo de documentar tu progreso durante el programa
                FOREVERFIT, es necesario que tomemos fotos antes de
                iniciar el programa. La evaluación visual se realizará cada 15
                días.
            </p>
        </div>
	</fieldset>
        
    <fieldset>
        <legend style="font-size: 1.7em;text-align: center;">
            Instrucciones para tomar tus fotos
        </legend>
        
        <div>
            <p>
                1. Mujeres en traje de baño y hombres con pantalón corto. <br>
                2. El fondo debe ser de color claro. <br>
                3. Las fotos deben ser tomadas siempre desde el mismo
                ángulo y la misma distancia. A unos 5 metros para capturar
                el cuerpo entero. <br>
                4. Toma 4 fotos en total: una de frente, una de perfil
                izquierdo, una de perfil derecho y una de espalda.
            </p>
        </div>
	</fieldset>
        
    <fieldset>
		<form method="POST" action="{{ route('data.uploadPhotos') }}"
            enctype="multipart/form-data">
            {{ csrf_field() }}
			
			@foreach ($errors->all() as $error)
			   <span class="help-block">
					<strong style="color:red">{{ $error }}</strong>
				</span>
			@endforeach
        
            <div id="box-image">
				@if (count($data->photos))
					<div>
						@foreach($data->photos as $photo)
							<img style="width: 152px;height:150px"
								src="{{ $photo->getUrlPath() }}">
						@endforeach
					</div>
				@else
					<p class="alert alert-info">
						Aún no tienes fotos de estas medidas.
					</p>
				@endif
			</div>
        
            <div class="box" id="box" style="text-align:center;">
                <input type="file" name="images[]" id="file-5"
                    class="inputfile inputfile-4"
                    data-multiple-caption="{count} files selected" multiple />
                <label for="file-5"><figure><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg></figure> <span>Elegir Imágenes&hellip;</span></label>
            </div>
            
            <input style="width: 49%;"
                type="submit" value="Cargar Imágenes" id="submit-img"/>
                
            <input style="width: 49%;" name="clean"
                type="submit" value="Remover Imágenes" id="clean-img"/>
        
        </form>
	</fieldset>
</div>
@endsection
