@extends('layouts.app')

@push('styles')
    <link href="../css/home.css" rel="stylesheet">
@endpush

@push('scripts')
    <script type="text/javascript" src="../js/login.js"></script>
	<script type="text/javascript" src="../js/home.js"></script>
	<script type="text/javascript" src="../js/modal/modal-history.js"></script>
	<script type="text/javascript" src="../js/modal/modal-img.js"></script>
@endpush
<!-- Foreverfit_123 -->
@section('content')
<div class="form-style-5">
	<fieldset>
			<legend style="font-size: 1.7em;text-align: center;">
				Historial de Medidas
			</legend>
				
			<input style="width: 49%;"
			type="submit" onclick="showConsulta()"
			value="Consultar una Fecha" id="submit"/>
				
			<input style="width: 49%;"
			data-toggle="modal" data-target="#dataModal"
			type="submit" onclick="beforeModalHistory('Mi Historial de Medidas', {{ $history }}, '{{ csrf_token() }}', 0)"
			value="Ver mi Historial" id="submit"/>
	</fieldset>
		
	<form class="hide-form" id="formSearch"
		method="POST" name="formSearch" action="{{ route('data.search') }}">
		{{ csrf_field() }}
		<fieldset>
			<input id="dateSearch" type="date" style="width: 100%;"
				name="dateSearch">
		</fieldset>
	</form>
</div>
	
