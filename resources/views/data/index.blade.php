@extends('layouts.app')

@push('styles')
    <link href="../css/home.css" rel="stylesheet">
@endpush

@push('scripts')
    <script type="text/javascript" src="../js/login.js"></script>
	<script type="text/javascript" src="../js/modal/modal-data.js"></script>
	<script type="text/javascript" src="../js/modal/modal-questionnaire.js"></script>
@endpush

@section('content')
<div class="container">
	<div class="panel panel-default" style="margin-top: 2%;">
		<div class="panel-heading" style="color: white;
    font-weight: bold;
    background-color: #6e0d67;
    border-color: #b129a7;">
			LISTA DE CLIENTES
		</div>
            
		<div class="panel-body" style="font-size: 14px;">
			@if (count($users))
				<div class="table-responsive" style="margin-bottom: 15px;overflow-x: auto;overflow-y: hidden;-webkit-overflow-scrolling: touch;-ms-overflow-style: -ms-autohiding-scrollbar;border: .6px solid #ddd;">
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th style="text-align:center">Nombre</th>
								<th style="text-align:center">Email</th>
								<th style="text-align:center">Dirección</th>
								<th style="text-align:center">Sexo</th>
								<th style="text-align:center">Fecha de Nacimiento</th>
								<th style="text-align:center">Edad</th>
								<th style="text-align:center">Programa</th>
								<th style="text-align:center">WhatsApp</th>
								<th style="text-align:center">Instagram</th>
                                <th style="text-align:center">Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($users as $user)
							<?php
								$birthDate = explode("-", $user->birthdate);
								$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md")
								  ? ((date("Y") - $birthDate[0]) - 1)
								  : (date("Y") - $birthDate[0]));
							?>
							<tr>
								<td>{{ $user->first_name." ".$user->last_name }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->address }}</td>
								<td>{{ $user->sex }}</td>
								<td>{{ date('m-d-Y', strtotime($user->birthdate)) }}</td>
								<td>{{ $age }}</td>
                                <td>{{ $user->program }}</td>
								<td>{{ $user->whatsapp }}</td>
								<td>{{ $user->instagram }}</td>
								<td>
									<!-- Button trigger modal -->
									@if (count($user->data))
										<a type="button" class="btn btn-primary btn-action"
											href="{{ route('data.users', $user->id) }}">
										  Medidas Y Fotos
										</a>
									@endif
									<button type="button" class="btn btn-info btn-action"
										data-toggle="modal" data-target="#dataModal"
										onclick="beforeModalQuestionnaire('{{ $user->first_name }} {{ $user->last_name }} ({{ $user->email }})',
																{{ $user->questionnaire }}, '{{ $user->sex }}')">
									  Cuestionario
									</button>
									<form action="{{ route('data.destroy', $user->id) }}" method="POST" style="display:inline-block;width: 100%;">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button class="btn btn-danger btn-action">
											Eliminar
										</button>
									</form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			@else
				<p class="alert alert-info">
					No hay Elementos
				</p>
			@endif
		</div>
	</div>
</div>
	
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
@endsection