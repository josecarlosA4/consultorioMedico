@extends('adminlte::page')


@section('title', 'Doutores')

@section('content_header')
<h1>Doutores ({{count($doctors)}})</h1>
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
            @foreach ($doctors as $doctor )
            <tr>
                <td>{{$doctor['cpf']}}</td>
                <td>{{$doctor['name']}}</td>
                <td><a href="{{route('doctorProfile', ['id' => $doctor['id']])}}" class="btn btn-info">PERFIL</a></td>
            </tr>
            @endforeach


        </table>
    </div>
</div>

{{ $doctors->links('pagination::bootstrap-4') }}

@endsection
