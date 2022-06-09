@extends('adminlte::page')


@section('title', 'Adicionar Doutor')

@section('content_header')
<h1>Adicionar Doutor</h1>
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
        <form class="form-horizontal" method="POST" action="{{route('addDoctorAction')}}">
            @csrf

            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nome Completo:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control  @error('name')is-invalid @enderror" name="name" placeholder="Nome...">
                    </div>
                </div>

                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Cpf:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control  @error('cpf')is-invalid @enderror" name="cpf" id="cpf" placeholder="Cpf...">
                    </div>
                </div>

                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control  @error('email')is-invalid @enderror" name="email" placeholder="Email...">
                    </div>
                </div>

                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Nascimento:</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control  @error('birthdate')is-invalid @enderror" name="birthdate" placeholder="Data de nascimento">
                    </div>
                </div>

            </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info">Salvar</button>
        </div>

        </form>
    </div>

    </div>

    <script src="https://unpkg.com/imask"></script>
    <script>
        IMask(
            document.getElementById('cpf'),
            {
                mask: '000.000.000-00'
            }
        );
    </script>
@endsection
