@extends('layouts.app')

@push('styles')
    <link href="../../css/home.css" rel="stylesheet">
@endpush

@push('scripts')
    <script type="text/javascript" src="../../js/login.js"></script>
	<script type="text/javascript" src="../../js/home.js"></script>
	<script type="text/javascript" src="../../js/modal/modal-history.js"></script>
	<script type="text/javascript" src="../../js/modal/modal-img.js"></script>
@endpush
<!-- Foreverfit_123 -->
@section('content')
<div class="form-style-5">
	<fieldset>
			<legend style="font-size: 1.7em;text-align: center;">
				Historial de Medidas de {{ $user->first_name." ".$user->last_name }} ({{ $user->email }})
			</legend>
                
            <input style="width: 49%;"
			type="submit" onclick="showConsulta()"
			value="Consultar una Fecha" id="submit"/>
				
			<input style="width: 49%;"
			data-toggle="modal" data-target="#dataModal"
			type="submit" onclick="beforeModalHistory('Historial de Medidas', {{ $history }}, '{{ csrf_token() }}', {{ $user->id }})"
			value="Ver Historial" id="submit"/>
				
			<a type="button" class="btn btn-primary btn-action"
                href="{{ route('data.index') }}"
                style="position: relative;padding: 11px 39px 10px 39px;color: #FFF;margin: 0 auto;font-size: 18px;text-align: center;font-style: normal;width: 99%;border-width: 1px 1px 3px;margin-bottom: 10px;">
              Volver a la Lista de Usuarios
            </a>
	</fieldset>
		
	<form class="hide-form" id="formSearch"
		method="POST" name="formSearch" action="{{ route('data.searchUsers') }}">
		{{ csrf_field() }}
        <input type='hidden' name='user_id' value='{{ $user->id }}'>
		<fieldset>
			<input id="dateSearch" type="date" style="width: 100%;"
				name="dateSearch">
		</fieldset>
	</form>
</div>
	
<div class="form-style-5">

        <fieldset>
			<legend><span class="number">1</span>
                Medidas @if($data->metric_system==="IS") (Kg/Cm) @else (Lb/Inch) @endif
            </legend>
            
            <div class="row">
                <div class="col-md-2">
                    <strong>Chest</strong>
                </div>
                <div class="col-md-2">
                    {{ $data->chest }}
                </div>
                <div class="col-md-2">
                    <strong>Abdominal</strong>
                </div>
                <div class="col-md-2">
                    {{ $data->abdominal }}
                </div>
                <div class="col-md-2">
                    <strong>Bicep</strong>
                </div>
                <div class="col-md-2">
                    {{ $data->bicep }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <strong>Calf</strong>
                </div>
                <div class="col-md-2">
                    {{ $data->calf }}
                </div>
                <div class="col-md-2">
                    <strong>Hips</strong>
                </div>
                <div class="col-md-2">
                    {{ $data->hips }}
                </div>
                <div class="col-md-2">
                    <strong>Lower Back</strong>
                </div>
                <div class="col-md-2">
                    {{ $data->lower_back }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <strong>Midaxillary</strong> 
                </div>
                <div class="col-md-2">
                    {{ $data->midaxillary }}
                </div>
                <div class="col-md-2">
                    <strong>Neck</strong>
                </div>
                <div class="col-md-2">
                    {{ $data->neck }}
                </div>
                <div class="col-md-2">
                    <strong>Subscapular</strong>
                </div>
                <div class="col-md-2">
                    {{ $data->subscapular }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <strong>Suprailiac</strong>
                </div>
                <div class="col-md-2">
                    {{ $data->suprailiac }}
                </div>
                <div class="col-md-2">
                    <strong>Thigh</strong>
                </div>
                <div class="col-md-2">
                    {{ $data->thigh }}
                </div>
                <div class="col-md-2">
                    <strong>Tricep</strong>
                </div>
                <div class="col-md-2">
                    {{ $data->tricep }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <strong>Waist</strong>
                </div>
                <div class="col-md-2">
                    {{ $data->waist }}
                </div>
                <div class="col-md-2">
                    <strong>Height</strong>
                </div>
                <div class="col-md-2">
                    {{ $data->height_integer.",".$data->height_decimal }}
                </div>
                <div class="col-md-2">
                    <strong>Bodyweight</stron>
                </div>
                <div class="col-md-2">
                    {{ $data->bodyweight }}
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <strong>Jackson/Pollock 7 Caliper Method</strong>
                </div>
                <div class="col-md-4">
                    <strong>Parrillo Caliper Method</strong>
                </div>
                <div class="col-md-4">
                    <strong>Navy Tape Measure Method</strong>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    {{ $data->jp7 }}
                </div>
                <div class="col-md-4">
                    {{ $data->pcm }}
                </div>
                <div class="col-md-4">
                    {{ $data->ntm }}
                </div>
            </div>
		</fieldset>
			
		<fieldset>
            <legend><span class="number">2</span> Fotos</legend>
			
			@if (count($data->photos))
				<div>
					@foreach($data->photos as $key=>$photo)
						<img class="myImg" alt="Foto {{ ++$key }}"
							src="../../{{ $photo->getUrlPath() }}">
					@endforeach
				</div>
			@else
				<p class="alert alert-info">
					El usuario aún no tiene fotos de estas medidas.
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
