@extends('adminlte::page')


@section('title', 'Editar Consulta')
@section('content_header')
    <h1>Editar Consulta</h1>
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <h5>OCORREU UM ERRO</h5>
          @foreach ($errors->all() as $error )
            <li> {{$error}}</li>
          @endforeach
    </div>
@endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('editConsultAction', ['id' => $consult['id'], 'view'=> $view ])}}">
                @method('PUT')
                @csrf

                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Nome Paciente:</label>
                    <div class="col-sm-10">
                        {{$consult['namePatient']}}
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Nome Doutor:</label>
                    <div class="col-sm-10">
                        {{$consult['nameDoctor']}}
                    </div>
                </div>

                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Data:</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="date" value="{{$consult['date']}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Horário:</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control" name="hour" value="{{$consult['hour']}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select name="status">
                            <option {{$dataSet['status'] == 0? 'selected': ''}} value="0">Pendente</option>
                            <option {{$dataSet['status'] == 1? 'selected': ''}} value="1" class="selected">Concluida</option>
                            <option {{$dataSet['status'] == 2? 'selected': ''}} value="2">Faltou</option>
                            <option {{$dataSet['status'] == 3? 'selected': ''}} value="3">Cancelada</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Descrição:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="description">{{$consult['description']}}</textarea>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Salvar</button>
                </div>

            </form>
        </div>
    </div>
@endsection
