@extends('adminlte::page')

@section('title')
{{$patient['name']}}
@endsection

@section('content_header')
	<h1>Perfil - {{$patient['name']}}</h1>
@endsection

@section('content')
	<div class="card">
		<div class="card-body">
			<div class="patient-name horizontal">
				<label  class="col-sm-2 col-form-label">Nome:</label>
				<div class="text">
					{{$patient['name']}}
				</div>
			</div>
			<div class="patient-cpf horizontal">
				<label  class="col-sm-2 col-form-label">CPF:</label>
				<div class="text">
					{{$patient['cpf']}}
				</div>			
			</div>
			<div class="patient-email horizontal">
				<label  class="col-sm-2 col-form-label">Email:</label>
				<div class="text">
					{{$patient['email']}}
				</div>
			</div>
			<div class="patient-birthDate horizontal">
				<label  class="col-sm-2 col-form-label">Nascimento:</label>
				<div class="text">
					{{  \Carbon\Carbon::parse($patient['birthDate'])->format('d/m/Y') }}
				</div>	
			</div>

			<a id="openHistoric" class="btn btn-info">Histórico</a>

			
		</div>
	</div>

	<div id="historic" class="card inative">
		<div class="card-body">
			<table class="table table-hover">
				<tr>
					<th>DATA</th>
	                <th>HÓRARIO</th>
	                <th>PACIENTE</th>
	                <th>DOUTOR</th>
	                <th>STATUS</th>
				</tr>

			@foreach ($consults as $consult )
	            <tr>
	                <td> {{  \Carbon\Carbon::parse($consult['date'])->format('d/m/Y') }}</td>
	                <td>{{$consult['hour']}}</td>
	                <td>{{$consult['namePatient']}}</td>
	                <td>{{$consult['nameDoctor']}}</td>
	                <td><a href="{{route('editConsult', ['id'=> $consult['id'], 'view' => 'home'])}}" class="btn btn-{{$status[$consult['status']]['class']}}">{{$status[$consult['status']]['status']}}</a></td>
	            </tr>
            @endforeach
			</table>
		</div>
	</div>

	@section('css')
		<link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
	@endsection
	
	@section('js')
		<script src="{{asset('assets/js/scriptProfile.js')}}"></script>
	@endsection

@endsection