@extends('adminlte::page')


@section('title', 'Pacientes')

@section('content_header')
<h1>Pacientes ({{count($patients)}}) </h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <tr>
                <th>CPF</th>
                <th>NOME</th>
                <th>AÇÕES</th>
            </tr>
            @foreach ($patients as $patient )
            <tr>
                <td>{{$patient['cpf']}}</td>
                <td>{{$patient['name']}}</td>
                <td><a href="{{route('patientProfile', ['id' => $patient['id']])}}" class="btn btn-info">PERFIL</a></td>
            </tr>
            @endforeach


        </table>
    </div>
</div>

{{ $patients->links('pagination::bootstrap-4') }}

@endsection
