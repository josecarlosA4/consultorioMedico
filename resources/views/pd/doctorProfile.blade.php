@extends('adminlte::page')

@section('title')
{{$doctor['name']}}
@endsection

@section('content_header')
	<h1>Perfil - {{$doctor['name']}}</h1>
@endsection

@section('content')
	<div class="card">
		<div class="card-body">

			<div class="flex-profile-edition">

				<div class="left">
					<div class="profile-image">
						<img src= "/assets/avatars/{{$doctor['avatar']}}">
					</div>
					<form method="POST" enctype="multipart/form-data" class="avatarDoctorForm" action="{{route('avatarDoctor', ['id' => $doctor['id'] ])}}">
						@method('PUT') 
                		@csrf

						<input type="file" id="image" name="image">
						<input type="submit" value="Salvar" class="btn btn-sm btn-info">
					</form>
				</div>

				<div class="right">

					<div class="patient-name horizontal">
						<label  class="col-sm-2 col-form-label">Nome:</label>
							<div class="text">
								{{$doctor['name']}}
							</div>
					</div>

					<div class="patient-cpf horizontal">
						<label  class="col-sm-2 col-form-label">CPF:</label>
						<div class="text">
							{{$doctor['cpf']}}
						</div>			
					</div>

					<div class="patient-email horizontal">
						<label  class="col-sm-2 col-form-label">Email:</label>
						<div class="text">
							{{$doctor['email']}}
						</div>
					</div>

					<div class="patient-birthDate horizontal">
						<label  class="col-sm-2 col-form-label">Nascimento:</label>
						<div class="text">
							{{  \Carbon\Carbon::parse($doctor['birthDate'])->format('d/m/Y') }}
						</div>	
					</div>

				</div>
			</div>
			

			<div class="footer-profile">
				<a id="openHistoric" class="btn btn-info">Histórico</a>
			</div>

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