<div class="form-style-5">
		@if(Request::input('success'))
			<div class="alert alert-info">
				{{ Request::input('success') }}
			</div>
		@endif
		
		@if(Request::input('error'))
			<div class="alert alert-error alert-dismissable">
				 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				{{ Request::input('error') }}
			</div>
		@endif
		
		@if(session()->has('success'))
			<div class="alert alert-info">
				{{ session()->get('success') }}
			</div>
		@endif
		
		@if(!empty($error))
			<div class="alert alert-warning alert-dismissable">
				 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				{{ $error }}
			</div>
		@endif
		
		<div class="alert alert-info alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		   IMPORTANTE: La medida que se registrará para el día actual será el último resultado calculado.
	   </div>

        <fieldset>
			<legend><span class="number">1</span> Sistema Métrico</legend>
			<div style="display:inline-block;width: 100%;margin-bottom:4%">
                <div style="padding-left: 5%;">
                    <label for="rdo-1" class="btn-radio">
                        <input type="radio" onclick="changeUnit('Mt', 'Cm')"
						id="rdo-1" name="metric_system" value="IS" checked>
                        <svg width="20px" height="20px" viewBox="0 0 20 20">
                            <circle cx="10" cy="10" r="9"></circle>
                            <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
                            <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                        </svg>
                        <span>(Kg/Cm)</span>
                    </label>
                    <label for="rdo-2" class="btn-radio">
                        <input type="radio" onclick="changeUnit('Ft', 'In')"
						id="rdo-2" name="metric_system" value="ES">
                            <svg width="20px" height="20px" viewBox="0 0 20 20">
                                <circle cx="10" cy="10" r="9"></circle>
                                <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
                                <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                            </svg>
                        <span>(Lb/Inch)</span>
                    </label>
                </div>
					
            </div>
		</fieldset>
			
		<fieldset>
            <legend><span class="number">2</span> Parrillo Caliper Method</legend>
			
			{{ Form::open(['route' => 'data.calculatorpcm']) }}
			{{ csrf_field() }}
			<label for="chest">Pecho:</label>
			<input type="number" class="form-control"
				name="chest" value="{{ $data->chest or old('chest') }}"
				min="1" step=".01"
				id="chest" placeholder="00">
			
			<label for="abdominal">Abdominal:</label>
			<input type="number" class="form-control"
				name="abdominal" value="{{ $data->abdominal or old('abdominal') }}"
				min="1" step=".01"
				id="abdominal" placeholder="00">
							
			<label for="thigh">Muslo:</label>
			<input type="number" class="form-control"
				name="thigh" value="{{ $data->thigh or old('thigh') }}"
				min="1" step=".01"
				id="thigh" placeholder="00">
				
			<label for="bicep">Bicep:</label>
			<input type="number" class="form-control"
				name="bicep" value="{{ $data->bicep or old('bicep') }}"
				min="1" step=".01"
				id="bicep" placeholder="00">
				
			<label for="tricep">Tricep:</label>
			<input type="number" class="form-control"
				name="tricep" value="{{ $data->tricep or old('tricep') }}"
				min="1" step=".01"
				id="tricep" placeholder="00">
							
			<label for="subscapular">Subscapular:</label>
			<input type="number" class="form-control"
				name="subscapular" value="{{ $data->subscapular or old('subscapular') }}"
				min="1" step=".01"
				id="subscapular" placeholder="00">
							
			<label for="suprailiac">Suprailiac:</label>
			<input type="number" class="form-control"
				name="suprailiac" value="{{ $data->suprailiac or old('suprailiac') }}"
				min="1" step=".01"
				id="suprailiac" placeholder="00">
				
			<label for="lower_back">Espalda Baja:</label>
			<input type="number" class="form-control"
				name="lower_back" value="{{ $data->lower_back or old('lower_back') }}"
				min="1" step=".01"
				id="lower_back" placeholder="00">
							
			<label for="calf">Pantorrilla:</label>
			<input type="number" class="form-control"
				name="calf" value="{{ $data->calf or old('calf') }}"
				min="1" step=".01"
				id="calf" placeholder="00">
				
			<label for="bodyweight">Peso:</label>
			<input type="number" class="form-control"
				name="bodyweight" value="{{ $data->bodyweight or old('bodyweight') }}"
				min="1" step=".01"
				id="bodyweight" placeholder="00">
			
			<div class="row" style="margin-top: 4%;">
				<div class="col-md-6">
					<input
						type="submit"
						value="Calcular" id="submit"/>
				</div>
				<div class="col-md-6">
					<label style="width: 100%;text-align: center;
									font-size: 24px;color: #8a97a0;">
						Grasa Corporal %
					</label>
						
					<p style="width: 100%;text-align: center;
									font-size: 24px;color: #8a97a0;">
						@if(session()->has('resp_pcm')) {{ session()->get('resp_pcm') }} @else {{ $data->pcm or 0.0 }} @endif
					</p>
				</div>
			</div>
				
			{{ Form::close() }}
		</fieldset>
		
		<fieldset>
            <legend><span class="number">3</span> Jackson/Pollock 7 Caliper Method (mm)</legend>
			
			{{ Form::open(['route' => 'data.calculatorjp7']) }}
			{{ csrf_field() }}
			<label for="chest">Pecho:</label>
			<input type="number" class="form-control"
				name="chest" value="{{ $data->chest or old('chest') }}"
				min="1" step=".01"
				id="chest" placeholder="00">
			
			<label for="abdominal">Abdominal:</label>
			<input type="number" class="form-control"
				name="abdominal" value="{{ $data->abdominal or old('abdominal') }}"
				min="1" step=".01"
				id="abdominal" placeholder="00">
							
			<label for="thigh">Muslo:</label>
			<input type="number" class="form-control"
				name="thigh" value="{{ $data->thigh or old('thigh') }}"
				min="1" step=".01"
				id="thigh" placeholder="00">
							
			<label for="tricep">Tricep:</label>
			<input type="number" class="form-control"
				name="tricep" value="{{ $data->tricep or old('tricep') }}"
				min="1" step=".01"
				id="tricep" placeholder="00">
							
			<label for="subscapular">Subscapular:</label>
			<input type="number" class="form-control"
				name="subscapular" value="{{ $data->subscapular or old('subscapular') }}"
				min="1" step=".01"
				id="subscapular" placeholder="00">
							
			<label for="suprailiac">Suprailiac:</label>
			<input type="number" class="form-control"
				name="suprailiac" value="{{ $data->suprailiac or old('suprailiac') }}"
				min="1" step=".01"
				id="suprailiac" placeholder="00">
				
			<label for="midaxillary">Midaxilar:</label>
			<input type="number" class="form-control"
				name="midaxillary" value="{{ $data->midaxillary or old('midaxillary') }}"
				min="1" step=".01"
				id="midaxillary" placeholder="00">
				
			<div class="row" style="margin-top: 4%;">
				<div class="col-md-6">
					<input
						type="submit"
						value="Calcular" id="submit"/>
				</div>
				<div class="col-md-6">
					<label style="width: 100%;text-align: center;
									font-size: 24px;color: #8a97a0;">
						Grasa Corporal %
					</label>
						
					<p style="width: 100%;text-align: center;
									font-size: 24px;color: #8a97a0;">
						@if(session()->has('resp_jp7')) {{ session()->get('resp_jp7') }} @else {{ $data->jp7 or 0.0 }} @endif
					</p>
				</div>
			</div>
			
			{{ Form::close() }}		
		</fieldset>
		
		<fieldset>
            <legend><span class="number">4</span> Navy Tape Measure Method</legend>
			
			{{ Form::open(['route' => 'data.calculatorntm']) }}
			{{ csrf_field() }}
			<label for="height_integer" id="height_integer_label">Estatura (Mt):</label>
			<input type="number" class="form-control"
				name="height_integer" value="{{ $data->height_integer or old('height_integer') }}"
				min="1" id="height_integer" placeholder="00">
				
			<label for="height_decimal" id="height_decimal_label">Estatura (Cm):</label>
			<input type="number" class="form-control"
				name="height_decimal" value="{{ $data->height_decimal or old('height_decimal') }}"
				min="1" id="height_decimal" placeholder="00">
			
			<label for="neck">Cuello:</label>
			<input type="number" class="form-control"
				name="neck" value="{{ $data->neck or old('neck') }}"
				min="1" step=".01"
				id="neck" placeholder="00">
				
			@if (Auth::user()->sex == 'F')
				<label for="waist">Cintura:</label>
				<input type="number" class="form-control"
					name="waist" value="{{ $data->waist or old('waist') }}"
					min="1" step=".01"
					id="waist" placeholder="00">
				
				<label for="hips">Caderas:</label>
				<input type="number" class="form-control"
					name="hips" value="{{ $data->hips or old('hips') }}"
					min="1" step=".01"
					id="hips" placeholder="00">
			@else
				<label for="abdomen">Abdomen:</label>
				<input type="number" class="form-control"
					name="abdomen" value="{{ $data->abdomen or old('abdomen') }}"
					min="1" step=".01"
					id="abdomen" placeholder="00">
			@endif
					
			<div class="row" style="margin-top: 4%;">
				<div class="col-md-6">
					<input
						type="submit"
						value="Calcular" id="submit"/>
				</div>
				<div class="col-md-6">
					<label style="width: 100%;text-align: center;
									font-size: 24px;color: #8a97a0;">
						Grasa Corporal %
					</label>
						
					<p style="width: 100%;text-align: center;
									font-size: 24px;color: #8a97a0;">
						@if(session()->has('resp_ntm')) {{ session()->get('resp_ntm') }} @else {{ $data->ntm or 0.0 }} @endif
					</p>
				</div>
			</div>
			{{ Form::close() }}
		</fieldset>
			
		<fieldset>
            <legend><span class="number">5</span> Tus Fotos</legend>
			
			@if (count($data->photos))
				<div>
					@foreach($data->photos as $key=>$photo)
						<img class="myImg" alt="Foto {{ ++$key }}"
							src="../{{ $photo->getUrlPath() }}">
					@endforeach
				</div>
			@else
				<p class="alert alert-info">
					Aún no tienes fotos de estas medidas. <a href="{{ route('photo') }}"> Sube tus fotos aquí</a>
				</p>
			@endif
		</fieldset>
			
		<fieldset>
            <div class="row" style="margin-top: 4%;">
				<div class="col-sm-12" style="padding-right: 5%;">
					<table class="table">
						<thead>
						  <tr>
							<th colspan="3">Gráfico de Porcentaje de Grasa Corporal</th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td class="td-header">Descripción</td>
							<td class="td-header">Hombres</td>
							<td class="td-header">Mujeres</td>
						  </tr>
						  <tr>
							<td>Grasa Esencial</td>
							<td>2-5%</td>
							<td>10-13%</td>
						  </tr>
						  <tr>
							<td>Atletas</td>
							<td>6-13%</td>
							<td>14-20%</td>
						  </tr>
						  <tr>
							<td>Deportistas</td>
							<td>14-17%</td>
							<td>21-24%</td>
						  </tr>
						  <tr>
							<td>Promedio</td>
							<td>18-24%</td>
							<td>25-31%</td>
						  </tr>
						  <tr>
							<td>Obeso</td>
							<td>25%+</td>
							<td>32%+</td>
						  </tr>
						</tbody>
					  </table>
				</div>
			</div>
		</fieldset>
</div>
	
@if(session()->has('resp'))
	<script>window.scrollTo(0,document.querySelector(".form-style-5").scrollHeight);</script>
@endif

<!-- Modal -->
<div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
	
<!-- The Modal -->
<div id="myModal" class="modal-img">
  <!-- The Close Button -->
  <span class="close-img">&times;</span>
  <!-- Modal Content (The Image) -->
  <img class="modal-content-img" id="img01">
  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>

@endsection
