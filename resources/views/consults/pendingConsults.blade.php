@extends('adminlte::page')


@section('title', 'HOME')

@section('content_header')
<h1>Pendentes ({{count($consults)}})</h1>
@endsection

@section('content')

<div class="card">
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
                <td><a href="{{route('editConsult', ['id' => $consult['id'], 'view' => 'pendingConsults'])}}" class="btn btn-{{$status[$consult['status']]['class']}}">{{$status[$consult['status']]['status']}}</a></td>
            </tr>
            @endforeach


        </table>
    </div>
</div>

{{ $consults->links('pagination::bootstrap-4') }}

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
@endsection

@section('js')
<script src="{{asset('assets/js/script.js')}}"></script>
@endsection

@endsection
