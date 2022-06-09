@extends('adminlte::page')


@section('title', 'Adicionar Doutor')

@section('content_header')
<h1>Nova Consulta</h1>
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

@if (session('warning'))
    <div class="alert alert-success">
        {{session('warning')}}
    </div>
@endif
    <div class="card card-info">
        <form class="form-horizontal" method="POST" action="{{route('addConsultAction')}}">
            @csrf

            <div class="card-body">

                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Cpf Doutor:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="cpfDoctor" id="cpfDoctor" placeholder="Cpf...">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cpf Paciente:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="cpfPatient" id="cpfPatient" placeholder="Cpf...">
                    </div>
                </div>

                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Data</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="date" placeholder="Data de nascimento">
                    </div>
                </div>

                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Horario</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control" name="hour">
                    </div>
                </div>

                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Descrição</label>
                    <div class="col-sm-10">
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                </div>

            </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info">Adicionar</button>
        </div>

        </form>
    </div>

    </div>

    <script src="https://unpkg.com/imask"></script>
    <script>
        IMask(
            document.getElementById('cpfDoctor'),
            {
                mask: '000.000.000-00'
            }
        );
    </script>
    <script>
        IMask(
            document.getElementById('cpfPatient'),
            {
                mask: '000.000.000-00'
            }
        );
    </script>

@endsection
